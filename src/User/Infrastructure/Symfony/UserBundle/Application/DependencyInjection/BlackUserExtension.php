<?php

/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Bundle\UserBundle\Application\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Class BlackUserExtension
 */
class BlackUserExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration($this->getAlias());
        $config = $processor->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../../Resources/config'));

        if (!isset($config['db_driver'])) {
            throw new \InvalidArgumentException('You must provide the black_user.db_driver configuration');
        }

        try {
            $loader->load(sprintf('%s.xml', $config['db_driver']));
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException(
                sprintf('The db_driver "%s" is not supported by engine', $config['db_driver'])
            );
        }

        $container->setParameter($this->getAlias() . '.backend_type_' . $config['db_driver'], true);

        $this->remapParametersNamespaces($config, $container, [
            '' => [
                'user_class' => 'black_user.user.model.class',
            ]
        ]);

        foreach (['command', 'cqrs', 'domain_event', 'dto', 'form', 'infrastructure_services'] as $basename) {
            $loader->load(sprintf('%s.xml', $basename));
        }
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'black_user';
    }

    /**
     * @param array            $config
     * @param ContainerBuilder $container
     * @param array            $map
     */
    protected function remapParameters(array $config, ContainerBuilder $container, array $map)
    {
        foreach ($map as $name => $paramName) {
            if (array_key_exists($name, $config)) {
                $container->setParameter($paramName, $config[$name]);
            }
        }
    }

    /**
     * @param array            $config
     * @param ContainerBuilder $container
     * @param array            $namespaces
     */
    protected function remapParametersNamespaces(array $config, ContainerBuilder $container, array $namespaces)
    {
        foreach ($namespaces as $ns => $map) {
            if ($ns) {
                if (!array_key_exists($ns, $config)) {
                    continue;
                }
                $namespaceConfig = $config[$ns];
            } else {
                $namespaceConfig = $config;
            }
            if (is_array($map)) {
                $this->remapParameters($namespaceConfig, $container, $map);
            } else {
                foreach ($namespaceConfig as $name => $value) {
                    $container->setParameter(sprintf($map, $name), $value);
                }
            }
        }
    }
}
