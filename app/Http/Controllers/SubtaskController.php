<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    public function toggle(Subtask $subtask)
    {
        // Membalikkan status boolean: jika 0 jadi 1, jika 1 jadi 0
        $subtask->is_completed = !$subtask->is_completed;
        $subtask->save();

        return redirect()->back()->with('success', 'Status subtask diperbarui!');
    }

    public function destroy(Subtask $subtask)
    {
        // Hapus subtask dari database
        $subtask->delete();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Subtask berhasil dihapus!');
    }
}
