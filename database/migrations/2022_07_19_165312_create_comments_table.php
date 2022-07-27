<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('comments');
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->text('content');
            // $table->unsignedBigInteger('blog_post_id')
            //     ->index();
            // $table->dropIfExists()->foreignId("blog_post_id");
            $table->foreignId("blog_post_id")
                // ->references('id')->on('blog_posts')
                ->constrained('blog_posts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            if (env('DB_CONNECTION') !== 'sqlite_testing') {
                $table->dropForeign(['blog_post_id']);
            }
            // $table->foreignId('blog_posts_id')
            //     ->index()
            //     ->unique()
            //     ->references('id')->on('blog_posts')
            //     ->constrained()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
