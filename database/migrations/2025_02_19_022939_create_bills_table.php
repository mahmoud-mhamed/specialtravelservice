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
            $table->foreignId('supplier_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('client_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('disabled_client_id')->nullable()->constrained('clients')->cascadeOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('purchase_type')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('car_type')->nullable();
            $table->date('shipping_date')->nullable();
            $table->string('shipping_type')->nullable();
            $table->string('shipping_amount')->nullable();
            $table->string('policy_number')->nullable();
            $table->string('notes')->nullable();
            $table->string('status')->nullable();

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
