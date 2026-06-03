<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Categories extends Model
{

   protected $table = 'categories';

   protected $fillable = [
       'name',
       'slug',
       'color'
   ];

   public function notes()
   {
       return $this->hasMany(AllNotes::class,'category_id');
   }

}
