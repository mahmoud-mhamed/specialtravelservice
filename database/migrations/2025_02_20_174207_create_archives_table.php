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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('collection_name')->nullable();
            $table->string('file')->nullable();
            $table->foreignId('bill_id')->nullable()->constrained();
            $table->foreignId('client_id')->nullable()->constrained();
            $table->foreignId('disabled_client_id')->nullable()->constrained('clients');

            $table->nullableMorphs('created_by');
            $table->nullableMorphs('updated_by');
            $table->nullableMorphs('deleted_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};
