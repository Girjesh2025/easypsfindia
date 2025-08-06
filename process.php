<?php
header('Content-Type: application/json');

// Simple configuration
$admin_email = 'girjesh.ai25@gmail.com';
$file_name = 'subscribers_list.txt';

// Get the email from POST request
$subscriber_email = $_POST['email'] ?? '';

// Basic validation
if (empty($subscriber_email) || !filter_var($subscriber_email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Save to file
$date = date('Y-m-d H:i:s');
file_put_contents($file_name, "$date - $subscriber_email\n", FILE_APPEND);

// Prepare simple email
$subject = "New Subscriber - EasyPDF India";
$message = "New subscriber: $subscriber_email\nDate: $date";

// Send email
$sent = mail($admin_email, $subject, $message);

// Response
if ($sent) {
    echo json_encode(['success' => true, 'message' => 'Thank you for subscribing!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Subscription saved, but notification failed.']);
}
?>
