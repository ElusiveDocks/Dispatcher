<?php

namespace ElusiveDocks\BackBone\Contract;

/**
 * Interface EventInterface
 * @package ElusiveDocks\BackBone\Contract
 */
interface EventInterface
{
    /**
     * Encapsulate an event with $subject and $args.
     *
     * @param mixed $subject The subject of the event, usually an object or a callable
     * @param array $arguments Arguments to store in the event
     */
    public function __construct($subject = null, array $arguments = []);

    /**
     * Stops the propagation of the event to further event listeners.
     *
     * If multiple event listeners are connected to the same event, no
     * further event listener will be triggered once any trigger calls
     * stopPropagation().
     *
     * @return void
     */
    public function stopPropagation(): void;

    /**
     * Returns whether further event listeners should be triggered.
     *
     * @see EventInterface::stopPropagation()
     *
     * @return bool Whether propagation was already stopped for this event
     */
    public function isPropagationStopped(): bool;

    /**
     * Getter for subject property.
     *
     * @return mixed $subject The observer subject
     */
    public function getSubject();

    /**
     * Get argument by key.
     *
     * @param string $key Key
     *
     * @return mixed Contents of array key
     *
     * @throws \InvalidArgumentException if key is not found
     */
    public function getArgument(string $key);

    /**
     * Add argument to event.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return EventInterface
     */
    public function setArgument(string $key, $value): EventInterface;

    /**
     * Has argument.
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasArgument(string $key): bool;

    /**
     * Getter for all arguments.
     *
     * @return array
     */
    public function getArguments(): array;
}
