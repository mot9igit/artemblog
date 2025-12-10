<?php

use App\Models\Organization;
use App\Models\Requizite;
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
        Schema::create('org_requizites', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Organization::class)->constrained();
            $table->foreignIdFor(Requizite::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('org_requizites');
    }
};
