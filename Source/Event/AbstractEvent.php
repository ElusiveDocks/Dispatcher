<?php

namespace ElusiveDocks\BackBone\Source\Event;

use ElusiveDocks\BackBone\Contract\EventInterface;

/**
 * Class AbstractEvent
 * @package ElusiveDocks\BackBone\Source\Event
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
