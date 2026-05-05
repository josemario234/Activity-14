<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::all();
        return response()->json($notes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'body' => 'required|string',
            'classification' => 'required|string',
        ]);

        $note = Note::create($request->all());
        return response()->json($note, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Note::find($id);
        if (!$note){
            return response()->json(['message' => 'Note not found'], 404);
        }
        return response()->json($note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $note = Note::find($id);
        if (!$note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string',
            'author' => 'sometimes|required|string',
            'body' => 'sometimes|required|string',
            'classification' => 'sometimes|required|string',
        ]);

        $note->update($request->all());
        return response()->json($note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $note = Note::find($id);
        if(!$note){
            return response()->json(['message' => 'Note not found'], 404);
        }
        $note->delete();
        return response()->json(['message' => 'Note deleted']);
    }
}
