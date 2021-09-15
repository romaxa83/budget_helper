<?php

namespace App\Models\User;

use App\Casts;
use App\Models\Record\Record;
use App\Models\Tag\Tag;
use App\ValueObjects\Statuses\TypeRecord;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Tag::class,
            'user_tag_relations',
            'user_id',
            'tag_id'
        );
    }

    public function records(): HasMany
    {
        return $this->hasMany(
            Record::class,
            'user_id',
            'id'
        );
    }

    public function recordsComing(): HasMany
    {
        return $this->records()->where('type', TypeRecord::COMING);
    }

    public function recordsExpenses(): HasMany
    {
        return $this->records()->where('type', TypeRecord::EXPENSES);
    }

    public function tagsParent()
    {
        return $this->belongsToMany(
            Tag::class,
            'user_tag_relations',
            'user_id',
            'tag_id'
        )->where('parent_id', null);
    }

    // переопределение метода для паспорт
    public function findForPassport($username)
    {
        return self::where('id', $username)->first();
    }

    public function getTotalExpensesAttribute()
    {
        return $this->recordsExpenses->sum(function (Record $model){
            return $model->amount;
        });
    }

    public function getTotalComingAttribute()
    {
        return $this->recordsComing->sum(function (Record $model){
            return $model->amount;
        });
    }
}
