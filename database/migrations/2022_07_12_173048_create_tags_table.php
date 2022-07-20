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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->timestamps();

            $table->unique(['id','slug']);
        });

        Schema::create('tag_translations', function (Blueprint $table){
            $table->id();
            $table->foreignId('locale_id')->references('id')->on('locales')->onDelete('cascade');

            $table->string('title');

            $table->unique(['tag_id','locale_id']);
            $table->foreignId('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('tag_translations');
    }
};
