<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if this is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize inputs
  $name = htmlspecialchars($_POST['name']);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $message = htmlspecialchars($_POST['message']);

  // Validate inputs
  if (empty($name) || empty($email) || empty($message)) {
    echo "Tous les champs sont obligatoires.";
    exit;
  }
  
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Format d'email invalide.";
    exit;
  }

  // Send email
  $to = "emmanuelle.mellinand-richier@laplateforme.io";
  $subject = "Nouveau message de $name";
  $email_content = "Nom: $name\n";
  $email_content .= "Email: $email\n\n";
  $email_content .= "Message:\n$message";
  
  $headers = "From: $email\r\n";
  $headers .= "Reply-To: $email\r\n";
  
  // Send and check success
  if (mail($to, $subject, $email_content, $headers)) {
    echo "Message envoyé avec succès!";
  } else {
    echo "Échec de l'envoi du message. Vérifiez les paramètres du serveur de messagerie.";
    
    // Log error for debugging
    error_log("Mail sending failed for $email with subject: $subject");
  }
} else {
  // Not a POST request
  echo "Méthode non autorisée.";
}
?>