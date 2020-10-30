<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id()->onDelete('cascade');
            $table->timestamps();
            $table->string('title');
            $table->string('image');
            $table->text('description');
            $table->text('active');


            $table->unsignedBigInteger('postedby');
            $table->foreign('postedby')->references('id')->on('users');

            $table->unsignedBigInteger('category')->onUpdate('no action');
            $table->foreign('category')->references('id')->on('categories');
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
