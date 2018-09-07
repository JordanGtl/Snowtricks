<?php
namespace App\Tests\Entity;

use App\Entity\Comment;
use App\Entity\Member;
use App\Entity\Trick;
use App\Entity\TrickGroup;
use App\Entity\TrickMedia;
use App\Tests\Includes\BaseController;

class TrickGroupTest extends BaseController
{
    private $group;

    public function setUp()
    {
        $this->group = new TrickGroup();
    }

    public function testIdIsNull()
    {
        $this->assertNull($this->group->getId());
    }

    public function testNameIsNull()
    {
        $this->assertNull($this->group->getName());
    }

    public function testNameIsValid()
    {
        $this->group->setName('name');
        $this->assertEquals('name', $this->group->getName());
    }

    public function testFiguresIsEmpty()
    {
        $this->assertCount(0, $this->group->getFigures());
    }

    public function testFiguresIsNotEmpty()
    {
        $trick = new Trick();

        $this->group->addFigure($trick);
        $this->assertCount(1, $this->group->getFigures());

        $this->group->removeFigure($trick);
        $this->assertCount(0, $this->group->getFigures());
    }

    public function testToString()
    {
        $this->group->setName('name');
        $this->assertEquals('name', $this->group->__toString());
    }
}