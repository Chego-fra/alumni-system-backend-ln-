<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'alumni' => User::where('role', 'alumni')->count(),
            'faculty' => User::where('role', 'faculty')->count(),
            'admin' => User::where('role', 'admin')->count(),
        ]);
    }
}
