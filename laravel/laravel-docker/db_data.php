<?php

// Cargar el autoload de Composer
require __DIR__.'/vendor/autoload.php';

// Cargar el kernel de Laravel
$app = require_once __DIR__.'/bootstrap/app.php';

// Ejecutar los comandos
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->call('migrate');
$kernel->call('migrate:refresh');
$kernel->call('db:seed');