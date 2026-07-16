<?php

namespace App\Infrastructure\Adapters\Database\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasUuids, HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'fullname',
        'password',
        'active',
        'sudo',
        'avatar',
        'roles',
        'reset_password_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'roles' => 'array',
            // 'properties' => 'array',
        ];
    }

    public function getDateAsCarbonAttribute(): Carbon
    {
        return Carbon::parse($this->created_at);
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Hash::make($value),
        );
    }
}
