<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'type',
        'remarks',
        'status',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(BarangayList::class, 'location_id');
    }

}
