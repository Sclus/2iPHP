<?php

namespace App\Traits;
trait Loggable {
    public function log($message): void
    {
        echo "Log: " . $message . "\n";
    }
}
