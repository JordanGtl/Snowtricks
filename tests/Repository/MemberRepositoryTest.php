<?php
namespace App\Tests\Repository;

use App\Entity\Member;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MemberRepositoryTest extends KernelTestCase
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

    public function testSearchByUsername()
    {
        $members = $this->entityManager
            ->getRepository(Member::class)
            ->loadUserByUsername('member0')
        ;

        $this->assertInstanceOf(Member::class, $members);
    }

    public function testSearchByUsernameFail()
    {
        $members = $this->entityManager
            ->getRepository(Member::class)
            ->loadUserByUsername('memberx870')
        ;

        $this->assertNull($members);
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