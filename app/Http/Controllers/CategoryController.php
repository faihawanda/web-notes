<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index() {
        $categories = Categories::all();

        return view('category.index', compact('categories'));
    }

    public function store(Request $request) {

        // validasi input data
        $request->validate([
            'name' => 'required|string|max:225',
            'color' => 'required|string'
        ], 
        [
            'name.required' => 'Category name is required',
            'name.string' => 'Category name must be a string',
            'color.required' => 'Category color is required',
        ]);
        
        // proses penyimpanan ke database
        Categories::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'color' => $request->color // Menyimpan data warna yang dipilih user
        ]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }

    public function update(Request $request, $id) {

        // validasi input data
        $request->validate([
            'name' => 'required|string|max:225',
            'color' => 'required|string'
        ]);

        // cari kategorinya, lalu update ke database
        $category = Categories::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'color' => $request->color
        ]);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    public function destroy($id) {
        $category = Categories::findOrFail($id);

        // menghapus data
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}

