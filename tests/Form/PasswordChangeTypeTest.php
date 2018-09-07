<?php
namespace App\Tests\Form\Type;

use App\Entity\Member;
use App\Form\AccountType;
use App\Form\LoginType;
use App\Form\PasswordChangeType;
use Symfony\Component\Form\Test\TypeTestCase;

class PasswordChangeTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'plainPassword' => array('first' => 'pass', 'second' => 'pass'),
        );

        $objectToCompare = new Member();
        $form = $this->factory->create(PasswordChangeType::class, $objectToCompare);

        $object = new Member();
        $object->setPlainPassword($formData['plainPassword']['first']);

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