<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

    // Validate form fields
    if (empty($name)) {
        $errors[] = 'Vyplňte prosím jméno';
    }

    if (empty($email)) {
        $errors[] = 'Vyplňte prosím email';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Vyplňte prosím platný email';
    }

    if (empty($message)) {
        $errors[] = 'Pole zpráva je prázdné';
    }

    // If no errors, send email
    if (empty($errors)) {
        // Recipient email address (replace with your own)
        $recipient = "vodotopovbrne@seznam.cz";

        // Additional headers
        $headers = "Odesílatel: $name <$email>";

        // Send email
        if (mail($recipient, $message, $headers)) {
            echo "Email odeslán úspěšně.";
        } else {
            echo "Při odesílání se vyskytla chyba, zkuste to prosím znovu.";
        }
    } else {
        // Display errors
        echo "Formulář obsahuje chyby:<br>";
        foreach ($errors as $error) {
            echo "- $error<br>";
        }
    }
} else {
    // Not a POST request, display a 403 forbidden error
    header("HTTP/1.1 403 Forbidden");
    echo "You are not allowed to access this page.";
}
?>