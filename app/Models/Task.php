<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'status'
    ];

    // TAMBAHKAN INI YA!
    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }
}
