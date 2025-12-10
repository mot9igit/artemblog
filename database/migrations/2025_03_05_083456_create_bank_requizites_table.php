<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bank_requizites', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("number");
            $table->string("knumber");
            $table->string("bik");
            $table->foreignId("requizite_id")->nullable()->constrained();
            $table->json("properties")->default(new Expression('(JSON_ARRAY())'));
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_requizites');
    }
};
