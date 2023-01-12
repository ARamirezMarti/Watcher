<?php

namespace App\Shared\Domain\Bus\Event;

interface IEventBus
{
    public function publishEvent(Object $events): void;

}
