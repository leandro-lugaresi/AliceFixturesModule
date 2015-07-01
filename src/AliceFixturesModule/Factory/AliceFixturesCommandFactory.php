<?php

namespace AliceFixturesModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use AliceFixturesModule\Command\AliceFixturesCommand;

/**
 * Builder the Symfony Validator
 *
 */
class AliceFixturesCommandFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Configuration');
        $loader = $serviceLocator->get('AliceFixturesModule\AliceLoader');

        $command = new AliceFixturesCommand($loader, $config['alice']['fixtures']['modules']);

        return $command;
    }
}
