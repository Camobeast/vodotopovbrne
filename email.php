<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data
    $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $messageText = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

    // Validate form fields
    if (empty($name)) {
        $errors[] = 'Vyplňte prosím jméno';
    }

    if (empty($email)) {
        $errors[] = 'Vyplňte prosím email';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Vyplňte prosím platný email';
    }

    if (empty($messageText)) {
        $errors[] = 'Pole zpráva je prázdné';
    }

    // If no errors, send email
    if (empty($errors)) {
        $recipient = "vodotopovbrne@seznam.cz";
        $subject = "Nová zpráva od: $name"; // Include the sender's name in the subject

        // Format message as HTML
        $message = "
        <html>
        <head>
          <title>Nová zpráva od $name</title>
        </head>
        <body>
          <table>
            <tr>
              <th>Jméno</th><td>$name</td>
            </tr>
            <tr>
              <th>Email</th><td>$email</td>
            </tr>
            <tr>
            " . (!empty($phone) ? "<th>Tel. číslo:</th>" : "") . "" . (!empty($phone) ? "<td>$phone</td>" : "") . "
            <tr>
              <th>Zpráva</th><td>$messageText</td>
            </tr>
          </table>
        </body>
        </html>
        ";

        // To send HTML mail, the Content-type header must be set
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // Additional headers
        $headers .= "From: $name <$email>" . "\r\n";

        // Send email
        if (mail($recipient, $subject, $message, $headers)) {
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
