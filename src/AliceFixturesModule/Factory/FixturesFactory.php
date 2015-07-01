<?php

namespace AliceFixturesModule\Factory;

use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class FixturesFactory
{

    /**
     * @param ObjectManager $om
     * @param string|null   $locale
     *
     * @return Fixtures
     */
    public function create(ObjectManager $objectManager, $locale = null)
    {
        $options = [];

        if (null !== $locale) {
            $options['locale'] = $locale;
        }
        return new Fixtures($objectManager, $options);
    }
}
