<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivelocation extends Model
{
    //

    protected $fillable = [
        'archive_location_name',
        'archive_location_desc',
        'active'
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
