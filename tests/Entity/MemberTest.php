<?php
namespace App\Tests\Entity;

use App\Entity\Comment;
use App\Entity\Member;
use App\Entity\Trick;
use App\Entity\TrickGroup;
use App\Entity\TrickMedia;
use App\Tests\Includes\BaseController;

class MemberTest extends BaseController
{
    /** @var Member */
    private $member;

    public function setUp()
    {
        $this->member = new Member();
    }

    public function testIdIsNull()
    {
        $this->assertNull($this->member->getId());
    }

    public function testUsernameIsNull()
    {
        $this->assertNull($this->member->getUsername());
    }

    public function testUsernameIsValid()
    {
        $this->member->setUsername('name');
        $this->assertEquals('name', $this->member->getUsername());
    }

    public function testPlainPasswordnIsNull()
    {
        $this->assertNull($this->member->getPlainPassword());
    }

    public function testPlainPasswordIsValid()
    {
        $this->member->setPlainPassword('password');
        $this->assertEquals('password', $this->member->getPlainPassword());
    }

    public function testPasswordIdIsNull()
    {
        $this->assertNull($this->member->getPassword());
    }

    public function testPasswordIsValid()
    {
        $this->member->setPassword('password');
        $this->assertEquals('password', $this->member->getPassword());
    }

    public function testEmailIsNull()
    {
        $this->assertNull($this->member->getEmail());
    }

    public function testEmailIsValid()
    {
        $this->member->setEmail('email');
        $this->assertEquals('email', $this->member->getEmail());
    }

    public function testValidationTokenIsNull()
    {
        $this->assertNull($this->member->getValidationToken());
    }

    public function testValidationTokenIsValid()
    {
        $this->member->setValidationToken('ValidationToken');
        $this->assertEquals('ValidationToken', $this->member->getValidationToken());
    }

    public function testPasswordTokenIsNull()
    {
        $this->assertNull($this->member->getPasswordToken());
    }

    public function testPasswordTokenIsValid()
    {
        $this->member->setPasswordToken('PasswordToken');
        $this->assertEquals('PasswordToken', $this->member->getPasswordToken());
    }

    public function testAvatarIsNull()
    {
        $this->assertNull($this->member->getAvatar());
    }

    public function testAvatarIsValid()
    {
        $this->member->setAvatar('avatar');
        $this->assertEquals('avatar', $this->member->getAvatar());
    }

    public function testSaveAvatarIsNull()
    {
        $this->assertNull($this->member->getAvatar());
    }

    public function testSaveAvatarIsValid()
    {
        $this->member->setSaveAvatar('saveavatar');
        $this->assertEquals('saveavatar', $this->member->getSaveAvatar());
    }

    public function testGetSaltIsNull()
    {
        $this->assertNull($this->member->getSalt());
    }

    public function testEraseCredentialsIsNull()
    {
        $this->assertNull($this->member->eraseCredentials());
    }

    public function testSerializeIsNotNull()
    {
        $this->assertNotNull($this->member->serialize());
    }

    public function testUnserialiazeIsNotNull()
    {
        $serialize = $this->member->serialize();

        $this->assertNull($this->member->unserialize($serialize));
    }

    public function testIsEnabledIsNull()
    {
        $this->assertFalse($this->member->isEnabled());
    }

    public function testIsCredentialNonExpiredIsNull()
    {
        $this->assertTrue($this->member->isCredentialsNonExpired());
    }

    public function testIsAccountNonExpiredIsNull()
    {
        $this->assertTrue($this->member->isAccountNonExpired());
    }

    public function testIsAccountNonLockedIsNull()
    {
        $this->assertTrue($this->member->isAccountNonLocked());
    }

    public function testActiveIsNull()
    {
        $this->assertFalse($this->member->getActive());
    }

    public function testActiveIsValid()
    {
        $this->member->setActive(true);
        $this->assertTrue($this->member->getActive());
    }

    public function testRankIsNull()
    {
        $this->assertEquals(['0' => 'ROLE_USER'], $this->member->getRank());
    }

    public function testRankIsValid()
    {
        $this->member->setRank(['Rank']);
        $this->assertEquals(['Rank'], $this->member->getRank());
        $this->assertEquals(['Rank'], $this->member->getRoles());
    }

    public function testFiguresExists()
    {
        $trick = new Trick();

        $this->member->addFigure($trick);

        $this->assertCount(1, $this->member->getFigures());

        $this->member->removeFigure($trick);

        $this->assertCount(0, $this->member->getFigures());
    }

    public function testCommentsExists()
    {
        $comment = new Comment();

        $this->member->addComment($comment);

        $this->assertCount(1, $this->member->getComments());

        $this->member->removeComment($comment);

        $this->assertCount(0, $this->member->getComments());
    }


    /*

    public function testGroupIdIsValid()
    {
        $group = new TrickGroup();

        $this->member->setGroupId($group);
        $this->assertInstanceOf(TrickGroup::class, $this->member->getGroupid());
    }

    public function testAuthoridIsNull()
    {
        $this->assertNull($this->member->getAuthorid());
    }

    public function testAuthoridIsValid()
    {
        $group = new Member();

        $this->member->setAuthorid($group);
        $this->assertInstanceOf(Member::class, $this->member->getAuthorid());
    }

    public function testTrickNoComment()
    {
        $this->assertCount(0, $this->member->getComments());
    }

    public function testTrickExistComment()
    {
        $comment = new Comment();

        $this->member->addComment($comment);

        $this->assertCount(1, $this->member->getComments());

        $this->member->removeComment($comment);

        $this->assertCount(0, $this->member->getComments());
    }

    public function testIsActive()
    {
        $this->member->setActive(true);

        $this->assertTrue($this->member->getActive());
    }

    public function testIsInactive()
    {
        $this->assertFalse($this->member->getActive());
    }

    public function testPublishedAtIsNotNull()
    {
        $this->member->setPublishedAt(new \DateTime('now'));

        $this->assertInstanceOf(\DateTimeInterface::class, $this->member->getPublishedAt());
    }

    public function testPublishedAtIsNull()
    {
        $this->assertNull($this->member->getPublishedAt());
    }

    public function testUpdatedDateIsNotNull()
    {
        $this->member->setUpdatedDate(new \DateTime('now'));

        $this->assertInstanceOf(\DateTimeInterface::class, $this->member->getUpdatedDate());
    }

    public function testUpdatedDateIsNull()
    {
        $this->assertNull($this->member->getUpdatedDate());
    }

    public function testCoverIsNull()
    {
        $this->assertNull($this->member->getCoverMedia());
    }

    public function testCoverIsNotNull()
    {
        $media = new TrickMedia();
        $this->member->setCoverMedia($media);

        $this->assertInstanceOf(TrickMedia::class, $this->member->getCoverMedia());
    }

    public function testTrickMediaIsEmpty()
    {
        $this->assertCount(0, $this->member->getTrickMedia());
    }

    public function testTrickMediaIsNotEmpty()
    {
        $media = new TrickMedia();
        $this->member->AddTrickMedia($media);

        $this->assertCount(1, $this->member->getTrickMedia());

        $this->member->removeTrickMedia($media);

        $this->assertCount(0, $this->member->getTrickMedia());
    }*/



}