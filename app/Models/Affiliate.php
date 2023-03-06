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
        'description',
        'address',
        'image_id',
        'city_id',
        'master_id',
        // 'parent_id',
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
        return $this->hasMany(User::class, 'works_in_affiliate_id');
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
}
