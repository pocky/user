<?php

namespace Black\Bundle\UserBundle\Application\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    private $alias;

    /**
     * @param string $alias
     */
    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root($this->alias);

        $supportedDrivers = ['mongodb', 'orm'];

        $rootNode
            ->children()

                ->scalarNode('db_driver')
                    ->validate()
                        ->ifNotInArray($supportedDrivers)
                        ->thenInvalid('The database driver %s is not supported. Please choose one of ' . json_encode($supportedDrivers))
                    ->end()
                ->isRequired()
                ->cannotBeOverwritten()
                ->cannotBeEmpty()
                ->end()

                ->scalarNode('user_class')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('user_manager')->defaultValue('Black\\Component\\User\\Infrastructure\\Doctrine\\UserManager')->end()


            ->end();

        return $treeBuilder;
    }
}
