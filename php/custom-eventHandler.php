<?php

/**
 * @file
 * Example implementation using a custom event/listener class.
 */

use Spatie\Async\Pool;

include "vendor/autoload.php";
include "includes/myEventManager.php";
include "includes/functions.php";

// Constants.
define("AEVENT", "AReady");
define("BCEVENT", "BCReady");

// Action triggered by "AEVENT" (a() reports ready).
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
// Action triggered by "BCEVENT" (b() and c() report ready).
eventManager::bind(BCEVENT, function() {
    d();
});

// Execution.
a();
exit(0);
?>