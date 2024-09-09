<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug: Check if form data is received
    file_put_contents('debug.log', print_r($_POST, true));

    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $to = "chaimakhoudrioff@gmail.com";
        $email_subject = "New contact form submission: $subject";
        $email_body = "You have received a new message from your website contact form.\n\n".
                      "Here are the details:\n\n".
                      "Name: $name\n".
                      "Email: $email\n".
                      "Subject: $subject\n".
                      "Message:\n$message";
        $headers = "From: $email\n";
        $headers .= "Reply-To: $email";

        if (mail($to, $email_subject, $email_body, $headers)) {
            echo "success";
        } else {
            echo "fail";
        }
    } else {
        echo "invalid_email";
    }
} else {
    echo "invalid_request";
}
?>
