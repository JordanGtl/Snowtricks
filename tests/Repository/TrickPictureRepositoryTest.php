<?php
namespace App\Tests\Repository;

use App\Entity\Member;
use App\Entity\Trick;
use App\Entity\TrickMedia;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TrickPictureRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchByActiveTrick()
    {
        $tricks = $this->entityManager
            ->getRepository(TrickMedia::class)
            ->findAll()
        ;

        $this->assertNotNull($tricks);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }
}