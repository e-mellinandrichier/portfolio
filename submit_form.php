<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize inputs
  $name = htmlspecialchars($_POST['name']);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $message = htmlspecialchars($_POST['message']);

  // Validate inputs
  if (empty($name) || empty($email) || empty($message)) {
    die("All fields are required.");
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
  }

  // Send email (configure your SMTP settings)
  $to = "your@email.com";
  $subject = "New Message from $name";
  $headers = "From: $email";
  
  if (mail($to, $subject, $message, $headers)) {
    echo "Message sent successfully!";
  } else {
    echo "Failed to send message.";
  }
}
?>