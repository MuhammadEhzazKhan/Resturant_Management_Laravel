<?php

// Initialize SQLite database
$databasePath = '/app/storage/database/database.sqlite';

// Create directory if it doesn't exist
$directory = dirname($databasePath);
if (!is_dir($directory)) {
    mkdir($directory, 0755, true);
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