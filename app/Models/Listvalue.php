<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listvalue extends Model
{
    //
    protected $fillable = [
      'list_code',
      'list_desc',
      'list_value',
    ];
}
