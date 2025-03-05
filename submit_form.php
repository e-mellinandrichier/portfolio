<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
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
  $to = "emmanuelle.mellinand-richier@laplateforme.io";
  $subject = "New Message from $name";
  $headers = "From: $email";
  
  if (mail($to, $subject, $message, $headers)) {
    echo "Message sent successfully!";
  } else {
    echo "Failed to send message.";
  }

  if (mail($to, $subject, $message, $headers)) {
    echo "Message sent successfully!";
  } else {
    echo "Failed to send message. Check mail server settings.";
  }

}
?>