<?php
namespace App\Tests\Repository;

use App\Entity\Comment;
use App\Entity\Member;
use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommentRepositoryTest extends KernelTestCase
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

    public function testCommentByLimit()
    {
        $trick = $this->entityManager
            ->getRepository(Trick::class)
            ->findAll()[0];


        $comments = $this->entityManager
            ->getRepository(Comment::class)
            ->findWithLimit($trick, 2, 0)
        ;

        $this->assertNotNull($comments);
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