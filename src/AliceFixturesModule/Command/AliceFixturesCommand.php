<?php

namespace AliceFixturesModule\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class AliceFixturesCommand extends Command
{
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
                'connection',
                'c',
                InputOption::VALUE_OPTIONAL,
                'Doctrine connection to use',
                'default'
            )
            ->addOption(
                'locale',
                'l',
                InputOption::VALUE_OPTIONAL,
                'Locale for faked fixtures',
                'en_US'
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dm = $this->getHelper('objectManager')->getObjectManager();
        

    }
}
