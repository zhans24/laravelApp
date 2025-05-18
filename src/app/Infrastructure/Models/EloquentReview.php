<?php

namespace App\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentReview extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = ['rating', 'text', 'user_name', 'product_id'];

    public function product()
    {
        return $this->belongsTo(EloquentProduct::class, 'product_id');
    }
}
