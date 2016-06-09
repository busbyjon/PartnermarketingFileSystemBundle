<?php

namespace Partnermarketing\FileSystemBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('partnermarketing_file_system');

        $rootNode
            ->children()
                ->scalarNode('default_file_system')
                    ->isRequired()
                ->end()
                ->scalarNode('tmp_dir')
                    ->defaultValue('/tmp')
                ->end()
                ->arrayNode('config')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('amazon_s3')
                            ->children()
                                ->scalarNode('key')
                                    ->defaultValue('~')
                                ->end()
                                ->scalarNode('secret')
                                    ->defaultValue('~')
                                ->end()
                                ->scalarNode('bucket')
                                    ->defaultValue('~')
                                ->end()
                                ->scalarNode('region')
                                    ->defaultValue('~')
                                ->end()
                                ->scalarNode('endpoint')
                                    ->defaultValue('~')
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('local_storage')
                            ->children()
                                ->scalarNode('path')
                                    ->isRequired()
                                ->end()
                                ->scalarNode('url')
                                    ->isRequired()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
