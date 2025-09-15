<?php

require_once __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    // Drop table if exists
    DB::statement('DROP TABLE IF EXISTS feedbacks');
    
    // Create feedbacks table
    DB::statement('
        CREATE TABLE feedbacks (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            rating INT NOT NULL,
            message TEXT NOT NULL,
            user_name VARCHAR(255) NULL,
            email VARCHAR(255) NULL,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        )
    ');
    
    echo "Feedbacks table created successfully!\n";
    
    // Test if table exists
    $result = DB::select("SHOW TABLES LIKE 'feedbacks'");
    if (count($result) > 0) {
        echo "Table confirmed to exist in database.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
