<?php

namespace Black\Bundle\UserBundle;

use Black\Bundle\UserBundle\Application\DependencyInjection\BlackUserExtension;
use Doctrine\Bundle\MongoDBBundle\DependencyInjection\Compiler\DoctrineMongoDBMappingsPass;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Console\Application;

/**
 * Class BlackUserBundle
 */
class BlackUserBundle extends Bundle
{
    /**
     * @return BlackUserExtension
     */
    public function getContainerExtension()
    {
        return new BlackUserExtension();
    }

    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $mappings = array(
            realpath($this->getPath() . '/Resources/config/doctrine/model') => 'Black\User\Domain\Model',
        );

        $ormCompilerClass = 'Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass';

        if (class_exists($ormCompilerClass)) {
            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createXmlMappingDriver(
                    $mappings,
                    [],
                    'application.backend_type_orm'
                ));
        }

        $mongoCompilerClass = 'Doctrine\Bundle\MongoDBBundle\DependencyInjection\Compiler\DoctrineMongoDBMappingsPass';

        if (class_exists($mongoCompilerClass)) {
            $container->addCompilerPass(
                DoctrineMongoDBMappingsPass::createXmlMappingDriver(
                    $mappings,
                    [],
                    'application.backend_type_mongodb'
                ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function registerCommands(Application $application)
    {
        return;
    }
}
