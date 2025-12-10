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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("image")->nullable();
            $table->string("address")->nullable();
            $table->string("description")->nullable();
            $table->foreignId("owner_id")->nullable()->constrained(
                table: 'organizations', indexName: 'organization_owner_id_idx'
            );
            $table->unsignedBigInteger("bitrix_id")->nullable();
            $table->unsignedSmallInteger("active")->default(0);
            $table->json("properties")->default(new Expression('(JSON_ARRAY())'));
            $table->softDeletes();
            $table->timestamps();

            $table->index('active', 'organization_active_idx');
            $table->index('bitrix_id', 'organization_bitrix_id_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
