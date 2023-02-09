<?php

namespace App\User\Adapter\Command\UserDelete;

use App\User\Application\UserDeleter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class userDeleteCommand extends command
{

    public function __construct(private UserDeleter $userDeleter ){
        parent::__construct();
    }

    public function configure(){
        
        $this->setHelp("Command for delete an user by email");
        $this->setName("App:DeleteUser");
        $this->addArgument("Email", InputArgument::REQUIRED,'User Email');

    }

    public function execute( InputInterface $InputInterface , OutputInterface $OutputInterface ){

        $Email = $InputInterface->getArgument("Email");

        $this->userDeleter->__invoke($Email);

        $OutputInterface->writeln(sprintf("User with email %s has been deleted", $Email));
        return Command::SUCCESS;


    }
}
