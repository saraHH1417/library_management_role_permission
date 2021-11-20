<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    public function __invoke()
    {

        $activities = Activity::with('user')->latest()->get();

        return view('activities' , ['activities' => $activities]);
    }

}
