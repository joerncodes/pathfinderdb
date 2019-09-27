<?php

namespace App\Controller;

use App\Entity\Spell;
use App\Repository\MagicSchoolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DebugController extends AbstractController
{
    /**
     * @Route("/debug", name="debug")
     */
    public function index(EntityManagerInterface $em, MagicSchoolRepository $repos)
    {
        /**
         * @var Spell
         */
        $spell = $this->getDoctrine()->getRepository(Spell::class)->find(1);
        $spell->setDescription('When laying your hand upon a living creature, you channel positive energy that cures 1d8 points of damage +1 point per caster level (maximum +5). Since undead are powered by negative energy, this spell deals damage to them instead of curing their wounds. An undead creature can apply Spell Resistance, and can attempt a Will save to take half damage.');
        $em->persist($spell);
        $em->flush();
    }
}
