<?php

namespace Kozhilya\BreadcrumbsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('kozhilya_breadcrumbs');

        return $treeBuilder->getRootNode()
            ->children()
//            ->scalarNode('loader_class')->isRequired()->end()
            ->arrayNode('service_namespaces')
            ->scalarPrototype()
            ->end() // service_namespaces.prototype
            ->end() // service_namespaces
            ->scalarNode('template')->defaultValue('@KozhilyaBreadcrumbs/simple.html.twig')->end()
            ->end() // root.children
            ->end();
    }
}