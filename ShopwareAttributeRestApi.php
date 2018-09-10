<?php

namespace ShopwareAttributeRestApi;

use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Shopware-Plugin ShopwareAttributeRestApi.
 */
class ShopwareAttributeRestApi extends Plugin
{

    /**
    * @param ContainerBuilder $container
    */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('shopware_attribute_rest_api.plugin_dir', $this->getPath());
        parent::build($container);
    }

}
