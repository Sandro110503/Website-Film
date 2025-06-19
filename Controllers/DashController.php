<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function dashBackend()
    {
    $user = User::orderBy('updated_at', 'desc')->get();

    return view('backend.dashboard', [
        'judul' => 'Data User',
        'index' => $user
    ]);
    }
}
