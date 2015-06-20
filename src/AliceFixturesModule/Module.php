<?php

namespace AliceFixturesModule;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\ModuleManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

/**
 * Base module for Alice Fixtures Module.
 *
 * @license MIT
 * @link    www.doctrine-project.org
 * @author  Leandro Lugaresi <leandrolugaresi92@gmail.com>
 */
class Module implements
    AutoloaderProviderInterface,
    ServiceProviderInterface,
    ConfigProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                ),
            ),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function init(ModuleManager $e)
    {
        $events = $e->getEventManager()->getSharedManager();

        // Attach to helper set event and load the entity manager helper.
        $events->attach('doctrine', 'loadCli.post', function (EventInterface $e) {
            /* @var $cli \Symfony\Component\Console\Application */
            $cli = $e->getTarget();

            /* @var $sm ServiceLocatorInterface */
            $sm = $e->getParam('ServiceManager');
            $em = $cli->getHelperSet()->get('em')->getEntityManager();
            //Import the commands
        });
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

}
