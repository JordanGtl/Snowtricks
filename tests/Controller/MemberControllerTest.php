<?php
namespace App\Tests\Controller;

use App\Tests\Includes\BaseController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MemberControllerTest extends BaseController
{
    public function testRegister()
    {
        $this->PageLogoutAndLogin('/register', 200, 200);
    }
	
    public function testLogin()
    {
        $this->PageLogoutAndLogin('/login', 200, 200);
    }
	
    public function testLogout()
    {
        $this->PageLogoutAndLogin('/logout', 302, 302, '/');
    }
	
    public function testMyAccount()
    {
        $this->PageLogoutAndLogin('/MyAccount', 302, 200);
    }
	
    public function testLostPassword()
    {
        $this->PageLogoutAndLogin('/LostPassword', 200, 200);
    }
	
    public function testActiveAcc()
    {
        $this->PageLogoutAndLogin('/Activate/123456', 200, 200);
    }
	
    public function testPasswordChange()
    {
        $this->PageLogoutAndLogin('/PasswordChange/123456', 200, 200);
    }
}