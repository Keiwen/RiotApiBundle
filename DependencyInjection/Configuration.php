<?php


namespace Keiwen\RiotApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


class Configuration implements ConfigurationInterface
{


    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('keiwen_riot_api');

        $rootNode
            ->children()
                ->arrayNode('cdn')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('ddragon')
                            ->children()
                                ->scalarNode('version')->defaultValue('6.21.1')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('apiKey')->cannotBeEmpty()->isRequired()->end()
                ->scalarNode('server')->defaultValue('na')->end()
                ->scalarNode('outputFormat')->defaultValue('json')->end()
                ->scalarNode('cachePrefix')->defaultValue('riot.api.')->end()
                ->arrayNode('cacheLifetime')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('global')->defaultValue(86400)->end() //24 h
                        ->integerNode('regional')->defaultValue(900)->end() //15 minutes
                        ->integerNode('status')->defaultValue(300)->end() //5 minutes
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }




}
