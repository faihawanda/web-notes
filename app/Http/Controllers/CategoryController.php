<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Tambahkan ini agar Str::slug bisa digunakan

class CategoryController extends Controller
{
    public function index() {
        $categories = Categories::all();

        return view('category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // validasi apakah datanya benar dan sesuai harapan
        $request->validate([
            'name' => 'required|string|max:225',
            'color' => 'required|string' // Validasi untuk warna wajib diisi
        ], 
        [
            'name.required' => 'Nama kategori wajib diisi',
            'name.string' => 'Nama harus berupa teks',
            'color.required' => 'Warna kategori wajib dipilih', // Pesan error custom untuk warna
        ]);
        
        // proses menyimpan dalam database
        Categories::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'color' => $request->color // Menyimpan data warna yang dipilih user
        ]);

        // Opsional: Kembalikan halaman setelah sukses menyimpan
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }
}