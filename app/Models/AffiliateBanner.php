<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AffiliateBanner extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = [
        'id',
        'affiliate_id',
        'image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class, 'affiliate_id', 'id');
    }

    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = "public";
        $destination_path = "";

        $fileName = time() . $value->getClientOriginalName();

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path, $fileName);
    }
}
