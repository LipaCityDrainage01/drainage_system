<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BarangayList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    public function detection(): HasOne
    {
        return $this->hasOne(Detection::class, 'location_id', 'id')->latest();
    }
}
