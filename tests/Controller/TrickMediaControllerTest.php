<?php
namespace App\Tests\Controller;

use App\Tests\Includes\BaseController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrickMediaControllerTest extends BaseController
{
    public function testMediaDel()
    {
        $this->PageLogoutAndLogin('/MediaDel/0', 302, 200);
    }
	
    public function testMediaSetCover()
    {
        $this->PageLogoutAndLogin('/MediaSetCover/mute/0', 302, 200);
    }
	
    public function testTricksMediaAdd()
    {
        $this->PageLogoutAndLogin('/Trick/mute/addmedia', 302, 200);
    }
	
    public function testTricksMediaAddNoExist()
    {
        $this->PageLogoutAndLogin('/Trick/123456/addmedia', 302, 302, '/login', '/Tricks');
    }
	
    public function testTricksMediaEdit()
    {
        $this->PageLogoutAndLogin('/MediaEdit/1', 302, 200, '/login');
    }
	
    public function testTricksMediaEditNoExist()
    {
        $this->PageLogoutAndLogin('/MediaEdit/0', 302, 302, '/login', '/Tricks');
    }
	
}