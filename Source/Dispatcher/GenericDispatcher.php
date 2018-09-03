<?php

namespace ElusiveDocks\BackBone\Source\Dispatcher;

use ElusiveDocks\BackBone\Contract\DispatcherInterface;
use ElusiveDocks\BackBone\Contract\EventInterface;
use ElusiveDocks\BackBone\Source\Event\GenericEvent;

/**
 * Class GenericDispatcher
 * @package ElusiveDocks\BackBone\Source\Dispatcher
 */
class GenericDispatcher extends AbstractDispatcher implements DispatcherInterface
{
    /**
     * {@inheritdoc}
     */
    public function dispatch(string $eventName, EventInterface $event = null): EventInterface
    {
        if (null === $event) {
            $event = new GenericEvent();
        }

        if (($listeners = $this->getListeners($eventName))) {
            $this->doDispatch($listeners, $eventName, $event);
        }

        return $event;
    }

    /**
     * Triggers the listeners of an event.
     *
     * @param callable[] $listeners The event listeners
     * @param string $eventName The name of the event to dispatch
     * @param EventInterface $event The event object to pass to the event handlers/listeners
     */
    protected function doDispatch($listeners, string $eventName, EventInterface $event)
    {
        foreach ($listeners as $listener) {
            if ($event->isPropagationStopped()) {
                break;
            }
            \call_user_func($listener, $event, $eventName, $this);
        }
    }
}
