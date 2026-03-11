<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YtController extends Controller
{
    // 1. The "Engine" Logic
    public function player($id)
    {
        // We just pass the YouTube ID to the view
        return view('web.yt.player', compact('id'));
    }

    // 2. The Demo Logic
    public function killer()
    {
        return view('web.yt.killerplayer');
    }
}