<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Get all notes
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Note::all()->toArray());
    }

    /**
     * Store a single note
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $note = new Note();
        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();

        return response()->json($note);
    }

    /**
     * Update a single note
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $note = Note::find($id);
        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->save();

        return response()->json($note);
    }

    /**
     * 
     * Removes a single note
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        $note = Note::find($id);
        $note->delete();

        return response()->json([
            'status' => true,
            'message' => 'Note removed successfully'
        ]);
    }

}
