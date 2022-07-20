<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('ingredient_translations', function (Blueprint $table){
            $table->id();
            $table->foreignId('locale_id')->references('id')->on('locales')->onDelete('cascade');

            $table->string('title');

            $table->unique(['ingredient_id','locale_id']);
            $table->foreignId('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
        Schema::dropIfExists('ingredient_translations');
    }
};
