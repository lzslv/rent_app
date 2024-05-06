<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Worker;
use Illuminate\Http\Request;

class JobController extends Controller
{
    private const NAME = 'Должности';

    public function index(?int $id = null)
    {
        $workers = $id ? Job::find($id)->workers()->get() : Worker::with('job')->get();

        return view('home.jobs')->with('name', self::NAME)->with('workers', $workers)->with('jobFlag', !$id);
    }
}
