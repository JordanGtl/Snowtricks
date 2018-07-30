<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class TrickFixtures extends BaseFixtures implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Trick::class, 8, function(Trick $trick, $count) {

            $faker = Faker\Factory::create('fr_FR');

            $tricks = array(
                ['name' => 'mute', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\TrickGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'sad', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\TrickGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'indy', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\TrickGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'stalefish', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\TrickGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'japan', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\TrickGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => '180', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\TrickGroup_1'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'bigfoot', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\TrickGroup_1'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'frontflip', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\TrickGroup_2'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'backflip', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\TrickGroup_2'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'Backside Air', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\TrickGroup_5'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
            );

            $trick->setName($tricks[$count]['name']);
            $trick->setDescription($tricks[$count]['description']);
            $trick->setGroupid($tricks[$count]['groupid']);
            $trick->setAuthorid($tricks[$count]['authorid']);
            $trick->setPublishedAt($faker->dateTimeBetween('-100 days', 'now'));
            $trick->setUpdatedDate($faker->dateTimeBetween('-100 days', 'now'));

        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            TrickGroupFixtures::class,
            MemberFixtures::class,
        );
    }
}
