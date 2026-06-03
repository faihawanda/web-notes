<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
   /**
    * Run the migrations.
    */
   public function up(): void
   {
       Schema::table('all_notes', function (Blueprint $table) {
           $table->foreignId('category_id')
               ->nullable()
               ->after('content')
               ->constrained('categories')
               ->cascadeOnDelete();
           $table->dropColumn('color');
       });
   }


   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
       Schema::table('all_notes', function (Blueprint $table) {
           //
       });
   }
};

