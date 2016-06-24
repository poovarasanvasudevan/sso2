<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    //
    protected $fillable = [
        'attrcode',
        'artefact_type',
        'list_code',
        'attr_value',
        'pickflag',
        'is_searchable',
        'is_maintainable',
        'sequence_number',
        'html_type'
    ];
}
