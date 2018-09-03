<?php

namespace ElusiveDocks\Dispatcher\Event;

/**
 * Interface DispatcherEvent
 * @package ElusiveDocks\Dispatcher\Event
 */
interface DispatcherEvent
{
    const CREATE = __CLASS__.'Create';
    const DESTROY = __CLASS__.'Destroy';
}
