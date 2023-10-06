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

    public function edit(string $id)
    {
        $data = User::query()->findOrFail($id);
        return view('users.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = User::query()->findOrFail($id);
        $data->usertype = $request->usertype;
        $data->save();
        return redirect('/dashboard')->with('status', 'Success');
    }
}
