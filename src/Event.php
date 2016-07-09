<?php

namespace mhndev\event;

use Closure;
use mhndev\event\Exceptions\EventHandlerAlreadyExist;

/**
 * Class Event
 * @package mhndev\Event
 */
class Event
{
    /**
     * @var array
     */
    public static $events = array();

    /**
     * @param $event
     * @param array $args
     */
    public static function trigger($event, $args = array())
    {
        if(isset(self::$events[$event])) {

            foreach(self::$events[$event] as $func) {

                call_user_func($func, $args);
            }
        }

    }

    /**
     * @param $event
     * @param Closure $func
     * @param bool $overrideHandler
     * @throws EventHandlerAlreadyExist
     */
    public static function bind($event, Closure $func, $overrideHandler = false)
    {
        if( !$overrideHandler && !empty(self::$events[$event]) )
            throw new EventHandlerAlreadyExist;
        
        self::$events[$event][] = $func;
    }
}
