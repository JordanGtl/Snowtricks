<?php

namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MemberFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Member::class, 10, function(Member $member, $count)
        {
            $member->setLogin('member'.$count);
            $member->setPassword(password_hash($member->getLogin().":member".$count, PASSWORD_DEFAULT));
            $member->setEmail('member'.$count.'@member.fr');
            $member->setPasswordToken('');
            $member->setValidationtoken('');
            $member->setRank(1);
        });

        $manager->flush();

        $product = new Member();
        $product->setLogin('admin');
        $product->setPassword(password_hash($product->getLogin().":admin", PASSWORD_DEFAULT));
        $product->setEmail('admin@admin.fr');
        $product->setPasswordToken('');
        $product->setValidationtoken('');
        $product->setRank(3);

        $manager->persist($product);

        $manager->flush();
    }
}
