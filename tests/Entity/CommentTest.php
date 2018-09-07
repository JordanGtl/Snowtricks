<?php
namespace App\Tests\Entity;

use App\Entity\Comment;
use App\Entity\Member;
use App\Tests\Includes\BaseController;

class CommentTest extends BaseController
{
    private $comment;

    public function setUp()
    {
        $this->comment = new Comment();
    }

    public function testIdIsNull()
    {
        $this->assertNull($this->comment->getId());
    }

    public function testAuthorIdIsNull()
    {
        $this->assertNull($this->comment->getAuthorid());
    }

    public function testAuthorIdIsNotNull()
    {
        $member = new Member();

        $this->comment->setAuthorid($member);

        $this->assertInstanceOf(Member::class, $this->comment->getAuthorid());
    }

    public function testContentIsNull()
    {
        $this->assertNull($this->comment->getContent());
    }

    public function testContentIsNotNull()
    {
        $this->comment->setContent('content');

        $this->assertEquals('content', $this->comment->getContent());
    }

    public function testUpdatedDateIsNull()
    {
        $this->assertNull($this->comment->getUpdateDate());
    }

    public function testUpdatedDateIsNotNull()
    {
        $this->comment->setUpdatedate(new \DateTime("now"));

        $this->assertInstanceOf(\DateTimeInterface::class, $this->comment->getUpdatedate());
    }


}