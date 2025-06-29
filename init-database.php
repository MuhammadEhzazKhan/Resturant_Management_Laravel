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
    
    // Test basic database operations
    $pdo->query('SELECT 1');
    echo "Basic database connection test passed\n";
    
    // Test creating and querying a table
    $pdo->exec('CREATE TABLE IF NOT EXISTS test_table (id INTEGER PRIMARY KEY, name TEXT)');
    $pdo->exec('INSERT INTO test_table (name) VALUES ("test")');
    $result = $pdo->query('SELECT * FROM test_table')->fetch();
    echo "Table creation and query test passed\n";
    
    // Clean up test table
    $pdo->exec('DROP TABLE test_table');
    
    echo "SQLite database initialized successfully at: $databasePath\n";
    echo "Database file size: " . filesize($databasePath) . " bytes\n";
    
} catch (Exception $e) {
    echo "Error initializing database: " . $e->getMessage() . "\n";
    exit(1);
} 