<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, MustVerifyEmail, CrudTrait;

    const ROLE_USER = 'USER';
    const ROLE_ADMIN = 'ADMIN';

    protected $fillable = [
        'id',
        'role',
        'name',
        'phone',
        'email',
        'photo_id',
        'password',

        'fb_token',
        'email_verified_at',
        'phone_verified_at',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
        'remember_token',
    ];

    public function photo(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function getRole(): string
    {
        switch ($this->role) {
            case self::ROLE_ADMIN:
                return 'админ';
                break;
            case self::ROLE_USER:
                return 'пользователь';
                break;
            default:
                return 'ну удалось выяснить';
                break;
        }
    }
}
