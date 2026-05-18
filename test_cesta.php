<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$service = new \App\Services\sigespServices();
$result = $service->getConstante('0001','0000000001','0501', '0004018612');
echo "Con codper: " . json_encode($result) . "\n";
