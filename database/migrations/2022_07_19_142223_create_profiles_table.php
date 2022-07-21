<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('profiles');
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // $table->unsignedInteger('author_id')->unique();
            // $table->foreign('author_id')->references('id')->on('authors');
            $table->foreignId('author_id')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->constrained('authors');
            // ->unique()
            // ->references('id')->on()
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
