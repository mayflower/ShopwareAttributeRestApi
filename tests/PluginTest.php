<?php

namespace ShopwareAttributeRestApi\Tests;

use ShopwareAttributeRestApi\ShopwareAttributeRestApi as Plugin;
use Shopware\Components\Test\Plugin\TestCase;

class PluginTest extends TestCase
{
    protected static $ensureLoadedPlugins = [
        'ShopwareAttributeRestApi' => []
    ];

    public function testCanCreateInstance()
    {
        /** @var Plugin $plugin */
        $plugin = Shopware()->Container()->get('kernel')->getPlugins()['ShopwareAttributeRestApi'];

        $this->assertInstanceOf(Plugin::class, $plugin);
    }
}
