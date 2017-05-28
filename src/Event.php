<?php
namespace mhndev\event;

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
     * @return mixed
     */
    public static function trigger()
    {
        $args = func_get_args();
        $event = $args[0];

        unset($args[0]);

        if(isset(self::$events[$event] )) {

            foreach(self::$events[$event] as $func) {
                return call_user_func_array($func, $args);
            }
        }

    }

    /**
     * @param $event
     * @param callable $func
     * @param bool $overrideHandler
     * @throws EventHandlerAlreadyExist
     */
    public static function bind($event, Callable $func, $overrideHandler = false)
    {
        if( !$overrideHandler && !empty(self::$events[$event]) )
            throw new EventHandlerAlreadyExist;

        self::$events[$event][] = $func;
    }
}
