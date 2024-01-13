<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["detail_masalah"];

    // Konfigurasi Mailtrap
    $smtpHost = "sandbox.smtp.mailtrap.io";
    $smtpPort = 2525;
    $smtpUsername = "006a0d0ebf69a1";
    $smtpPassword = "51516b09939056";

    // Konfigurasi email
    $to = "strixvero@gmail.com";
    $subject = "New Form Submission from " . $name;

    $mail = new PHPMailer(true);

    try {
        // Pengaturan konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host       = $smtpHost;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUsername;
        $mail->Password   = $smtpPassword;
        $mail->SMTPSecure = 'tls';  // Ganti dengan 'ssl' jika diperlukan
        $mail->Port       = $smtpPort;

        // Konfigurasi email
        $mail->setFrom($email, $name);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body    = "Name: " . $name . "\nEmail: " . $email . "\nMessage: " . $message;

        // Kirim email
        $mail->send();
        echo "Email berhasil dikirim";
    } catch (Exception $e) {
        echo "Gagal mengirim email. Pesan kesalahan: {$mail->ErrorInfo}";
    }
}
?>

