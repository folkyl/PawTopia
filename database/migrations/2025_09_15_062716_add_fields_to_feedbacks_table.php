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
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->string('user_name')->nullable()->after('user_id');
            $table->string('email')->nullable()->after('user_name');
            $table->string('status')->default('pending')->after('message');
            $table->timestamp('replied_at')->nullable()->after('status');
            $table->text('reply_message')->nullable()->after('replied_at');
            
            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['user_id']);
            
            // Drop columns
            $table->dropColumn([
                'user_id',
                'user_name',
                'email',
                'status',
                'replied_at',
                'reply_message'
            ]);
        });
    }
};
