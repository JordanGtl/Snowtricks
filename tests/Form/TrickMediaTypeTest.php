<?php
namespace App\Tests\Form\Type;

use App\Entity\Member;
use App\Entity\Trick;
use App\Entity\TrickGroup;
use App\Entity\TrickMedia;
use App\Form\AccountType;
use App\Form\LoginType;
use App\Form\PasswordChangeType;
use App\Form\PasswordLostType;
use App\Form\TrickMediaType;
use App\Form\TrickType;
use Symfony\Component\Form\Test\TypeTestCase;

class TrickMediaTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'Link' => 'Link',
            'videoEmbed' => 'video',
            'title' => 'title'
        );

        $objectToCompare = new TrickMedia();
        $form = $this->factory->create(TrickMediaType::class, $objectToCompare);

        $object = new TrickMedia();
        $object->setVideoEmbed($formData['videoEmbed']);
        $object->setTitle($formData['title']);

        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}