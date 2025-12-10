<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('longtitle')->nullable();
            $table->text('introtext')->nullable();
            $table->text('content');
            $table->longText('dev_content')->nullable();
            $table->string('seotitle')->nullable();
            $table->text('seodescription')->nullable();
            $table->boolean('published')->default(false);
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->datetime('createdon');
            $table->datetime('publishedon');
            $table->integer('parent')->unsigned()->nullable();
            $table->unsignedBigInteger('createdby')->default(0);
            $table->foreign('createdby')->references('id')->on('users');
            $table->unsignedBigInteger('updatedby')->default(0);
            $table->foreign('updatedby')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
