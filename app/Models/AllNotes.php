<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllNotes extends Model
{
   protected $fillable = [
       'title',
       'content',
       'category_id'
   ];

   public function category()
   {
       return $this->belongsTo(Categories::class, 'category_id');
   }
}
