<?php

namespace AliceFixturesModule;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use AliceFixturesModule\Factory\FixturesFactory;

class AliceLoader
{
    /**
     * @var \Nelmio\Alice\Fixtures
     */
    private $fixtures;

    /**
     * @var FixturesFactory
     */
    private $factory;

    public function __construct(FixturesFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param Bundle      $bundle
     * @param string[]    $filters
     * @param ObjectManager $objectManager
     * @param string|null $locale
     */
    public function loadFixtures(string $path, array $filters, ObjectManager $objectManager, $locale = null)
    {
        if (false === is_dir(sprintf('%s/DataFixtures/alice', $path))) {
            return;
        }

        $files = (new Finder())
            ->files()
            ->in(sprintf('%s/DataFixtures/', $path))
            ->sortByName()
        ;

        foreach ($filters as $filter) {
            $files->name($filter);
        }

        foreach ($files as $file) {
            $this->getFixtures($objectManager, $locale)->loadFiles($file);
        }
    }

    /**
     * @param string|null $locale
     *
     * @return \Nelmio\Alice\Fixtures
     */
    private function getFixtures(ObjectManager $objectManager, $locale = null)
    {
        if (null !== $this->fixtures) {
            return $this->fixtures;
        }

        return $this->fixtures = $this->factory->create($objectManager, $locale);
    }
}
