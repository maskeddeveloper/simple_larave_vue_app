<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;
class NotesController extends Controller
{
    //
    public function storeNote(Request $request) {
        $note = new Notes();
        $note->title = $request->title;
        $note->note = $request->note;
        $note->save();

        return $note;
    }


    public function getNotes(Request $request) {
        $notes = Notes::all();

        return $notes;
    }


    public  function editNote(Request $request, $id){
        $note = Notes::where('id',$id)->first();

        $note->title = $request->get('val_1');
        $note->note = $request->get('val_2');
        $note->save();

        return $note;
    }

    public function deleteNote(Request $request){
        $note = Notes::find($request->id)->delete();
    }



}
