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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->nullable();
            $table->string('service')->nullable();
            $table->string('price')->nullable();
            $table->string('notes')->nullable();
            $table->string('status')->default(\App\Enums\BillStatusEnum::PENDING->value);

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
        Schema::dropIfExists('bills');
    }
};
