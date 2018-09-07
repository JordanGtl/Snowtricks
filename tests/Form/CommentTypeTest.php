<?php
namespace App\Tests\Form\Type;

use App\Entity\Comment;
use App\Entity\Member;
use App\Entity\Trick;
use App\Entity\TrickGroup;
use App\Form\AccountType;
use App\Form\CommentType;
use App\Form\LoginType;
use App\Form\PasswordChangeType;
use App\Form\PasswordLostType;
use App\Form\TrickType;
use Symfony\Component\Form\Test\TypeTestCase;

class CommentTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'content' => 'content'
        );

        $objectToCompare = new Comment();
        $form = $this->factory->create(CommentType::class, $objectToCompare);

        $object = new Comment();
        $object->setContent($formData['content']);

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