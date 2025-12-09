<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //tampilan table
    public function user()
    {
        $user = User::all();
        return view('admin.admin', compact('user'));
    }
}
