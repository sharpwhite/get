<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Initialize an array to store error messages
    $errors = [];

    // Validate name
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate message
    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    // If there are no errors, proceed to send the email
    if (empty($errors)) {
        // Recipient email addresses
        $to = "sharpibrah@gmail.com, ssarank45@gmail.com";
        $subject = "New Contact Form Submission";

        // Create the email body
        $body = "Name: $name\nEmail: $email\nMessage:\n$message";
        $headers = "From: $email\r\n"; // Set the "From" header

        // Attempt to send the email
        if (mail($to, $subject, $body, $headers)) {
            echo "Message sent successfully!";
        } else {
            echo "Failed to send message. Please try again later.";
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
} else {
    echo "Invalid request. Please submit the form.";
}
?>
