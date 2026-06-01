<?php

namespace App\Http\Controllers;

use App\Models\AllNotes;
use Illuminate\Http\Request;

class AllNotesController extends Controller
{
    // tampil halaman
    public function index()
    {
        $notes = AllNotes::latest()->get();

        return view('notes.index', compact('notes'));
    }

    // tambah data
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'color' => 'required'
        ]);

        AllNotes::create([
            'title' => $request->title,
            'content' => $request->content,
            'color' => $request->color
        ]);

        return redirect()->back();
    }

    // update data
    public function update(Request $request, $id)
    {
        $note = AllNotes::findOrFail($id);

        $note->update([
            'title' => $request->title,
            'content' => $request->content,
            'color' => $request->color
        ]);

        return redirect()->back();
    }

    // delete data
    public function destroy($id)
    {
        $note = AllNotes::findOrFail($id);

        $note->delete();

        return redirect()->back();
    }
}

