<?php

// app/Models/Invoice.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'order_id', 'user_id', 'amount', 'status', 'date',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
