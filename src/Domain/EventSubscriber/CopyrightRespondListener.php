<?php

namespace App\Domain\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class CopyrightRespondListener implements EventSubscriberInterface
{
    private $copyrightNotice;

    public function __construct($copyrightNotice)
    {
        $this->copyrightNotice = $copyrightNotice;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * ['eventName' => 'methodName']
     *  * ['eventName' => ['methodName', $priority]]
     *  * ['eventName' => [['methodName1', $priority], ['methodName2']]]
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['addCopyright', EventPriorities::PRE_RESPOND],
        ];
    }

    public function addCopyRight(ViewEvent $event)
    {
        $result = $event->getControllerResult();
        if(!is_object($result) || !$decodedResult = json_decode($result))
        {
            return $event;
        }
        $decodedResult->copyright = $this->copyrightNotice;
        $result = json_encode($decodedResult);

        return $event->setControllerResult($result);
    }
}