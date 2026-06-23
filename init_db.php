<?php
$dbDir = __DIR__ . '/data';
if (!is_dir($dbDir)) {
    mkdir($dbDir, 0755, true);
}

try {
    $db = new PDO('sqlite:' . $dbDir . '/newsletter.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create subscribers table
    $query = "CREATE TABLE IF NOT EXISTS subscribers (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT UNIQUE NOT NULL,
        subscribed_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    
    $db->exec($query);
    echo "Database and table initialized successfully!";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>