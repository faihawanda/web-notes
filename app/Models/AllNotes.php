<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllNotes extends Model
{
    protected $fillable = [
        'title',
        'content',
        'color'
    ];
}
