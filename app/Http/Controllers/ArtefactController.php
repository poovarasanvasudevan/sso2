<?php

namespace App\Http\Controllers;

use App\Models\Artefact;
use App\Models\Artefacttype;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArtefactController extends Controller
{
    //
    public function getAllArtefactType()
    {
        return response()->json(Artefacttype::all());
    }
}
