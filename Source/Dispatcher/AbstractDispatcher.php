<?php

namespace ElusiveDocks\Dispatcher\Source\Dispatcher;

use ElusiveDocks\Dispatcher\Contract\DispatcherInterface;

/**
 * Class AbstractDispatcher
 * @package ElusiveDocks\Dispatcher\Source\Dispatcher
 */
abstract class AbstractDispatcher implements DispatcherInterface
{
    /** @var array $listeners */
    private $listeners = [];
    /** @var array $sorted */
    private $sorted = [];

    /**
     * {@inheritdoc}
     */
    public function getListeners(string $eventName): array
    {
        if (empty($this->listeners[$eventName])) {
            return [];
        }

        if (!isset($this->sorted[$eventName])) {
            $this->sortListeners($eventName);
        }

        return $this->sorted[$eventName];
    }

    /**
     * Sorts the internal list of listeners for the given event by priority.
     *
     * @param string $eventName The name of the event
     */
    private function sortListeners(string $eventName)
    {
        krsort($this->listeners[$eventName]);
        $this->sorted[$eventName] = [];

        foreach ($this->listeners[$eventName] as $priority => $listeners) {
            foreach ($listeners as $k => $listener) {
                if (\is_array($listener) && isset($listener[0]) && $listener[0] instanceof \Closure) {
                    $listener[0] = $listener[0]();
                    $this->listeners[$eventName][$priority][$k] = $listener;
                }
                $this->sorted[$eventName][] = $listener;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasListeners(string $eventName): bool
    {
        return isset($this->listeners[$eventName]) && !empty($this->listeners[$eventName]);
    }

    /**
     * {@inheritdoc}
     */
    public function addListener(string $eventName, $listener, int $priority = 0)
    {
        $this->listeners[$eventName][$priority][] = $listener;
        unset($this->sorted[$eventName]);
    }

    /**
     * {@inheritdoc}
     */
    public function removeListener(string $eventName, $listener)
    {
        if (empty($this->listeners[$eventName])) {
            return;
        }

        if (\is_array($listener) && isset($listener[0]) && $listener[0] instanceof \Closure) {
            $listener[0] = $listener[0]();
        }

        foreach ($this->listeners[$eventName] as $priority => $listeners) {
            foreach ($listeners as $k => $v) {
                if ($v !== $listener && \is_array($v) && isset($v[0]) && $v[0] instanceof \Closure) {
                    $v[0] = $v[0]();
                }
                if ($v === $listener) {
                    unset($listeners[$k], $this->sorted[$eventName]);
                } else {
                    $listeners[$k] = $v;
                }
            }

            if ($listeners) {
                $this->listeners[$eventName][$priority] = $listeners;
            } else {
                unset($this->listeners[$eventName][$priority]);
            }
        }
    }
}
