<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class DefinitionController extends Controller
{
    //
    public function index()
    {
        if (!Auth::user()) {
            return response()->redirectTo('/');
        } else {
            return response()->view('definition.definition');
        }
    }
}
