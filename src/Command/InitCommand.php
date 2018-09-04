<?php
namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class InitCommand extends Command
{
    private $em;

    public function __construct(?string $name = null, EntityManagerInterface $em)
    {
        parent::__construct($name);

        $this->em = $em;
    }

    protected function configure()
    {
        $this->setName('app:initfile')
            ->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user...');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileSystem = new Filesystem();
        $output->writeln('Initialisation en cour ...');

        if(!$fileSystem->exists('public/uploads'))
        {
            $fileSystem->mkdir('public/uploads', 0777);
        }

        if(!$fileSystem->exists('public/uploads/medias'))
        {
            $fileSystem->mkdir('public/uploads/medias', 0777);
        }

        if(!$fileSystem->exists('public/uploads/avatars'))
        {
            $fileSystem->mkdir('public/uploads/avatars', 0777);
        }

        if(!$fileSystem->exists('public/uploads/figures'))
        {
            $fileSystem->mkdir('public/uploads/figures', 0777);
        }

        $output->writeln('Finish');
    }
}