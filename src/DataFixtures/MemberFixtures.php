<?php

namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MemberFixtures extends BaseFixtures
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->encoder = $passwordEncoder;
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Member::class, 10, function(Member $member, $count)
        {
            $member->setUsername('member'.$count);
            $member->setPlainPassword('member'.$count);
            $member->setEmail('member'.$count.'@member.fr');
            $member->setPasswordToken('');
            $member->setValidationtoken('');

            $member->setPassword($this->encoder->encodePassword($member, $member->getPlainPassword()));
        });

        $manager->flush();

        $product = new Member();
        $product->setUsername('admin');
        $product->setPlainPassword("admin");
        $product->setEmail('admin@admin.fr');
        $product->setPasswordToken('');
        $product->setValidationtoken('');
        $product->setRank(array('ROLE_ADMIN'));

        $product->setPassword($this->encoder->encodePassword($product, $product->getPlainPassword()));

        $manager->persist($product);

        $manager->flush();
    }
}
