<?php

namespace ShopwareAttributeRestApi\Subscriber;

use Enlight\Event\SubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ControllerPath implements SubscriberInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public static function getSubscribedEvents()
    {
        return array(
            'Enlight_Controller_Dispatcher_ControllerPath_Api_Attribute' => 'getApiControllerAttribute'
        );
    }


    public function getApiControllerAttribute(\Enlight_Event_EventArgs $args)
    {
        return __DIR__ . '/../Controllers/Api/Attribute.php';
    }

    /**
     * @return void
     */
    protected function registerComponents()
    {
        $pluginDir = $this->container->getParameter('shopware_attribute_rest_api.plugin_dir');

        require_once $pluginDir . '/vendor/autoload.php';
    }

}
