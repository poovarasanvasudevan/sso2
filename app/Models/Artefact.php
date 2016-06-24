<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artefact extends Model
{
    //
    protected $fillable = [
        'old_id',
        'artefact_name',
        'artefact_type',
        'location',
        'artefact_parent',
        'created_by',
        'active',
    ];
}
