<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentLog extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'rent_date',
        'return_date',
        'actual_return_date',
        'status',
        'fine',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
