<?php

namespace Kozhilya\BreadcrumbsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('kozhilya_breadcrumbs');

        /** @noinspection PhpUndefinedMethodInspection */
        return $treeBuilder->getRootNode()
            ->children()
            ->arrayNode('service_namespaces')
            ->scalarPrototype()
            ->end() // service_namespaces.prototype
            ->end() // service_namespaces
            ->scalarNode('template')->defaultValue('@KozhilyaBreadcrumbs/simple.html.twig')->end()
            ->end() // root.children
            ->end();
    }
}
