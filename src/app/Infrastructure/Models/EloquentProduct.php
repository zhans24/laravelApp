<?php

namespace App\Infrastructure\Models;

use Database\Factories\EloquentProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class EloquentProduct extends Model
{
    use HasFactory;
    use AsSource;

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
    protected static function newFactory()
    {
        return EloquentProductFactory::new();
    }

}
