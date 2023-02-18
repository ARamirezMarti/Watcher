<?php

namespace App\User\Domain\EventSubscribers;
use App\Shared\Domain\Mailing\DomainMailerInterface;
use App\User\Domain\Events\UserCreatedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserCreatedSubscriber implements EventSubscriberInterface
{
    private $Logger;
    private $Emailer;

    public function __construct(LoggerInterface $Logger,DomainMailerInterface $Emailer)
    {
        $this->Logger = $Logger;
        $this->Emailer = $Emailer;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            UserCreatedEvent::class => ['sendWelcomeEmail'],
        ];
    }

    public function sendWelcomeEmail(userCreatedEvent $event)
    {
        $this->Logger->info(" ### User created ");
       
        $this->Emailer->prepare($event->getUserEmail(),"Welcome to Watcher!","<h1>Welcome</h1>");
        $this->Emailer->send();
    }
}
