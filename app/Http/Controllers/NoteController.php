<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\NoteRequest;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('notes.index', ['notes' => Auth::user()->notes()->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request)
    {
        try {
            Auth::user()->notes()->create($request->validated());

            return to_route('note.index')->with('success', 'Note created successfully');
        } catch (\Throwable $th) {
            return to_route('note.index')->with('error', 'Error creating note');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('notes.update', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, Note $note)
    {
        try {
            $user_has_note = Auth::user()->notes()->where('id', $note->id)->exists();

            if (!$user_has_note)
                return to_route('note.index')->with('error', 'You do not have permission to edit this note');

            $note->update($request->validated());

            return to_route('note.index')->with('success', 'Note created successfully');
        } catch (\Throwable $th) {
            return to_route('note.index')->with('error', 'Error creating note');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        try {
            $user_has_note = Auth::user()->notes()->where('id', $note->id)->exists();

            if (!$user_has_note)
                return to_route('note.index')->with('error', 'You do not have permission to edit this note');

            $note->delete();

            return to_route('note.index')->with('success', 'Note deleted successfully');
        } catch (\Throwable $th) {
            return to_route('note.index')->with('error', 'Error deleting note');
        }
    }
}
