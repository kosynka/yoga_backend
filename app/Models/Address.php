<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = [
        'id',
        'name',
        'affiliate_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class, 'affiliate_id', 'id');
    }
}
