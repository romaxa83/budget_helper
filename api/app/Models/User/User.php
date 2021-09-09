<?php

namespace App\Models\User;

use App\Casts;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * @property int id
 * @property string name
 * @property string password
 * @property string email
 * @property string phone
 * @property string role
 * @property bool phone_verify
 * @property int status
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verify' => 'boolean',
        'email' => Casts\EmailCast::class,
        'phone' => Casts\PhoneCast::class,
    ];

    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    // переопределение метода для паспорт
    public function findForPassport($username)
    {
        return self::where('id', $username)->first();
    }
}
