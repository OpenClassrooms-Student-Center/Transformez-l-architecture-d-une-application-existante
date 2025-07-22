<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with(['user', 'tag'])->latest()->get();
        return response()->json($notes);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'tag_id' => 'required|exists:tags,id',
            'text' => 'required|string',
        ]);

        $note = Note::create($validated);

        return response()->json($note, 201);
    }

    public function show(Note $note)
    {
        return response()->json($note->load(['user', 'tag']));
    }

    public function update(Request $request, Note $note)
    {
        $validated = $request->validate([
            'tag_id' => 'sometimes|exists:tags,id',
            'text' => 'sometimes|string',
        ]);

        $note->update($validated);

        return response()->json($note);
    }

    public function destroy(Note $note)
    {
        $note->delete();

        return response()->json(['message' => 'Note deleted']);
    }
}
