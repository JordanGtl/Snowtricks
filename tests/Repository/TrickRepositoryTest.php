<?php
namespace App\Tests\Repository;

use App\Entity\Member;
use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TrickRepositoryTest extends KernelTestCase
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
            ->getRepository(Trick::class)
            ->findActive(1)
        ;

        $this->assertNotNull($tricks);
    }

    public function testSearchByPagination()
    {
        $trick = $this->entityManager
            ->getRepository(Trick::class)
            ->findByPagination(1, 0)
        ;

        $this->assertNotNull($trick);
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