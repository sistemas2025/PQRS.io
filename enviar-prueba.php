<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->SMTPDebug = 0;                      // Habilitar salida de depuración detallada
    $mail->isSMTP();                           // Enviar usando SMTP
    $mail->Host       = 'mail.rpmcolombia.co'; // Servidor SMTP
    $mail->SMTPAuth   = true;                  // Habilitar autenticación SMTP
    $mail->Username   = 'sistemas@rpmcolombia.co'; // Usuario SMTP
    $mail->Password   = 'A900487308a';        // Contraseña SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Habilitar encriptación TLS implícita
    $mail->Port       = 465;                   // Puerto TCP para la conexión

    // Remitente y destinatario
    $mail->setFrom('sistemas@rpmcolombia.co', 'SISTEMAS');
    $mail->addAddress('GEDWIN@RPMCOLOMBIA.CO', 'GEDWIN'); // Añadir destinatario
    // Contenido del correo
    $mail->isHTML(true);                                  // Formato del correo en HTML
    $mail->Subject = 'Asunto importante ';
    $mail->Body    = 'Contestacion de formulario';

    $mail->send();
    echo 'El mensaje se envió correctamente';
} catch (Exception $e) {
    echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
}
