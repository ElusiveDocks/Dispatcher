<?php

namespace ElusiveDocks\Dispatcher\Source;

use ElusiveDocks\Dispatcher\Contract\EventInterface;
use ElusiveDocks\Dispatcher\Source\Dispatcher\GenericDispatcher;
use ElusiveDocks\Dispatcher\Source\Event\GenericEvent;

/**
 * Class Dispatcher
 * @package ElusiveDocks\Dispatcher\Source
 */
class Dispatcher
{
    private static $Self = null;
    private static $Singleton = null;

    /**
     * Dispatcher constructor.
     */
    final private function __construct()
    {

    }

    /**
     * @param string $eventName
     * @param $listener
     * @param int $priority
     * @return Dispatcher
     */
    public static function registerListener(string $eventName, $listener, int $priority = 0): Dispatcher
    {
        self::useSingleton()->addListener($eventName, $listener, $priority);
        return self::useSelf();
    }

    /**
     * @return GenericDispatcher
     */
    private static function useSingleton()
    {
        if (self::$Singleton === null) {
            self::$Singleton = new GenericDispatcher();
        }
        return self::$Singleton;
    }

    /**
     * @return Dispatcher
     */
    private static function useSelf()
    {
        if (self::$Self === null) {
            self::$Self = new self;
        }
        return self::$Self;
    }

    /**
     * @param string $eventName
     * @param EventInterface|null $event
     * @return Dispatcher
     */
    public static function dispatchEvent(string $eventName, EventInterface $event = null): Dispatcher
    {
        self::useSingleton()->dispatch($eventName, $event);
        return self::useSelf();
    }

    /**
     * @param null $subject
     * @param array $arguments
     * @return EventInterface
     */
    public static function createEvent($subject = null, array $arguments = []): EventInterface
    {
        return new GenericEvent($subject, $arguments);
    }
}
