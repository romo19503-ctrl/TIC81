<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'slug'];

    // ESTO ES LO QUE FALTA:
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    // Opcional: Esto ayuda a que el slug se genere solo
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }
}