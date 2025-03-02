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
        Schema::create('bill_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('proof_archive_id')->nullable()->constrained('archives')->cascadeOnDelete();
            $table->foreignId('paid_currency_id')->nullable()->constrained('currencies')->cascadeOnDelete();
            $table->double('paid_amount')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('type')->nullable();
            $table->double('bill_currency_equal_value')->nullable();
            $table->double('bill_currency_equal_total')->nullable();
            $table->longText('note')->nullable();

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
        Schema::dropIfExists('bill_payments');
    }
};
