<?php

namespace App\DataFixtures;

use App\Entity\TrickGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TrickGroupFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(TrickGroup::class, 6, function(TrickGroup $trick, $count, $manager)
        {
            switch($count)
            {
                case 0:
                {
                    $trick->setName('Les grabs');
                    break;
                }
                case 1:
                {
                    $trick->setName('Les rotations');
                    break;
                }
                case 2:
                {
                    $trick->setName('Les flips');
                    break;
                }
                case 3:
                {
                    $trick->setName('Les slides');
                    break;
                }
                case 4:
                {
                    $trick->setName('Les one foot tricks');
                    break;
                }
                case 5:
                {
                    $trick->setName('Old School');
                    break;
                }
            }

        });

        $manager->flush();
    }
}
