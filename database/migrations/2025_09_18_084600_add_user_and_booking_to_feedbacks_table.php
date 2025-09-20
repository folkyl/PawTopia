<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            if (!Schema::hasColumn('feedbacks', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('members')->nullOnDelete();
            }
            if (!Schema::hasColumn('feedbacks', 'booking_id')) {
                $table->foreignId('booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            if (Schema::hasColumn('feedbacks', 'booking_id')) {
                $table->dropConstrainedForeignId('booking_id');
            }
            if (Schema::hasColumn('feedbacks', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
        });
    }
};
