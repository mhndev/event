<?php

namespace mhndev\Event;

use Closure;

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
     */
    public static function bind($event, Closure $func)
    {
        self::$events[$event][] = $func;
    }
}
