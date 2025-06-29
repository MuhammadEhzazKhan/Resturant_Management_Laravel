<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Exception;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Initialize database at runtime
        $this->initializeDatabase();
    }

    /**
     * Initialize the SQLite database at runtime
     */
    private function initializeDatabase(): void
    {
        try {
            $databasePath = '/app/storage/database/database.sqlite';
            
            // Create directory if it doesn't exist
            $directory = dirname($databasePath);
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            // Create database file if it doesn't exist
            if (!file_exists($databasePath)) {
                $pdo = new \PDO("sqlite:$databasePath");
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $pdo->query('SELECT 1'); // Test the connection
                
                // Set proper permissions
                chmod($databasePath, 0664);
                chmod($directory, 0755);
            }

            // Test if database is working
            DB::connection()->getPdo();
            
        } catch (Exception $e) {
            // Log the error but don't crash the application
            \Log::error('Database initialization failed: ' . $e->getMessage());
        }
    }
} 