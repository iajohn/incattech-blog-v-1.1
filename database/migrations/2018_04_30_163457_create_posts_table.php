<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('featuredImg');
            $table->string('imgCredit')->nullable();
            $table->text('body');
            $table->integer('view_count')->default(0);
            $table->boolean('editors_pick')->default(0);
            $table->boolean('status')->default(false);
            $table->boolean('is_approved')->default(false);
            // $table->foreign('user_id')
            //     ->references('id')->on('users')
            //     ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
