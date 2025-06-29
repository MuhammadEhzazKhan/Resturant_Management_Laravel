<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['table_id', 'phone', 'guests', 'date', 'time'];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
