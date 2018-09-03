<?php

namespace ElusiveDocks\BackBone\Event;

/**
 * Interface DispatcherEvent
 * @package ElusiveDocks\BackBone\Event
 */
interface DispatcherEvent
{
    const CREATE = __CLASS__.'Create';
    const DESTROY = __CLASS__.'Destroy';
}
