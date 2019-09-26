<?php

namespace App\DataFixtures;

use App\Entity\Spell;
use App\Repository\MagicSchoolRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SpellFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var MagicSchoolRepository
     */
    private $magicSchoolRepository;

    public function __construct(MagicSchoolRepository $magicSchoolRepository)
    {
        $this->magicSchoolRepository = $magicSchoolRepository;
    }

    public function load(ObjectManager $manager)
    {
        $spells = [
            [
                'name' => 'Cure Light Wounds',
                'school' => 'Conjuration',
                'slug' => 'cure-light-wounds',
                'description' => 'When laying your hand upon a living creature, you channel positive energy that cures 1d8 points of damage +1 point per caster level (maximum +5). Since undead are powered by negative energy, this spell deals damage to them instead of curing their wounds. An undead creature can apply Spell Resistance, and can attempt a Will save to take half damage.'
            ],
            [
                'name' => 'Cure Moderate Wounds',
                'school' => 'Conjuration',
                'slug' => 'cure-moderate-wounds',
                'description' => 'This spell functions like cure light wounds, except that it cures 2d8 points of damage + 1 point per caster level (maximum +10).'
            ],
            [
                'name' => 'Prestidigitation',
                'school' => 'Universal',
                'slug' => 'prestidigitation',
                'description' => 'Prestidigitations are minor tricks that novice spellcasters use for practice. Once cast, a prestidigitation spell enables you to perform simple magical effects for 1 hour. The effects are minor and have severe limitations. A prestidigitation can slowly lift 1 pound of material. It can color, clean, or soil items in a 1-foot cube each round. It can chill, warm, or flavor 1 pound of nonliving material. It cannot deal damage or affect the concentration of spellcasters. Prestidigitation can create small objects, but they look crude and artificial. The materials created by a prestidigitation spell are extremely fragile, and they cannot be used as tools, weapons, or spell components. Finally, prestidigitation lacks the power to duplicate any other spell effects. Any actual change to an object (beyond just moving, cleaning, or soiling it) persists only 1 hour.'
            ]
        ];

        foreach($spells as $spellRow)
        {
            $spell = (new Spell())
                ->setName($spellRow['name'])
                ->setSchool($this->magicSchoolRepository->findOneByName($spellRow['school']))
                ->setSlug($spellRow['slug'])
                ->setDescription($spellRow['description']);
            $manager->persist($spell);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [MagicSchoolFixtures::class];
    }
}
