<?php

// Simple database check script
$databasePath = '/app/storage/database/database.sqlite';

echo "Checking database at: $databasePath\n";

if (!file_exists($databasePath)) {
    echo "ERROR: Database file does not exist!\n";
    exit(1);
}

echo "Database file exists, size: " . filesize($databasePath) . " bytes\n";

try {
    $pdo = new PDO("sqlite:$databasePath");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Test basic query
    $result = $pdo->query('SELECT 1')->fetch();
    echo "✓ Basic database query successful\n";
    
    // Test if food table exists
    $tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='food'")->fetchAll();
    if (count($tables) > 0) {
        echo "✓ Food table exists\n";
        
        // Test food table query
        $foodCount = $pdo->query('SELECT COUNT(*) FROM food')->fetchColumn();
        echo "✓ Food table query successful, count: $foodCount\n";
    } else {
        echo "✗ Food table does not exist\n";
    }
    
    echo "Database check completed successfully!\n";
    
} catch (Exception $e) {
    echo "✗ Database check failed: " . $e->getMessage() . "\n";
    exit(1);
} 