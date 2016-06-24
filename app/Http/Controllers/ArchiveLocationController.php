<?php

namespace App\Http\Controllers;

use App\Models\Archivelocation;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArchiveLocationController extends Controller
{
    //

    public function getAllLocation()
    {
        return response()->json(Archivelocation::active()->get());
    }
}
