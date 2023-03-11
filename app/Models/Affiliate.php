<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affiliate extends Model
{
    use HasFactory, SoftDeletes, CrudTrait;

    protected $fillable = [
        'id',
        'name',
        'phone',
        'description',
        'image_id',
        'city_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function master(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function instructors(): HasMany
    {
        return $this->hasMany(User::class, 'works_in_affiliate_id', 'id');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function bannersImages(): HasManyThrough
    {
        return $this->hasManyThrough(
            File::class,
            AffiliateBanner::class,
            'affiliate_id',
            'id',
            'id',
            'image_id',
        );
    }

    public function lessons(): HasManyThrough
    {
        return $this->hasManyThrough(
            Lesson::class,
            User::class,
            'works_in_affiliate_id',
            'instructor_id',
            'id',
            'id',
        );
    }

    public function loadings()
    {
        $lessonsCount = $this->lessons()->count();
        $instructorsCount = $this->instructors()->count();

        if ($lessonsCount && $instructorsCount) {
            $loadings = $lessonsCount / $instructorsCount;
        } else {
            $loadings = 0;
        }

        return $loadings;
    }
}
