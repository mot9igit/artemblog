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
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string("key");
            $table->string("name");
            $table->string("name_r");
            $table->string("code");
            $table->string("fias_id")->nullable();
            $table->string("postal_code")->nullable();
            $table->foreignId("country_id")->nullable()->constrained();
            $table->unsignedBigInteger("population")->nullable();
            $table->unsignedSmallInteger("active")->default(0);
            $table->json("properties")->default(new Expression('(JSON_ARRAY())'));
            $table->softDeletes();
            $table->timestamps();

            $table->index('key', 'region_key_idx');
            $table->index('code', 'region_code_idx');
            $table->index('active', 'region_active_idx');
            $table->index('fias_id', 'region_fias_id_idx');
            $table->index('postal_code', 'region_postal_code_idx');
            $table->index('population', 'region_population_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
