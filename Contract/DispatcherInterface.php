<?php

namespace ElusiveDocks\Dispatcher\Contract;

/**
 * Interface DispatcherInterface
 * @package ElusiveDocks\Dispatcher\Contract
 */
interface DispatcherInterface
{
    /**
     * Dispatches an event to all registered listeners.
     *
     * @param string $eventName The name of the event to dispatch. The name of
     *                          the event is the name of the method that is
     *                          invoked on listeners.
     * @param EventInterface|null $event The event to pass to the event handlers/listeners
     *                          If not supplied, an empty Event instance is created
     * @return EventInterface
     */
    public function dispatch(string $eventName, EventInterface $event = null): EventInterface;

    /**
     * Adds an event listener that listens on the specified events.
     *
     * @param string $eventName The event to listen on
     * @param callable $listener The listener
     * @param int $priority The higher this value, the earlier an event
     *                            listener will be triggered in the chain (defaults to 0)
     */
    public function addListener(string $eventName, $listener, int $priority = 0);

    /**
     * Removes an event listener from the specified events.
     *
     * @param string $eventName The event to remove a listener from
     * @param callable $listener The listener to remove
     */
    public function removeListener(string $eventName, $listener);

    /**
     * Gets the listeners of a specific event or all listeners sorted by descending priority.
     *
     * @param string $eventName The name of the event
     *
     * @return array
     */
    public function getListeners(string $eventName): array;

    /**
     * Checks whether an event has any registered listeners.
     *
     * @param string $eventName The name of the event
     *
     * @return bool
     */
    public function hasListeners(string $eventName): bool;
}
