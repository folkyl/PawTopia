<?php

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Load Laravel environment
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Create the feedbacks table
    Capsule::schema()->dropIfExists('feedbacks');
    
    Capsule::schema()->create('feedbacks', function ($table) {
        $table->id();
        $table->integer('rating');
        $table->text('message');
        $table->string('user_name')->nullable();
        $table->string('email')->nullable();
        $table->timestamps();
    });
    
    echo "Feedbacks table created successfully!\n";
    
} catch (Exception $e) {
    echo "Error creating table: " . $e->getMessage() . "\n";
}
