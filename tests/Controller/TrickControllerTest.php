<?php
namespace App\Tests\Controller;

use App\Tests\Includes\BaseController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrickControllerTest extends BaseController
{
    public function testTricksList()
    {
        $this->PageLogoutAndLogin('/Tricks', 200, 200);
    }
	
    public function testTricksDetail()
    {
        $this->PageLogoutAndLogin('/Trick/mute', 200, 200);
    }
	
    public function testTricksDetailNoExist()
    {
        $this->PageLogoutAndLogin('/Trick/123456', 302, 302, '/Tricks');
    }
	
    public function testTricksEdit()
    {
        $this->PageLogoutAndLogin('/Trick/mute/edit', 302, 200);
    }
	
    public function testTricksEditNoExist()
    {
        $this->PageLogoutAndLogin('/Trick/123456/edit', 302, 302, '/login', '/Tricks');
    }
	
    public function testTricksNew()
    {
        $this->PageLogoutAndLogin('/TrickNew', 302, 200);
    }
	
    public function testGetComAjax()
    {
        $this->PageLogoutAndLogin('/TrickCom/mute/1', 200, 200);
    }
}