<?php

namespace AliceFixturesModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use AliceFixturesModule\AliceLoader;

/**
 * Builder the Symfony Validator
 *
 */
class AliceLoaderFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $loader = new AliceLoader(new FixturesFactory());

        return $loader;
    }
}
