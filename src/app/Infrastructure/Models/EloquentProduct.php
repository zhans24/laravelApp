<?php

namespace App\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EloquentProduct extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'code',
        'name',
        'description',
        'price',
        'discount',
        'photo',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(EloquentCategory::class);
    }

    public function reviews()
    {
        return $this->hasMany(EloquentReview::class);
    }
}
