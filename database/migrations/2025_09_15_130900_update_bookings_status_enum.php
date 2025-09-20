<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update enum to include checked-in and on-pickup
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending','confirmed','checked-in','completed','cancelled','on-pickup') NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        // Revert back to the original enum
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending'");
    }
};
