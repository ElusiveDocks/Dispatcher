<?php

namespace ElusiveDocks\Dispatcher\Source\Event;

use ElusiveDocks\Dispatcher\Contract\EventInterface;

/**
 * Class AbstractEvent
 * @package ElusiveDocks\Dispatcher\Source\Event
 */
abstract class AbstractEvent implements EventInterface
{
    /** @var bool $propagationStopped */
    private $propagationStopped = false;

    /**
     * @inheritdoc
     */
    public function isPropagationStopped(): bool
    {
        return $this->propagationStopped;
    }

    /**
     * @inheritdoc
     */
    public function stopPropagation(): void
    {
        $this->propagationStopped = true;
    }
}
