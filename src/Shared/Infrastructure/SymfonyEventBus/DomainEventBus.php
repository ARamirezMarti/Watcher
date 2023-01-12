<?php

namespace App\Shared\Infrastructure\SymfonyEventBus;

use App\Shared\Domain\Bus\Event\IEventBus;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DomainEventBus implements IEventBus
{

    private $SymfonyEventDispatcher;
    
    public function __construct(EventDispatcherInterface $eventDispatcher) {

        $this->SymfonyEventDispatcher = $eventDispatcher;
    }



    /**
     * @param object $events
     */
    public function publishEvent(object $event): void {

        $this->SymfonyEventDispatcher->dispatch($event);
    }
}
