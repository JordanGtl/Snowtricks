<?php
namespace App\Tests\Command;

use App\Command\InitCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateUserCommandTest extends KernelTestCase
{
public function testExecute()
{
$kernel = self::bootKernel();
$application = new Application($kernel);

$application->add(new InitCommand(null, $kernel->getContainer()->get('doctrine')->getManager()));

$command = $application->find('app:initfile');
$commandTester = new CommandTester($command);
$commandTester->execute(array(
'command'  => $command->getName(),
));

// the output of the command in the console
$output = $commandTester->getDisplay();
$this->assertContains('Finish', $output);

// ...
}
}