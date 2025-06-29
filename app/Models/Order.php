<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'food_id',
        'employee_id',
        'amount',
        'status'
    ];

    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class); // Match with your actual food model name
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
