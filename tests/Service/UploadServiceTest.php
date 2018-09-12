<?php
namespace App\Tests\Service;

use App\Service\Upload;
use App\Tests\Includes\BaseController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadServiceTest extends BaseController
{
    public function testUploadNull()
    {
        $upload = new Upload();
        $return = $upload->Upload(null, 'public/images/upload');

        $this->assertNull($return);
    }

    public function testUpload()
    {
        $fileSystem = new Filesystem();

        $fileSystem->copy('public/images/figures/mute.jpg', 'public/images/figures/test.jpg');

        $file = new UploadedFile('public/images/figures/test.jpg', 'test.jpg',null, null, true);
        $upload = new Upload();

        $return = $upload->Upload($file, 'public/uploads');

        $this->assertInternalType('string', $return);

        $this->assertFileExists('public/uploads/'.$return);

		$fileSystem->remove('public/uploads/'.$return);
    }

    public function testFixtureUpload()
    {
        $upload = new Upload();

        $return = $upload->FixtureUpload('path', '180.jpg');

        $this->assertEquals('180.jpg', $return);
        $this->assertFileExists('public/uploads/medias/'.$return);
        unlink('public/uploads/medias/'.$return);
    }
}
?>