<?php

namespace App\Http\Controllers;

use App\Jobs\TestJob;
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Service::query()->findOrFail($id);
        return view('services.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::query()->findOrFail($id);
        $service->name = $request->name;
        $service->price = $request->price;
        $service->deadline = $request->deadline;
        $service->save();
        return redirect('/services')->with('status', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Service::where('id', $id)->delete();
        return redirect('/services')->with('status', 'Success');
    }
}
