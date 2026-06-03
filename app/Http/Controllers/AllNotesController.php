<?php


namespace App\Http\Controllers;


use App\Models\Categories;
use App\Models\AllNotes;
use Illuminate\Http\Request;


class AllNotesController extends Controller
{
   public function index() {

        $notes = AllNotes::with('category')->latest()->get();
        $categories = Categories::all();

        return view('allnotes.index', compact('notes', 'categories'));
   }

   public function create() {
       $categories = Categories::all();
       return view('allnotes.create', compact('categories'));
   }

   public function store(Request $request) {
       $request->validate([
           'title' => 'required',
           'content' => 'required',
           'category_id' => 'required'
       ]);


       AllNotes::create([
           'title' => $request->title,
           'content' => $request->content,
           'category_id' => $request->category_id,
       ]);
       return redirect()
           ->route('allnotes.index')
           ->with('success', 'Note created successfully!');
   }

    public function update(Request $request, $id) {
        $notes = AllNotes::findOrFail($id);


        $notes->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
         ]);


        return redirect()
            ->route('allnotes.index')
            ->with('success', 'Note updated successfully');
    }

    public function destroy($id){
       $notes = AllNotes::findOrFail($id);
       $notes->delete();


       return back()->with('success', 'Note deleted successfully!');
    }
}
