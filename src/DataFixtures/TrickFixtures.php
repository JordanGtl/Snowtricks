<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use App\Entity\TrickMedia;
use App\Service\Upload;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TrickFixtures extends BaseFixtures implements DependentFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function AddMedia(&$trick, $image, ObjectManager $manager)
    {
        $upload = new Upload();

        $media = new TrickMedia();
        $media->setIdFigure($trick);
        $media->setLink($upload->FixtureUpload('../../public/uploads/medias', $image));
        $media->setTitle('Ajouter via une fixture');
        $media->setVideoEmbed('');
        $manager->persist($media);

        $trick->addTrickMedia($media);

        if(count($trick->getTrickMedia()) == 1)
            $trick->setCoverMedia($media);
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Trick::class, 8, function(Trick $trick, $count, $manager) {

            $faker = Faker\Factory::create('fr_FR');

            $tricks = array(
                [
                    'name' => 'mute',
                    'description' => 'Considéré comme la base du grab, le mute consiste à saisir sa planche entre les pieds à l\'aide de la main avant.',
                    'groupid' => $this->getReference('App\Entity\TrickGroup_0'),
                    'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9)),
                    'picture' => ['mute.jpg', 'mute2.jpg', 'mute3.jpg']
                ],
                [
                    'name' => 'sad',
                    'description' => 'Pour réaliser cette figure il suffit de tenir son snowboard de la main entre les talons',
                    'groupid' => $this->getReference('App\Entity\TrickGroup_0'),
                    'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9)),
                    'picture' => ['sad.jpg']
                ],
                [
                    'name' => 'indy',
                    'description' => 'Considéré comme la base du grab, l\'indy consiste à saisir sa planche entre les pieds à l\'aide de la main arrière.',
                    'groupid' => $this->getReference('App\Entity\TrickGroup_0'),
                    'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9)),
                    'picture' => ['indy.jpg', 'indy2.jpg']
                ],
                [
                    'name' => 'stalefish',
                    'description' => 'Pour éffectuer cette figure il vous suffit de placer la main arrière entre les pieds sur la carre back ',
                    'groupid' => $this->getReference('App\Entity\TrickGroup_0'),
                    'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9)),
                    'picture' => ['stalefish.jpg']
                ],
                [
                    'name' => 'japan',
                    'description' => 'Cette figure ressemble au Mute avec une difficulté supplémentaire, la spatule votre planche doit être orientée vers le ciel ',
                    'groupid' => $this->getReference('App\Entity\TrickGroup_0'),
                    'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9)),
                    'picture' => ['japan.jpg']
                ],
                [
                    'name' => '180',
                    'description' => 'Pour réaliser cette figure vous devez faire une rotation de 180° avec votre snowboard',
                    'groupid' => $this->getReference('App\Entity\TrickGroup_1'),
                    'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9)),
                    'picture' => ['180.jpg']
                ],
                [
                    'name' => 'bigfoot',
                    'description' => 'Pour réaliser cette figure vous devez éffectuer un saut avec une rotation de trois tours complets (souvent abrégé 100-8 ou 10)',
                    'groupid' => $this->getReference('App\Entity\TrickGroup_1'),
                    'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9)),
                    'picture' => ['1080.jpg']
                ],
                [
                    'name' => 'frontflip',
                    'description' => 'Cette figure de consiste à faire un tour sur soi même vers l’avant pendant que vous êtes dans les airs.',
                    'groupid' => $this->getReference('App\Entity\TrickGroup_2'),
                    'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9)),
                    'picture' => ['front.jpg']
                ],
                [
                    'name' => 'backflip',
                    'description' => 'Cette figure de consiste à faire un tour sur soi même vers l’arrière pendant que vous êtes dans les airs.',
                    'groupid' => $this->getReference('App\Entity\TrickGroup_2'),
                    'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9)),
                    'picture' => ['back']
                ],
                [
                    'name' => 'Backside Air',
                    'description' => 'Cette figure demande d\'éffectuer un virage de dos ou partie dos du surf dans les airs',
                    'groupid' => $this->getReference('App\Entity\TrickGroup_5'),
                    'authorid' => $this->getReference('App\Entity\Member_'.rand(0, 9)),
                    'picture' => ['backside.jpg']
                ],
            );

            $trick->setName($tricks[$count]['name']);
            $trick->setDescription($tricks[$count]['description']);
            $trick->setGroupid($tricks[$count]['groupid']);
            $trick->setAuthorid($tricks[$count]['authorid']);
            $trick->setPublishedAt($faker->dateTimeBetween('-100 days', '-50 days'));
            $trick->setActive(true);

            if(rand(0, 1) == 1)
                $trick->setUpdatedDate($faker->dateTimeBetween('-49 days', 'now'));
            else
                $trick->setUpdatedDate($trick->getPublishedAt());

            if(isset($tricks[$count]['picture']))
            {
                foreach($tricks[$count]['picture'] as $picture)
                $this->AddMedia($trick, $picture, $manager);
            }



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
