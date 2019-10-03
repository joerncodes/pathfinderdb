<?php

namespace App\Domain\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Domain\PropertySorting\PropertySorter;
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
        $result = json_decode($event->getControllerResult());
        if($result === null) {
            return $event;
        }
        if(is_array($result)) {
            foreach($result as $key => $row) {
                $result[$key] = $this->propertySorter->sort($row);
            }
        } else {
            if(!is_object($result)) {
                return $event;
            }

            $result = $this->propertySorter->sort($result);
        }
        return $event->setControllerResult(json_encode($result));
    }
}