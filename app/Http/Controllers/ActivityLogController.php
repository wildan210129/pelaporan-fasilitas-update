<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = LogActivity::with('user')
            ->latest()
            ->paginate(10);

        return view('activity.index', compact('logs'));
    }
}
