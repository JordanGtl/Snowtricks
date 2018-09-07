<?php
namespace App\Tests\Form\Type;

use App\Entity\Member;
use App\Entity\Trick;
use App\Entity\TrickGroup;
use App\Form\AccountType;
use App\Form\LoginType;
use App\Form\PasswordChangeType;
use App\Form\PasswordLostType;
use App\Form\TrickType;
use Symfony\Component\Form\Test\TypeTestCase;

class TrickTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'name' => 'name',
            'description' => 'description',
            'groupid' => new TrickGroup(),
        );

        $objectToCompare = new Trick();
        $form = $this->factory->create(TrickType::class, $objectToCompare);

        $object = new Trick();
        $object->setGroupid($formData['groupid']);
        $object->setName($formData['name']);
        $object->setDescription($formData['description']);

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