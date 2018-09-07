<?php
namespace App\Tests\Entity;

use App\Entity\Comment;
use App\Entity\Member;
use App\Entity\Trick;
use App\Entity\TrickGroup;
use App\Entity\TrickMedia;
use App\Tests\Includes\BaseController;

class TrickTest extends BaseController
{
    private $trick;

    public function setUp()
    {
        $this->trick = new Trick();
    }

    public function testIdIsNull()
    {
        $this->assertNull($this->trick->getId());
    }

    public function testNameIsNull()
    {
        $this->assertNull($this->trick->getName());
    }

    public function testNameIsValid()
    {
        $this->trick->setName('name');
        $this->assertEquals('name', $this->trick->getName());
    }

    public function testDescriptionIsNull()
    {
        $this->assertNull($this->trick->getDescription());
    }

    public function testDescriptionIsValid()
    {
        $this->trick->setDescription('description');
        $this->assertEquals('description', $this->trick->getDescription());
    }

    public function testGroupIdIsNull()
    {
        $this->assertNull($this->trick->getGroupId());
    }

    public function testGroupIdIsValid()
    {
        $group = new TrickGroup();

        $this->trick->setGroupId($group);
        $this->assertInstanceOf(TrickGroup::class, $this->trick->getGroupid());
    }

    public function testAuthoridIsNull()
    {
        $this->assertNull($this->trick->getAuthorid());
    }

    public function testAuthoridIsValid()
    {
        $group = new Member();

        $this->trick->setAuthorid($group);
        $this->assertInstanceOf(Member::class, $this->trick->getAuthorid());
    }

    public function testTrickNoComment()
    {
        $this->assertCount(0, $this->trick->getComments());
    }

    public function testTrickExistComment()
    {
        $comment = new Comment();

        $this->trick->addComment($comment);

        $this->assertCount(1, $this->trick->getComments());

        $this->trick->removeComment($comment);

        $this->assertCount(0, $this->trick->getComments());
    }

    public function testIsActive()
    {
        $this->trick->setActive(true);

        $this->assertTrue($this->trick->getActive());
    }

    public function testIsInactive()
    {
        $this->assertFalse($this->trick->getActive());
    }

    public function testPublishedAtIsNotNull()
    {
        $this->trick->setPublishedAt(new \DateTime('now'));

        $this->assertInstanceOf(\DateTimeInterface::class, $this->trick->getPublishedAt());
    }

    public function testPublishedAtIsNull()
    {
        $this->assertNull($this->trick->getPublishedAt());
    }

    public function testUpdatedDateIsNotNull()
    {
        $this->trick->setUpdatedDate(new \DateTime('now'));

        $this->assertInstanceOf(\DateTimeInterface::class, $this->trick->getUpdatedDate());
    }

    public function testUpdatedDateIsNull()
    {
        $this->assertNull($this->trick->getUpdatedDate());
    }

    public function testCoverIsNull()
    {
        $this->assertNull($this->trick->getCoverMedia());
    }

    public function testCoverIsNotNull()
    {
        $media = new TrickMedia();
        $this->trick->setCoverMedia($media);

        $this->assertInstanceOf(TrickMedia::class, $this->trick->getCoverMedia());
    }

    public function testTrickMediaIsEmpty()
    {
        $this->assertCount(0, $this->trick->getTrickMedia());
    }

    public function testTrickMediaIsNotEmpty()
    {
        $media = new TrickMedia();
        $this->trick->AddTrickMedia($media);

        $this->assertCount(1, $this->trick->getTrickMedia());

        $this->trick->removeTrickMedia($media);

        $this->assertCount(0, $this->trick->getTrickMedia());
    }



}