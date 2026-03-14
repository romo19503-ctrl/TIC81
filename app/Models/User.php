<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'is_admin'];

    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    // Relaciones
    public function orders(): HasMany { return $this->hasMany(Order::class); }
    public function carts(): HasMany { return $this->hasMany(Cart::class); }

    // Mutator: Asegura que el email siempre se guarde en minúsculas
    protected function email(): Attribute {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
        );
    }
}