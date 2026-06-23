<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

// Sanitize and validate email
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Please provide a valid email address.']);
    exit;
}

try {
    $db = new PDO('sqlite:' . __DIR__ . '/data/newsletter.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert email into the database
    $stmt = $db->prepare("INSERT INTO subscribers (email) VALUES (:email)");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    echo json_encode(['status' => 'success', 'message' => 'Thank you for subscribing to our newsletter!']);
} catch (PDOException $e) {
    // Handle duplicate entry error code for SQLite
    if ($e->getCode() == '23000') {
        echo json_encode(['status' => 'error', 'message' => 'This email is already subscribed.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Something went wrong. Please try again later.']);
    }
}
?>