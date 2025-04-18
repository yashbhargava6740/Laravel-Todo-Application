<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        return response()->json(Todo::all());
    }

    public function show($id)
    {
        $todo = Todo::findOrFail($id);
        return response()->json($todo);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'nullable|string',
        'image_url' => 'nullable|url|max:255',
    ]);

    $exists = Todo::whereRaw('LOWER(title) = ?', [strtolower($validated['title'])])->exists();
    if ($exists) {
        return response()->json(['message' => 'Task with this title already exists.'], 409);
    }

    $todo = Todo::create($validated);

    return response()->json($todo, 201);
}


    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'image_url' => 'nullable|url|max:255',
            'completed' => 'boolean',
        ]);

        $todo->update($validated);

        return response()->json($todo);
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return response()->json(['message' => 'Todo deleted']);
    }
}
