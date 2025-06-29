<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class EnsureDatabaseExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $databasePath = '/app/storage/database/database.sqlite';
            
            // Check if database file exists
            if (!file_exists($databasePath)) {
                // Create directory if it doesn't exist
                $directory = dirname($databasePath);
                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                // Create database file
                $pdo = new \PDO("sqlite:$databasePath");
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $pdo->query('SELECT 1');
                
                // Set permissions
                chmod($databasePath, 0664);
                chmod($directory, 0755);
                
                // Run migrations if needed
                if (!DB::getSchemaBuilder()->hasTable('migrations')) {
                    \Artisan::call('migrate', ['--force' => true]);
                }
            }
            
            // Test database connection
            DB::connection()->getPdo();
            
        } catch (Exception $e) {
            \Log::error('Database middleware error: ' . $e->getMessage());
            
            // Return error response for API routes
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Database initialization failed: ' . $e->getMessage(),
                    'timestamp' => now()
                ], 500);
            }
        }

        return $next($request);
    }
} 