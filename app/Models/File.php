<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class File extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = [
        'id',
        'name',
        'path',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
