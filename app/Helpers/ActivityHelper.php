<?php

use App\Models\LogActivity;
use Illuminate\Support\Facades\Auth;

if (!function_exists('activity')) {

    function activity($aktivitas, $modul)
    {
        if (Auth::check()) {

            LogActivity::create([
                'user_id' => Auth::id(),
                'aktivitas' => $aktivitas,
                'modul' => $modul,
            ]);
        }
    }
}
