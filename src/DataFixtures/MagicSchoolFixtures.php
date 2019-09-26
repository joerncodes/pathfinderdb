<?php

namespace App\DataFixtures;

use App\Entity\MagicSchool;
use App\Repository\MagicSchoolRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MagicSchoolFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $schoolNames = [
            'Abujuration',
            'Conjuration',
            'Divination',
            'Enchantment',
            'Evocation',
            'Illusion',
            'Necromancy',
            'Transmutation',
            'Universal'
        ];
        foreach($schoolNames as $schoolName)
        {
            $school = new MagicSchool();
            $school->setName($schoolName);
            $school->setSlug(strtolower($school->getName()));
            $manager->persist($school);
        }

        $manager->flush();
    }
}
