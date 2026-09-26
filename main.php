<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (($argv[1] === "--port") && ($argv[3] === "--origin")) {
    if ((int) $argv[2]) {
        return $argv[4];
        passthru("php -S localhost:$argv[2] -t public/");
    } else {
        echo "Wrong command! Try again.";exit;
    }
} else {
    echo "Wrong command! Try again.";exit;
}