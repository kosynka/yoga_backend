<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as FacadesFile;

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
        'description',
        'photo_id',
        'package_id',
        'favorite_affiliate_id',
        'works_in_affiliate_id',
        'created_at',
        'expires_at',
        'visits_left',
        'fb_token',
    ];

    protected $hidden = [
        'password',
        'phone_verified_at',
        'updated_at',
        'deleted_at',
        'remember_token',
    ];

    protected $appends = [
        'onlyUsers',
        'adminsFirst',
    ];

    public function isUser(): bool
    {
        return true ? $this->role === self::ROLE_USER : false;
    }

    public function isInstructor(): bool
    {
        return true ? $this->role === self::ROLE_INSTRUCTOR : false;
    }

    public function photo(): BelongsTo
    {
        return $this->belongsTo(File::class, 'photo_id');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function favoriteAffiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class, 'favorite_affiliate_id');
    }

    public function masterOfAffiliate(): HasOne
    {
        return $this->hasOne(Affiliate::class, 'master_id', 'id');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'user_id', 'id');
    }

    public function assignmentsCount()
    {
        return $this->assignments()->count();
    }

    public function worksInAffiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class, 'works_in_affiliate_id');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'instructor_id', 'id');
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

    public function onlyUsers(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->getRole() . ' | ' . $this->name . ' +7' . $this->phone;
            },
        );
    }

    public function adminsFirst(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->role == self::ROLE_ADMIN) {
                    return $this->getRole() . ' | ' . $this->name . ' +7' . $this->phone;
                } else {
                    return 'ne admin';
                }
            },
        );
    }
    
    public function setPhotoAttribute($value)
    {
        $attribute_name = 'photo_id';
        $disk = "public";
        $destination_path = "storage";

        if ($value == null) {
            $this->attributes[$attribute_name] = null;
        }

        $filePath = time() . $value->getClientOriginalName();
        Storage::disk('public')->put($filePath, FacadesFile::get($value));

        $data['name'] = $filePath;
        $data['path'] = 'storage/' . $filePath;
        $newFile = File::create($data);

        $this->uploadFileToDisk($newFile->id, $attribute_name, $disk, $destination_path, $fileName = null);
        $this->attributes[$attribute_name] = $newFile->id;
    }
}
