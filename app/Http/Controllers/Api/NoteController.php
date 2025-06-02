<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NoteResource::collection(Auth::user()->notes);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function show(Note $note)
    {
        try {
            $user_has_note = Auth::user()->notes()->where('id', $note->id)->exists();
            
            if (!$user_has_note)
                return response()->json(['error' => 'You do not have permission to edit this note'], 401);

            return new NoteResource($note);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error deleting note'], 500);
        }
    }
}
