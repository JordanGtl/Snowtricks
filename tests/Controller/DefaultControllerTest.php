<?php
namespace App\Tests\Controller;

use App\Tests\Includes\BaseController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends BaseController
{
    public function testIndex()
    {
        $this->PageLogoutAndLogin('/', 200, 200);
    }
	
    public function testMl()
    {
        $this->PageLogoutAndLogin('/MentionsLegales', 200, 200);
    }
}