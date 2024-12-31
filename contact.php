<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP; // Add this line to import the SMTP class

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
       
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set Gmail as the SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'shivsaranyadav086@gmail.com'; // Your Gmail address
        $mail->Password = 'Ratan@0865'; // Use your App password if 2FA is enabled
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL encryption (port 465)
        $mail->Port = 465; // Port for SSL

        // Recipients
        $mail->setFrom('shivsaranyadav086@gmail.com', 'Shivsaran Yadav');
        $mail->addAddress($email); // Email to receive the message

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Message from ' . $name . ': ' . $subject;
        $mail->Body    = "<b>Name:</b> $name<br><b>Email:</b> $email<br><b>Subject:</b> $subject<br><b>Message:</b><br>$message";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        // Send the email
        $mail->send();
        echo 'Message has been sent successfully!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method. Please use POST.";
}
?>
