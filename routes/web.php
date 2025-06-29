<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\ReviewController;

// Test route for debugging
Route::get('/test', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'Laravel is working',
        'timestamp' => now()
    ]);
});

// Test route that mimics main route without database
Route::get('/test-home', function () {
    try {
        return response()->json([
            'status' => 'ok',
            'message' => 'Home route test - no database queries',
            'timestamp' => now()
        ]);
    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'timestamp' => now()
        ], 500);
    }
});

// Test route with database queries
Route::get('/test-db', function () {
    try {
        $foodCount = \App\Models\Food::count();
        $tableCount = \App\Models\Table::count();
        
        return response()->json([
            'status' => 'ok',
            'message' => 'Database queries working',
            'food_count' => $foodCount,
            'table_count' => $tableCount,
            'timestamp' => now()
        ]);
    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'timestamp' => now()
        ], 500);
    }
});

// Database check route
Route::get('/check-db', function () {
    try {
        $databasePath = '/app/storage/database/database.sqlite';
        
        if (!file_exists($databasePath)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database file does not exist',
                'path' => $databasePath,
                'timestamp' => now()
            ], 500);
        }
        
        $pdo = new PDO("sqlite:$databasePath");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $result = $pdo->query('SELECT 1')->fetch();
        $foodCount = $pdo->query('SELECT COUNT(*) FROM food')->fetchColumn();
        
        return response()->json([
            'status' => 'ok',
            'message' => 'Database check successful',
            'database_path' => $databasePath,
            'file_size' => filesize($databasePath),
            'food_count' => $foodCount,
            'timestamp' => now()
        ]);
    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'timestamp' => now()
        ], 500);
    }
});

Route::get('/review', [ReviewController::class, 'showReviewForm'])->name('review.form');
Route::post('/review', [ReviewController::class, 'submitReview'])->name('submit.review');

// Optional: Route to display all reviews
Route::get('/reviews', [ReviewController::class, 'allReviews'])->name('reviews.all');

Route::get('/', [HomeController::class, 'my_home']);

Route::get('/home',[HomeController::class, 'index']);

Route::get('/add_food',[AdminController::class, 'add_food']);

Route::post('/upload_food',[AdminController::class, 'upload_food']);

Route::get('/view_food',[AdminController::class, 'view_food']);

Route::get('/delete_food/{id}',[AdminController::class, 'delete_food']);

Route::get('/update_food/{id}',[AdminController::class, 'update_food']);

Route::post('/edit_food/{id}',[AdminController::class, 'edit_food']);

Route::post('/add_cart/{id}',[HomeController::class, 'add_cart']);

Route::get('/my_cart',[HomeController::class, 'my_cart']);

Route::get('/remove_cart/{id}',[HomeController::class, 'remove_cart']);

Route::post('/confirm_order',[HomeController::class, 'confirm_order']);

Route::get('/orders',[AdminController::class, 'orders']);

Route::get('/on_the_way/{id}',[AdminController::class, 'on_the_way']);
Route::get('/delivered/{id}',[AdminController::class, 'delivered']);
Route::get('/cancel/{id}',[AdminController::class, 'cancel']);

Route::get('/book-table-form', [HomeController::class, 'show_book_table_form'])->name('book.table.form');
Route::post('/book_table', [HomeController::class, 'book_table'])->name('book.table');

Route::get('/reservations',[AdminController::class, 'reservations']);

Route::get('/add_table',[AdminController::class, 'add_table']);

Route::post('/upload_table',[AdminController::class, 'upload_table']);

Route::get('/view_table',[AdminController::class, 'view_table']);

Route::get('/delete_table/{id}',[AdminController::class, 'delete_table']);

Route::get('/update_table/{id}',[AdminController::class, 'update_table']);

Route::post('/edit_table/{id}',[AdminController::class, 'edit_table']);

Route::get('/add_employee',[AdminController::class, 'add_employee']);

Route::post('/upload_employee',[AdminController::class, 'upload_employee']);

Route::get('/view_employee',[AdminController::class, 'view_employee']);

Route::get('/delete_employee/{id}',[AdminController::class, 'delete_employee']);

Route::post('/generate_invoice', [HomeController::class, 'generate_invoice'])->name('generate_invoice');

Route::get('/invoice', [HomeController::class, 'show_invoice'])->middleware('auth')->name('invoice');

Route::get('/invoices',[AdminController::class, 'invoices']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
