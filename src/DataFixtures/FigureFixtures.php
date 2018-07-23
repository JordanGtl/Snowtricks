<?php

namespace App\DataFixtures;

use App\Entity\Figure;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FigureFixtures extends BaseFixtures implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Figure::class, 8, function(Figure $figure, $count) {

            $figures = array(
                ['name' => 'mute', 'description' => '', 'groupid' => $this->getReference('App\Entity\FigureGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'sad', 'description' => '', 'groupid' => $this->getReference('App\Entity\FigureGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'indy', 'description' => '', 'groupid' => $this->getReference('App\Entity\FigureGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'stalefish', 'description' => '', 'groupid' => $this->getReference('App\Entity\FigureGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'japan', 'description' => '', 'groupid' => $this->getReference('App\Entity\FigureGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => '180', 'description' => '', 'groupid' => $this->getReference('App\Entity\FigureGroup_1'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'bigfoot', 'description' => '', 'groupid' => $this->getReference('App\Entity\FigureGroup_1'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'frontflip', 'description' => '', 'groupid' => $this->getReference('App\Entity\FigureGroup_2'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'backflip', 'description' => '', 'groupid' => $this->getReference('App\Entity\FigureGroup_2'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'Backside Air', 'description' => '', 'groupid' => $this->getReference('App\Entity\FigureGroup_5'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
            );

            $figure->setName($figures[$count]['name']);
            $figure->setDescription($figures[$count]['description']);
            $figure->setGroupid($figures[$count]['groupid']);
            $figure->setAuthorid($figures[$count]['authorid']);

        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            FigureGroupFixtures::class,
            MemberFixtures::class,
        );
    }
}
