<?php

namespace SomEnergia\MainBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;

/**
 * Class TestLoader
 */
class TestLoader extends DataFixtureLoader
{
    /**
     * @return array
     */
    protected function getFixtures()
    {
        return  array(
            __DIR__ . DIRECTORY_SEPARATOR . 'Test'. DIRECTORY_SEPARATOR . 'fixtures.yml',
        );
    }
}
