<?php
namespace App\Tests\Form\Type;

use App\Entity\Member;
use App\Form\AccountType;
use App\Form\LoginType;
use App\Form\PasswordChangeType;
use App\Form\PasswordLostType;
use Symfony\Component\Form\Test\TypeTestCase;

class PasswordLostTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'email' => 'email',
        );

        $objectToCompare = new Member();
        $form = $this->factory->create(PasswordLostType::class, $objectToCompare);

        $object = new Member();
        $object->setEmail($formData['email']);

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