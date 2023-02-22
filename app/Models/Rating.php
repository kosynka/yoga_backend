<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use HasFactory, SoftDeletes, CrudTrait;

    protected $fillable = [
        'id',
        'user_id',
        'instructor_id',
        'rate',
        'text',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'instructor_id');
    }
}
