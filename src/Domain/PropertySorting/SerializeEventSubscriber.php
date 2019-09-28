<?php

namespace App\Domain\PropertySorting;

use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class SerializeEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var PropertySorter
     */
    private $propertySorter;

    public function __construct(PropertySorter $propertySorter)
    {
        $this->propertySorter = $propertySorter;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['sortParams', EventPriorities::POST_SERIALIZE],
        ];
    }

    public function sortParams(ViewEvent $event)
    {
        if(
            (!$object = json_decode($event->getControllerResult()))
            || !is_object($object)
        ) {
            return $event;
        }
        $object = $this->propertySorter->sort($object);
        return $event->setControllerResult(json_encode($object));
    }
}