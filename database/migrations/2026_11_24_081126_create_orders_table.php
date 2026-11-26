<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->string('visitor_name');
            $table->string('visitor_whatsapp', 20);
            $table->date('visit_date');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('total_price');
            $table->enum('payment_status', ['pending', 'paid', 'expired'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
