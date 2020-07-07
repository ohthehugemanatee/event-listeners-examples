<?php

/**
 * The functions which will be handled synchronously.
 * NB: functions B and C are anonymous functions, since
 * the async callback spawns a new thread.
 */
function a() {
    echo "Starting function A...\r\n";
    sleep(rand(1,10));
    echo "A is running!\r\n";
    if (class_exists("eventManager")) {
        eventManager::trigger(AEVENT);
    }
}

function d() {
    echo "Starting function D:\r\n";
    echo "This was a triumph!\r\n";
    sleep(rand(1,10));
    echo "I'm making a note here: huge success\r\n";
    echo "Function D completed.\r\n";
}
