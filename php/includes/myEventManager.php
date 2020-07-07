<?php

/**
 * The event/listeners manager.
 */
class eventManager {
    // Registry of events.
    public static $events = array();
    // Trigger an event.
    public static function trigger($event, $args = array()) {
        if(isset(self::$events[$event])) {
            foreach(self::$events[$event] as $func) {
                call_user_func($func, $args);
            }
        }
    }
    // Bind a listener to an event.
    public static function bind($event, Closure $func) {
        self::$events[$event][] = $func;
    }
}