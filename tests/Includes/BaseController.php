<?php
namespace App\Tests\Includes;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseController extends WebTestCase
{
    protected $client = null;

    protected function logIn()
    {
        $this->client = static::createClient( array (), array (
            'PHP_AUTH_USER' => 'admin' ,
            'PHP_AUTH_PW'   => 'admin' ,
        ));
    }

    protected function PageLogoutAndLogin($url, $codelogout = 302, $codelogin = 200, $redirect='/login', $redirectlogin='/login')
    {
        # Logout Test
        $client = static::createClient();
        $client->request('GET', $url);
        $this->assertEquals($codelogout, $client->getResponse()->getStatusCode());

        if($codelogout == 302)
		{
			$this->assertEquals($redirect, $this->cutUrl($client->getResponse()->headers->all()['location'][0]));
		}

        # login test
        $this->logIn();
        $this->client->request('GET', $url);		
        //$this->assertEquals($codelogin, $this->client->getResponse()->getStatusCode());
		
		if($codelogin == 302)
		{
			//$this->assertEquals($redirectlogin, $this->cutUrl($this->client->getResponse()->headers->all()['location'][0]));
		}
    }
	
	protected function cutUrl($url)
    {		
		if(stripos($url, 'http') !== false)
		{
			$explode = explode('/', $url);
			$retour = '';

			for($i = 3; $i < count($explode); ++$i)
			{
				$retour .= '/'.$explode[$i];
			}

			return $retour;
		}
		else
		{
			return $url;
		}
    }
}