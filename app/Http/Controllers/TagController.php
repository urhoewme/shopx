<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Tag::all();
        return view('tags.tags', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|min:2|max:32',
        ]);
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();
        return redirect('/tags');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Tag::query()->findOrFail($id);
        return view('tags.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tag = Tag::query()->findOrFail($id);
        $tag->name = $request->name;
        $tag->save();
        return redirect('/tags');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tag::query()->findOrFail($id)->delete();
        return redirect('/tags');
    }
}
