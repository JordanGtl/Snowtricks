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
                ['name' => 'mute', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\FigureGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'sad', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\FigureGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'indy', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\FigureGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'stalefish', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\FigureGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'japan', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\FigureGroup_0'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => '180', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\FigureGroup_1'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'bigfoot', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\FigureGroup_1'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'frontflip', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\FigureGroup_2'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'backflip', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\FigureGroup_2'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
                ['name' => 'Backside Air', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel justo ut justo finibus vulputate vitae ut dolor. Integer nec odio eros. Aliquam eget ultrices est, nec imperdiet diam. In est massa, feugiat id erat ac, placerat varius ex. Duis blandit arcu arcu, eu efficitur erat hendrerit a. Maecenas mattis tortor sit amet odio varius molestie. Mauris molestie et neque vel rhoncus. Nulla facilisi. Pellentesque convallis arcu posuere neque eleifend iaculis. ', 'groupid' => $this->getReference('App\Entity\FigureGroup_5'), 'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9))],
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
