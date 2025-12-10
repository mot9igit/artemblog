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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("name_short")->nullable();
            $table->string("address")->nullable();
            $table->string("description")->nullable();
            $table->string("coordinats")->nullable();
            $table->foreignId("city_id")->nullable()->constrained();
            $table->unsignedSmallInteger("active")->default(0);
            $table->unsignedSmallInteger("integration_type")->default(0);
            $table->unsignedSmallInteger("marketplace")->default(0);
            $table->unsignedSmallInteger("opt_marketplace")->default(0);
            $table->string("version")->nullable();
            $table->string("yml_file")->nullable();
            $table->unsignedSmallInteger("check_remains")->default(0);
            $table->unsignedSmallInteger("check_docs")->default(0);
            $table->dateTime("date_api_ping")->nullable();
            $table->dateTime("date_remains_update")->nullable();
            $table->dateTime("date_docs_update")->nullable();
            $table->json("properties")->default(new Expression('(JSON_ARRAY())'));
            $table->softDeletes();
            $table->timestamps();

            $table->index('city_id', 'store_city_id_idx');
            $table->index('active', 'store_active_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
