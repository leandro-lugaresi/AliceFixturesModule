<?php

namespace AliceFixturesModule\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class AliceFixturesCommand extends Command
{
    protected $allowedModules;

    public function __construct(array $allowedModules)
    {
        parent::__construct();
        $this->allowedModules = $allowedModules;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('alice:fixtures:load')
            ->setDescription('Automaticly load alice fixtures files.')
            ->addOption(
                'module',
                'b',
                InputOption::VALUE_OPTIONAL|InputOption::VALUE_IS_ARRAY,
                'Modules where fixtures shouls be loaded'
            )
            ->addOption(
                'filter',
                'f',
                InputOption::VALUE_OPTIONAL|InputOption::VALUE_IS_ARRAY,
                'Filter importable files via name suffix (dev => *.dev.yml).'
            )
            ->addOption(
                'locale',
                'l',
                InputOption::VALUE_OPTIONAL,
                'Locale for faked fixtures',
                'en_US'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $objectManager = $this->getHelper('objectManager')->getObjectManager();
        $modules = array();
        $filters = array();

        if (true === $input->hasOption('module')) {
            $modules = $input->getOption('module');
            $modules = $this->resolveModules($modules);
        }

        if (true === empty($modules)) {
            $modules = $this->allowedModules;
        }

        if (true === $input->hasOption('filter')) {
            $filters = array_map(
                function ($filter) {
                    return sprintf('*.%s.yml', $filter);
                },
                $input->getOption('filter')
            );
        }

        if (true === empty($filters)) {
            $filters = ['*.yml'];
        }

    }

    private function resolveModules($names)
    {
        $result = array();
        foreach ($names as $name) {
            if (false === array_key_exists($name, $this->allowedModules)) {
                throw new \RuntimeException(sprintf(
                    'Module named "%s" not found. "%s", available.',
                    $name,
                    implode('", "', array_keys($this->allowedModules))
                ));
            }
            $result[$name] = $this->allowedModules[$name];
        }

        return $result;
    }
}
