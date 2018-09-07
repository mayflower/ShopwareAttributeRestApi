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
                        'Enlight_Controller_Dispatcher_ControllerPath_Api_AttributeModel' => 'getApiControllerAttributeModel'        );
    }


    public function getApiControllerAttributeModel(\Enlight_Event_EventArgs $args)
    {
        return __DIR__ . '/../Controllers/Api/AttributeModel.php';
    }


}
