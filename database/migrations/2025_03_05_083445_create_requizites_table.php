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
        Schema::create('requizites', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("ogrn");
            $table->string("inn");
            $table->string("kpp");
            $table->string("ur_address");
            $table->string("fact_address");
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
        Schema::dropIfExists('requizites');
    }
};
