<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('video_title')->nullable();
            $table->string('video_slug')->unique();
            $table->string('video_cover_location')->nullable();
            $table->text('video_details')->nullable();
            $table->string('video_desc')->nullable();
            $table->integer('video_channel')->unsigned();
            $table->string('video_tags')->nullable();
            $table->string('video_duration', 10)->nullable();
            $table->string('video_access', 20)->nullable();
            $table->string('video_type', 10)->nullable();
            $table->text('video_source')->nullable();
            $table->integer('video_favorites')->unsigned()->default(0);
            $table->integer('video_views')->unsigned()->default(0);
            $table->string('featured', 2)->nullable();
            $table->string('active', 2)->nullable();
            $table->boolean('editors_pick')->default(0);
            $table->boolean('status')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->integer('created_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('video_channel')
            //       ->references('id')
            //       ->on('Channels')
            //       ->onUpdate('cascade')
            //       ->onDelete('cascade');
            
            $table->foreign('created_by')
                  ->references('id')->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            
            // $table->integer('user_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
