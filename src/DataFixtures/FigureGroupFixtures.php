<?php

namespace App\DataFixtures;

use App\Entity\FigureGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class FigureGroupFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(FigureGroup::class, 6, function(FigureGroup $figure, $count)
        {
            switch($count)
            {
                case 0:
                {
                    $figure->setName('Les grabs');
                    break;
                }
                case 1:
                {
                    $figure->setName('Les rotations');
                    break;
                }
                case 2:
                {
                    $figure->setName('Les flips');
                    break;
                }
                case 3:
                {
                    $figure->setName('Les slides');
                    break;
                }
                case 4:
                {
                    $figure->setName('Les one foot tricks');
                    break;
                }
                case 5:
                {
                    $figure->setName('Old School');
                    break;
                }
            }

        });

        $manager->flush();
    }
}
