<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        $data = User::where('usertype', '!=', '1')->paginate(10);
        return view('dashboard', compact('data'));
    }
}
