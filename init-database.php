<?php

// Initialize SQLite database
$databasePath = __DIR__ . '/storage/database/database.sqlite';

// Create all necessary directories
$directories = [
    __DIR__ . '/storage/database',
    __DIR__ . '/storage/framework/sessions',
    __DIR__ . '/storage/framework/cache',
    __DIR__ . '/storage/framework/views',
    __DIR__ . '/storage/logs'
];

foreach ($directories as $directory) {
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
        echo "Created directory: $directory\n";
    }
}

// Remove existing database file if it exists
if (file_exists($databasePath)) {
    unlink($databasePath);
    echo "Removed existing database file\n";
}

try {
    // Create database connection
    $pdo = new PDO("sqlite:$databasePath");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Initialize the database with a simple table to ensure it's valid
    $pdo->exec('CREATE TABLE IF NOT EXISTS test_table (id INTEGER PRIMARY KEY)');
    $pdo->exec('DROP TABLE test_table');
    
    // Test the connection
    $pdo->query('SELECT 1');
    
    echo "SQLite database initialized successfully at: $databasePath\n";
    echo "Database file size: " . filesize($databasePath) . " bytes\n";
    
} catch (Exception $e) {
    echo "Error initializing database: " . $e->getMessage() . "\n";
    exit(1);
} 