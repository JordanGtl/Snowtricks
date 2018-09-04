<?php
namespace App\Tests\Service;

use App\Service\Upload;
use App\Tests\Includes\BaseController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadServiceTest extends BaseController
{
    public function testUpload()
    {
        $fileSystem = new Filesystem();

        $fileSystem->copy('public/images/figures/mute.jpg', 'public/images/figures/test.jpg');

        $file = new UploadedFile('public/images/figures/test.jpg', 'test.jpg',null, null, true);
        $upload = new Upload();

        $return = $upload->Upload($file, 'public/images/upload');

        $this->assertInternalType('string', $return);
		
		$fileSystem->remove('public/images/upload/'.$return);
    }
}
?>