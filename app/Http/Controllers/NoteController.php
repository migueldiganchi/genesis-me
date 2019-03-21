<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * Creates a new note
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $errors = $this->validateNote($request);
        if (!empty($errors)) {
            return response()->json($errors, 422);
        }
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
        $errors = $this->validateNote($request);
        if (!empty($errors)) {
            return response()->json($errors, 422);
        }
        $note = Note::find($id);
        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->save();

        return response()->json($note);
    }

    /**
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

    /**
     * Validates if a note has a valid information to be saved
     * 
     * @return Array
     * 
     */
    private function validateNote($request) {
        $rules = [
            'title' => 'required|min:3|max:42',
            'content' => 'required|min:3|max:75'
        ];
        
        $messages = [ 
            'required' => 'This field is required', 
            'min' => 'Too short', 
            'max' => 'Too long' 
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $validator->errors()->getMessages();
        }

        return [];
    }

}
