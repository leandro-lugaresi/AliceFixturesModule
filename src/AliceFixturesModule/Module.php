<?php

namespace AliceFixturesModule;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\ModuleManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Loader\AutoloaderFactory;
use Zend\Loader\StandardAutoloader;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\ArgvInput;

/**
 * Base module for Alice Fixtures Module.
 *
 * @license MIT
 * @link    www.doctrine-project.org
 * @author  Leandro Lugaresi <leandrolugaresi92@gmail.com>
 */
class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAutoloaderConfig()
    {
        return array(
            AutoloaderFactory::STANDARD_AUTOLOADER => array(
                StandardAutoloader::LOAD_NS => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function init(ModuleManager $moduleManager)
    {
        $events = $moduleManager->getEventManager()->getSharedManager();
        // Attach to helper set event and load the entity manager helper.
        $events->attach('doctrine', 'loadCli.post', array($this, 'loadCli'));
    }

    /**
     *
     * @param Event $event
     */
    public function loadCli(EventInterface $event)
    {
        $serviceManager = $event->getParam('ServiceManager');

        $commands = [
            //new \AliceFixturesModule\Command\AliceFixturesCommand(array())
            $serviceManager->get('AliceFixturesModule\Command\AliceFixturesCommand'),
        ];

        foreach ($commands as $command) {
            $command->getDefinition()->addOption(
                new InputOption(
                    'objectmanager',
                    null,
                    InputOption::VALUE_OPTIONAL,
                    'The name of the documentmanager to use. If none is provided, it will use odm_default.'
                )
            );
        }

        $cli = $event->getTarget();
        $cli->addCommands($commands);

        $arguments = new ArgvInput();
        $objectManagerName = $arguments->getParameterOption('--objectmanager');
        $objectManagerName = !empty($objectManagerName) ? $objectManagerName : 'doctrine.entitymanager.odm_default';

        if ($serviceManager->has($objectManagerName)) {
            $objectManager = $serviceManager->get($objectManagerName);

            $objectHelper  = new \AliceFixturesModule\Helper\ObjectManagerHelper($objectManager);
            $cli->getHelperSet()->set($objectHelper, 'objectManager');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }
}
