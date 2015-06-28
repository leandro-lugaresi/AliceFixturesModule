<?php

namespace AliceFixturesModule\Command;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Builder the Symfony Validator
 *
 */
class AliceFixturesCommandFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Configuration');
        $command = new AliceFixturesCommand($config['alice']['fixtures']['modules']);

        return $command;
    }
}
