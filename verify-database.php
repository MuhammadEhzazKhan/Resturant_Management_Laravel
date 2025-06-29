<?php

// Verify database after migrations
require_once __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Verifying database after migrations...\n";

try {
    // Test basic connection
    DB::connection()->getPdo();
    echo "✓ Database connection successful\n";
    
    // Test if migrations table exists
    $migrationsExist = DB::getSchemaBuilder()->hasTable('migrations');
    echo "✓ Migrations table exists: " . ($migrationsExist ? 'Yes' : 'No') . "\n";
    
    // Test if food table exists
    $foodTableExists = DB::getSchemaBuilder()->hasTable('food');
    echo "✓ Food table exists: " . ($foodTableExists ? 'Yes' : 'No') . "\n";
    
    // Test querying food table
    if ($foodTableExists) {
        $foodCount = DB::table('food')->count();
        echo "✓ Food table query successful, count: $foodCount\n";
    }
    
    // Test if users table exists
    $usersTableExists = DB::getSchemaBuilder()->hasTable('users');
    echo "✓ Users table exists: " . ($usersTableExists ? 'Yes' : 'No') . "\n";
    
    // Test if tables table exists
    $tablesTableExists = DB::getSchemaBuilder()->hasTable('tables');
    echo "✓ Tables table exists: " . ($tablesTableExists ? 'Yes' : 'No') . "\n";
    
    echo "Database verification completed successfully!\n";
    
} catch (Exception $e) {
    echo "✗ Database verification failed: " . $e->getMessage() . "\n";
    exit(1);
} 