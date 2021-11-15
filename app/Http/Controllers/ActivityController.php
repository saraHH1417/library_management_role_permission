<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __constructor()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $activities = Activity::with('user')->latest()->get();

        return view('activities' , ['activities' => $activities]);
    }

}
