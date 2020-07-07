<?php
include "vendor/autoload.php";

use Spatie\Async\Pool;

// Constants.
define("AEVENT", "AReady");
define("BCEVENT", "BCReady");

// The event/listeners manager.
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

// The functions which will be handled asynchronously.
function a() {
    echo "Starting function A...\r\n";
    sleep(rand(1,10));
    echo "A is running!\r\n";
    return true;
}

function d() {
    echo "Starting function D:\r\n";
    echo "This was a triumph!\r\n";
    sleep(rand(1,10));
    echo "I'm making a note here: huge success\r\n";
    echo "Function D completed.\r\n";
}

// Configure event listeners.
eventManager::bind(AEVENT, function() {
    echo "Starting functions B and C asynchronously...\r\n";
    $pool = Pool::create();
    $pool
        ->add(function() { sleep(rand(1,10)); })
        ->then(function() { echo "B is running!\r\n"; });
    $pool
        ->add(function() { sleep(rand(1,10)); })
        ->then(function() { echo "C is running!\r\n"; });
    $pool->wait();
    eventManager::trigger(BCEVENT);
});

eventManager::bind(BCEVENT, function() {
    d();
});
a();
eventManager::trigger(AEVENT);
exit(0);
?>