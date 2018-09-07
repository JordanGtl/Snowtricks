<?php
namespace App\Tests\Form\Type;

use App\Entity\Member;
use App\Form\AccountType;
use Symfony\Component\Form\Test\TypeTestCase;

class AccountTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'username' => null, // Non editable pour la gestion de compte
            'plainPassword' => array('first' => 'pass', 'second' => 'pass'),
        );

        $objectToCompare = new Member();
        $form = $this->factory->create(AccountType::class, $objectToCompare);

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