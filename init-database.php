<?php

// Initialize SQLite database
$databasePath = '/app/storage/database/database.sqlite';

// Create all necessary directories
$directories = [
    '/app/storage/database',
    '/app/storage/framework/sessions',
    '/app/storage/framework/cache',
    '/app/storage/framework/views',
    '/app/storage/logs'
];

foreach ($directories as $directory) {
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
        echo "Created directory: $directory\n";
    }
}

try {
    // Create database connection
    $pdo = new PDO("sqlite:$databasePath");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Test the connection
    $pdo->query('SELECT 1');
    
    echo "SQLite database initialized successfully at: $databasePath\n";
    
} catch (Exception $e) {
    echo "Error initializing database: " . $e->getMessage() . "\n";
    exit(1);
} 