<?php

namespace AliceFixturesModuleTest;

use PHPUnit_Framework_TestCase;
use AliceFixturesModuleTest\Util\ModuleLoaderFactory;

class CliTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Symfony\Component\Console\Application
     */
    protected $cli;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $serviceManager     = ModuleLoaderFactory::getModuleLoader()->getServiceManager();
        /* @var $sharedEventManager \Zend\EventManager\SharedEventManagerInterface */
        $sharedEventManager = $serviceManager->get('SharedEventManager');
        /* @var $application \Zend\Mvc\Application */
        $application        = $serviceManager->get('Application');
        $invocations        = 0;

        $sharedEventManager->attach(
            'doctrine',
            'loadCli.post',
            function () use (&$invocations) {
                $invocations += 1;
            }
        );

        $application->bootstrap();
        $this->entityManager = $serviceManager->get('doctrine.entitymanager.orm_default');
        $this->cli           = $serviceManager->get('doctrine.cli');
        $this->assertSame(1, $invocations);
    }


    public function testValidCommands()
    {
        $this->assertInstanceOf('AliceFixturesModule\Command\AliceFixturesCommand', $this->cli->get('alice:fixtures:load'));
    }
}
