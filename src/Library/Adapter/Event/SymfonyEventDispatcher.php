<?php

namespace App\Library\Adapter\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;

class SymfonyEventDispatcher extends EventDispatcher
{

    public function sendEvent(object $event, string $eventName = null){
        $this->dispatch($event, $eventName);
    }
}
