<?php


namespace test\HealthCheckBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('health_check');
        $rootNode->children()->arrayNode('senders')->scalarPrototype()->end()->end()->end();
        return $treeBuilder;
    }

}