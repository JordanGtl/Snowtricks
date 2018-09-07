<?php
namespace App\Tests\Form\Type;

use App\Entity\Member;
use App\Form\AccountType;
use App\Form\MemberType;
use Symfony\Component\Form\Test\TypeTestCase;

class MemberTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'username' => 'username',
            'email' => 'email@email.fr',
            'plainPassword' => array('first' => 'pass', 'second' => 'pass'),
        );

        $objectToCompare = new Member();
        $form = $this->factory->create(MemberType::class, $objectToCompare);

        $object = new Member();
        $object->setPlainPassword($formData['plainPassword']['first']);
        $object->setEmail($formData['email']);
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