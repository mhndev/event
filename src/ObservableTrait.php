<?php
namespace mhndev\digipeyk\traits;

use Closure;

/**
 * Trait ObservableTrait
 * @package mhndev\digipeyk\traits
 */
trait ObservableTrait
{
    /**
     * @var array Map<string eventName, List<Closure observer>> $_observers
     */
    protected static $_observers = array();

    /**
     * @return mixed
     */
    public static final function fireEvent()
    {
        $args = func_get_args();
        $event = $args[0];
        unset($args[0]);

        if (isset(static::$_observers[$event])) {
            foreach (static::$_observers[$event] as $func) {
                return call_user_func_array($func, $args);
            }
        }
    }

    /**
     * @param string $eventName
     * @param Closure $observer With parameter (array $data)
     */
    public static final function addObserver($eventName, Closure $observer)
    {
        if (!isset(static::$_observers[$eventName])) {
            static::$_observers[$eventName] = array();
        }
        static::$_observers[$eventName][] = $observer;
    }

    /**
     * @param string $eventName
     * @param Closure $observer The observer to remove
     */
    public static final function removeObserver($eventName, Closure $observer)
    {
        if (isset(static::$_observers[$eventName])) {
            foreach (static::$_observers[$eventName] as $key => $existingObserver) {
                if ($existingObserver === $observer) {
                    unset(static::$_observers[$eventName][$key]);
                }
            }
        }
    }



}
