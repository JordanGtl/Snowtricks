<?php
namespace App\Tests\Form\Type;

use App\Entity\Member;
use App\Form\AccountType;
use App\Form\LoginType;
use Symfony\Component\Form\Test\TypeTestCase;

class LoginTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'username' => 'username',
            'plainPassword' => 'pass',
        );

        $objectToCompare = new Member();
        $form = $this->factory->create(LoginType::class, $objectToCompare);

        $object = new Member();
        $object->setPlainPassword($formData['plainPassword']);
        $object->setUsername($formData['username']);

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