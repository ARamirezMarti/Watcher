<?php

namespace App\User\Adapter\Command\UserCreate;

use App\User\Application\UserCreator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class userCreateCommand extends command
{
    protected static $defaultDescription = 'Creates a new user.';

   
    public function __construct(private UserCreator $userCretor){

        parent::__construct();
    }
    public function configure(){

        $this->setHelp('Usage : php bin/console app:CreateUser email password');
        $this->setName("App:CreateUser");
        $this->addArgument("Email", InputArgument::REQUIRED,'User Email');
        $this->addArgument('Password', InputArgument::REQUIRED, 'User Password');
        
    } 

    public function execute(InputInterface $InputInterface , OutputInterface $OutputInterface ): int 
    {

        $email = $InputInterface->getArgument('Email');
        $password = $InputInterface->getArgument('Password');

        $this->userCretor->__invoke(['Email' => $email, 'Password' => $password]);

        $OutputInterface->writeln("User created");
        return Command::SUCCESS;
    }
}
