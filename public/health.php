<?php
// Simple health check for Railway deployment
header('Content-Type: application/json');

$response = [
    'status' => 'ok',
    'timestamp' => date('Y-m-d H:i:s'),
    'php_version' => PHP_VERSION,
    'laravel_version' => app()->version(),
    'environment' => app()->environment(),
    'database' => 'checking...'
];

try {
    // Test database connection
    DB::connection()->getPdo();
    $response['database'] = 'connected';
} catch (Exception $e) {
    $response['database'] = 'error: ' . $e->getMessage();
    $response['status'] = 'error';
}

echo json_encode($response, JSON_PRETTY_PRINT); 