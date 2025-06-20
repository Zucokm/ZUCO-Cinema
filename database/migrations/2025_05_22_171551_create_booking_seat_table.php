<?php

use App\Models\Booking;
use App\Models\Seat;
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
        Schema::create('booking_seat', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Booking::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Seat::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_seat');
    }
};
