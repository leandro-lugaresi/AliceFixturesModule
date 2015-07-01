<?php

namespace AliceFixturesModuleTest;

use AliceFixturesModuleTest\Util\ModuleLoaderFactory;

class Bootstrap
{
    /**
     * @var array
     */
    protected static $config;

    /**
     * Does the autoloaders and bootstrap configuration
     * @return void
     */
    public static function init()
    {
        static::initAutoloader();

        if (file_exists(__DIR__ . '/TestConfiguration.php')) {
            static::$config = require __DIR__ . '/TestConfiguration.php';
        } else {
            static::$config = require __DIR__ . '/TestConfiguration.php.dist';
        }

        ModuleLoaderFactory::setConfig(static::$config);
    }

    protected static function initAutoloader()
    {
        ini_set('error_reporting', E_ALL);

        $files = array(__DIR__ . '/../vendor/autoload.php', __DIR__ . '/../../../vendor/autoload.php');

        foreach ($files as $file) {
            if (file_exists($file)) {
                $loader = require $file;
                break;
            }
        }

        if (! isset($loader)) {
            throw new RuntimeException('vendor/autoload.php could not be found.');
        }

        $loader->add('AliceFixturesModuleTest\\', __DIR__);
    }
}

Bootstrap::init();
