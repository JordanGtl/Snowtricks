<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class CommentFixtures extends BaseFixtures implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Comment::class, 20, function(Comment $comment, $count)
        {
            $faker = Faker\Factory::create('fr_FR');

            $comment->setAuthorid($this->getReference('App\Entity\Member_'.rand(0, 9)));
            $comment->setFigureid($this->getReference('App\Entity\Figure_'.rand(0, 7)));
            $comment->setUpdatedate($faker->dateTimeBetween('-100 days', 'now'));
            $comment->setContent($faker->realText(200, 2));
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            FigureGroupFixtures::class,
            MemberFixtures::class,
            FigureFixtures::class,
        );
    }
}
