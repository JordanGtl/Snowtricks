<?php
namespace App\Tests\Entity;

use App\Entity\Trick;
use App\Entity\TrickMedia;
use App\Tests\Includes\BaseController;

class TrickMediaTest extends BaseController
{
    /** @var TrickMedia */
    private $trickmedia;

    public function setUp()
    {
        $this->trickmedia = new TrickMedia();
    }

    public function testidIsNull()
    {
        $this->assertNull($this->trickmedia->getId());
    }

    public function testLinkIsNull()
    {
        $this->assertNull($this->trickmedia->getLink());
    }

    public function testLinkIsValid()
    {
        $this->trickmedia->setLink('name');
        $this->assertEquals('name', $this->trickmedia->getLink());
    }

    public function testTempLinkIsNull()
    {
        $this->assertNull($this->trickmedia->getTempLink());
    }

    public function testTempLinkIsValid()
    {
        $this->trickmedia->setTempLink('name');
        $this->assertEquals('name', $this->trickmedia->getTempLink());
    }

    public function testTitleIsNull()
    {
        $this->assertNull($this->trickmedia->getTitle());
    }

    public function testTitleIsValid()
    {
        $this->trickmedia->setTitle('name');
        $this->assertEquals('name', $this->trickmedia->getTitle());
    }

    public function tesVideoEmbedIsNull()
    {
        $this->assertNull($this->trickmedia->getVideoEmbed());
    }

    public function testVideoEmbedIsValid()
    {
        $this->trickmedia->setVideoEmbed('name');
        $this->assertEquals('name', $this->trickmedia->getVideoEmbed());
    }

    public function testTricksExists()
    {
        $comment = new Trick();

        $this->trickmedia->addTrick($comment);

        $this->assertCount(1, $this->trickmedia->getTricks());

        $this->trickmedia->removeTrick($comment);

        $this->assertCount(0, $this->trickmedia->getTricks());
    }





}