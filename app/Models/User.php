<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, CrudTrait;

    const ROLE_INSTRUCTOR = 'INSTRUCTOR';
    const ROLE_ADMIN = 'ADMIN';
    const ROLE_USER = 'USER';

    protected $fillable = [
        'id',
        'role',
        'name',
        'phone',
        'photo_id',
        'favorite_affiliate_id',
        'works_in_affiliate_id',
        'password',
        'fb_token',
        'phone_verified_at',
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
        'remember_token',
    ];

    public function photo(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function favoriteAffiliate(): BelongsTo      // for users
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function assignments(): HasMany              // for users
    {
        return $this->hasMany(Assignment::class);
    }

    public function worksInAffiliate(): BelongsTo       // for instructors
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function lessons(): HasMany                  // for instructors
    {
        return $this->hasMany(Lesson::class, 'instructor_id');
    }

    public function getRole(): string
    {
        switch ($this->role) {
            case self::ROLE_ADMIN:
                return 'админ';
                break;
            case self::ROLE_INSTRUCTOR:
                return 'инструктор';
                break;
            case self::ROLE_USER:
                return 'пользователь';
                break;
            default:
                return 'не удалось выяснить';
                break;
        }
    }

    public function getRatingCount(): int
    {
        $ratingCount = $this->ratings->count();

        return $ratingCount;
    }

    public function getRating(): float
    {
        $ratingCount = $this->ratings->count();

        if ($ratingCount) {
            $totalRating = $this->ratings->sum('rate');
            return number_format($totalRating/$ratingCount, 2);
        }

        return 0;
    }
}
