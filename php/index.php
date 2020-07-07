<?php
include "vendor/autoload.php";
include "includes/myEventManager.php";
include "includes/functions.php";

use Spatie\Async\Pool;

// Constants.
define("AEVENT", "AReady");
define("BCEVENT", "BCReady");

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