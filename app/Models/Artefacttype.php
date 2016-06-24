<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artefacttype extends Model
{
    //
    protected $fillable=[
        'artefact_type',
        'artefact_type_description',
        'artefact_type_long_description',
        'active',
        'created_by',
    ];
}
