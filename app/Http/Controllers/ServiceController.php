<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $data = Service::all();
        return view('services.services', compact('data'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        echo "<pre>";
        var_dump($request);
        echo "<pre>";
        exit;
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'deadline' => 'required|numeric',
        ]);
        $service = new Service();
        $service->name = $request->name;
        $service->price = $request->price;
        $service->deadline = $request->deadline;
        $service->save();
        return redirect('/services')->with('status', 'Success');
    }
}
