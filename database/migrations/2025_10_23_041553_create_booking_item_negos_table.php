<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_item_negos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->string('jenis'); // contoh: 'batik', 'kesenian', 'kuliner', 'homestay', dll
            $table->unsignedBigInteger('item_id'); 
            $table->integer('harga_awal');
            $table->integer('harga_nego')->nullable(); 
            $table->integer('jumlah_visitor')->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_item_negos');
    }
};
