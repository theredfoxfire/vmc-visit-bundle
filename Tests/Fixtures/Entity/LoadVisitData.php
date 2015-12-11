<?php

namespace Vmc\VisitBundle\Tests\Fixtures\Entity;

use Vmc\VisitBundle\Entity\Visit;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadVisitData implements FixtureInterface
{
    static public $visits = array();

    public function load(ObjectManager $manager)
    {
        $visit = new Visit();
        $visit->setTitle('title');
        $visit->setBody('body');

        $manager->persist($visit);
        $manager->flush();

        self::$visits[] = $visit;
    }
}
