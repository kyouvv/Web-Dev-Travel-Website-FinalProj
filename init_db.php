<?php
// init_db.php
try {
    $dbDir = __DIR__ . '/data';
    if (!is_dir($dbDir)) {
        mkdir($dbDir, 0755, true);
    }

    $db = new PDO('sqlite:' . $dbDir . '/newsletter.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create Subscribers table (if not already existing)
    $db->exec("CREATE TABLE IF NOT EXISTS subscribers (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT UNIQUE,
        subscribed_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Create Users table for Authentication
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT,
        email TEXT UNIQUE,
        password TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    echo "Database schemas verified successfully.";
} catch (PDOException $e) {
    echo "Initialization Error: " . $e->getMessage();
}
?>