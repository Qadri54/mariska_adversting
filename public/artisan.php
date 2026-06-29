<?php

// pindah ke root project Laravel
chdir(dirname(__DIR__));

echo "<pre>";

passthru('php artisan storage:link 2>&1');

echo "</pre>";