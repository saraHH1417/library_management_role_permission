<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('user')->get();
        foreach ($activities as $activity) {
            $message = explode($activity->message, ';');
            $activity->type = $message[0];
            $activity->content_model = $message[1];
            $activity->model_id = $message[2];
        }
        return view('activities' , ['activities' => $activities]);
    }
}
