<?php

namespace App\Http\Controllers;
use App\Models\Pelanggan;
use App\Models\Laundry;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('member.member');
    }
}
