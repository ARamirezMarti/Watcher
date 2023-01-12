<?php

namespace App\Library\Domain\EventSubscriber\CreateLibrarySubscriber;

use App\Library\Domain\Events\CreateLibraryEvent\CreateLibraryEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CreateLibrarySubscriber implements EventSubscriberInterface
{
    private $Logger;

    public function __construct(LoggerInterface $Logger)
    {
        $this->Logger = $Logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CreateLibraryEvent::class => ['onLibraryCreated'],
        ];
    }

    public function onLibraryCreated(CreateLibraryEvent $event)
    {
        $this->Logger->info(" ###  Library created with uuid:{$event->getUuid()}");
    }
}
