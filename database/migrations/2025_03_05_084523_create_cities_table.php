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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string("key");
            $table->string("name");
            $table->string("name_r")->nullable();
            $table->string("fias_id")->nullable();
            $table->string("postal_code")->nullable();
            $table->unsignedBigInteger("population")->nullable();
            $table->foreignId("region_id")->nullable()->constrained();
            $table->unsignedSmallInteger("active")->default(0);
            $table->json("properties")->default(new Expression('(JSON_ARRAY())'));
            $table->softDeletes();
            $table->timestamps();

            $table->index('region_id', 'city_region_idx');
            $table->index('active', 'city_active_idx');
            $table->index('fias_id', 'city_fias_id_idx');
            $table->index('postal_code', 'city_postal_code_idx');
            $table->index('population', 'city_population_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
