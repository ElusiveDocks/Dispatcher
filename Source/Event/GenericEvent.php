<?php

namespace ElusiveDocks\Dispatcher\Source\Event;

use ElusiveDocks\Dispatcher\Contract\EventInterface;

/**
 * Class GenericEvent
 * @package ElusiveDocks\Dispatcher\Source\Event
 */
class GenericEvent extends AbstractEvent implements EventInterface
{
    /** @var null|mixed $subject */
    protected $subject;
    /** @var array $arguments */
    protected $arguments;

    /**
     * @inheritDoc
     */
    public function __construct($subject = null, array $arguments = [])
    {
        $this->subject = $subject;
        $this->arguments = $arguments;
    }

    /**
     * @inheritDoc
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @inheritDoc
     */
    public function getArgument(string $key)
    {
        if ($this->hasArgument($key)) {
            return $this->arguments[$key];
        }

        throw new \InvalidArgumentException(sprintf('Argument "%s" not found.', $key));
    }

    /**
     * @inheritDoc
     */
    public function hasArgument(string $key): bool
    {
        return array_key_exists($key, $this->arguments);
    }

    /**
     * @inheritDoc
     */
    public function setArgument(string $key, $value): EventInterface
    {
        $this->arguments[$key] = $value;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

}
