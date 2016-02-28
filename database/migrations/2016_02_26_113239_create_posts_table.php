<?php

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
            $table->enum('type', ['article', 'photo', 'video']);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
            		->references('id')
            		->on('users')
            		->onDelete('restrict')
            		->onUpdate('restrict');
            $table->integer('type_key_id')->unsigned();
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
        Schema::table('posts', function (Blueprint $table) {
        	$table->dropForeign('posts_user_id_foreign');
        });
    	
    	Schema::drop('posts');
    }
}
