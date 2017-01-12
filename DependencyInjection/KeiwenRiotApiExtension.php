<?php

namespace Keiwen\RiotApiBundle\DependencyInjection;

use Keiwen\RiotApi\Api\RegionalApi;
use Keiwen\RiotApi\Dto\DtoParent;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;


class KeiwenRiotApiExtension extends ConfigurableExtension
{

    const CDN_CONF = 'keiwen_riot_api.cdn';
    const CACHE_LIFETIME_CONF = 'keiwen_riot_api.cache_lifetime';


    public function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        if(!empty($mergedConfig['cdn']['ddragon']['version'])) {
            $container->setParameter(self::CDN_CONF . ".ddragon.version", $mergedConfig['cdn']['ddragon']['version']);
        }
        foreach($mergedConfig['cacheLifetime'] as $api => $cachelt) {
            $container->setParameter(self::CACHE_LIFETIME_CONF . ".$api", $cachelt);
        }

        $container->setParameter('keiwen_riot_api.api_key', $mergedConfig['apiKey']);
        $container->setParameter('keiwen_riot_api.default_server', $mergedConfig['server']);
        $container->setParameter('keiwen_riot_api.output_format', $mergedConfig['outputFormat']);
        $container->setParameter('keiwen_riot_api.cache_prefix', $mergedConfig['cachePrefix']);

        $loader->load('services_cdn.yml');
        $loader->load('services_api.yml');
        $this->compileClasses();
    }

    protected function compileClasses()
    {
        $this->addClassesToCompile(array(
            RegionalApi::class,
            DtoParent::class,
        ));
    }
}
