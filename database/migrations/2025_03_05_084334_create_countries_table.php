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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string("key");
            $table->string("name");
            $table->string("fias_id")->nullable();
            $table->string("postal_code")->nullable();
            $table->unsignedBigInteger("population")->nullable();
            $table->unsignedSmallInteger("active")->default(0);
            $table->json("properties")->default(new Expression('(JSON_ARRAY())'));
            $table->softDeletes();
            $table->timestamps();

            $table->index('key', 'country_key_idx');
            $table->index('active', 'country_active_idx');
            $table->index('fias_id', 'country_fias_id_idx');
            $table->index('postal_code', 'country_postal_code_idx');
            $table->index('population', 'country_population_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
