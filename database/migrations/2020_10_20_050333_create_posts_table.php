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
            $table->id();
            $table->string('title', 255);
            $table->text('content');        
            $table->string('slug', 255)->nullable();
            $table->string('seo_meta_title', 255)->nullable();
            $table->string('seo_meta_description', 255)->nullable();    
            $table->string('seo_meta_keyword', 255)->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        if (Schema::hasTable('users')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            });
        }
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
