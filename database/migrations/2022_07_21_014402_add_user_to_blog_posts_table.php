<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserToBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            // $table->unsignedBigInteger('user_id');
            // $table->foreignId("user_id")
            //     // ->references('id')
            //     ->constrained('users');

            if (env('DB_CONNECTION') === 'sqlite_testing') {
                $table->foreignId("user_id")
                    ->default(0)
                    // ->references('id')
                    ->constrained('users');
            } else {
                $table->foreignId("user_id")
                    // ->references('id')
                    ->constrained('users');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
