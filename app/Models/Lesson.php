<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes, CrudTrait;

    protected $fillable = [
        'id',
        'type_id',
        'instructor_id',
        'starts_at',
        'continuance',
        'participants_limitation',
        'comment',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'attributes',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'lesson_id');
    }

    public function assignmentsAmount()
    {
        return $this->assignments()->count();
    }

    public function isParticipantsLimitEndedUp()
    {
        $diff = $this->participants_limitation - $this->assignmentsAmount();

        return true ? $diff > 0 : false;
    }

    public function attributes(): Attribute
    {
        return new Attribute(
            get: fn () => $this->type->name . ' ' . $this->instructor->name . ' ' . $this->starts_at,
        );
    }
}
