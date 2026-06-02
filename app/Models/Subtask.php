<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    // TAMBAHKAN PROPERTI INI 
    protected $fillable = [
        'task_id',
        'text',
        'is_completed'
    ];

    // Relasi balik ke task utama
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
