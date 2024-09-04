<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluye los archivos de PHPMailer
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $fecha = $_POST['fecha'];
    $correo = $_POST['correo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion']; // Asegúrate de que este campo sea texto
    $proceso = $_POST['proceso'];
    $observacion = $_POST['observacion'];
  
        // Mapeo de valores a descripciones
        $descripcionMap = [
            'Peticion' => 'Peticion',
            'Queja' => 'Queja',
            'Reclamo' => 'Reclamo',
            'Sugerencia' => 'Sugerencia',
            'Otro' => 'Otro'
            // Agrega más mapeos según tus necesidades
        ];
    
        // Convertir el valor de descripción a texto descriptivo
        $descripcionTexto = isset($descripcionMap[$descripcion]) ? $descripcionMap[$descripcion] : 'Descripción no válida';

    // Datos de conexión a la base de datos
    $servername = "192.168.111.176";
    $username = "bckebos";
    $password = "A830031045a";
    $dbname = "gestio_humana";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO formulario_pqr (fecha, correo, nombre, descripcion, proceso, observacion) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $fecha, $correo, $nombre, $descripcion, $proceso, $observacion);

    if ($stmt->execute()) {
        echo "Registro guardado exitosamente en la base de datos.";
    } else {
        echo "Error al guardar el registro: " . $conn->error;
    }


    // Mapear procesos a correos electrónicos
    $emails = [
        'Gestion_humana' => 'GESTIONHUMANA@RPMCOLOMBIA.CO',
        'COMPRAS' => 'COMPRAS@RPMCOLOMBIA.CO',
        'TALLER' => 'PJORGE@RPMCOLOMBIA.CO',
        'GERENCIA' => 'APEDRO@RPMCOLOMBIA.CO;ADANIEL@RPMCOLOMBIA.CO;GADIELA@RPMCOLOMBIA.CO',
        'PRODUCCION' => 'SMARCOS@RPMCOLOMBIA.CO',
        'LOGISTICA' => 'RMAULE@RPMCOLOMBIA.CO;LANGELICA@RPMCOLOMBIA.CO',
        'COMERCIAL' => 'FDOMINGO@RPMCOLOMBIA.CO;BLUIS@RPMCOLOMBIA.CO',
        'SST' => 'SST_@RPMCOLOMBIA.CO',
        'VENTAS' => 'VENTAS@RPMCOLOMBIA.CO',
        'CALIDAD' => 'CLUCY@RPMCOLOMBIA.CO',
        'MANTENIMIENTO' => 'GGILBERTO@RPMCOLOMBIA.CO',
        'SISTEMAS' => 'SISTEMAS@RPMCOLOMBIA.CO',
        'SEGURIDAD' => 'PORLANDO@RPMCOLOMBIA.CO',
    ];

    // Verificar si el proceso seleccionado tiene un correo asignado
    if (array_key_exists($proceso, $emails)) {
        // Obtener las direcciones de correo electrónico
        $emailList = explode(';', $emails[$proceso]);  // Convertir la cadena de correos a un array
        $asunto = "Notificacion de PQRS - " . $proceso;
        $mensaje = "Nuevo requerimiento:\n\n";
        $mensaje .= "Fecha: $fecha\n";
        $mensaje .= "Correo: $correo\n";
        $mensaje .= "Nombre: $nombre\n";
        $mensaje .= "Descripcion: $descripcion\n";
        $mensaje .= "Proceso: $proceso\n";
        $mensaje .= "Observacion: $observacion\n";

        // Crear una nueva instancia de PHPMailer
        $mail = new PHPMailer(true);

        // Crear una nueva instancia de PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->SMTPDebug = 0;                      // Habilitar salida de depuración detallada
            $mail->isSMTP();                           // Enviar usando SMTP
            $mail->Host       = 'mail.rpmcolombia.co'; // Servidor SMTP
            $mail->SMTPAuth   = true;                  // Habilitar autenticación SMTP
            $mail->Username   = 'EBOS@RPMCOLOMBIA.CO'; // Usuario SMTP
            $mail->Password   = 'A830031045a';        // Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Habilitar encriptación TLS implícita
            $mail->Port       = 465;                   // Puerto TCP para la conexión
            // Agregar destinatarios del array
            foreach ($emailList as $recipient) {
            $mail->addAddress(trim($recipient));  // Añadir destinatario
            $mail->setFrom('SISTEMAS@RPMCOLOMBIA.CO', 'SISTEMAS');
            $mail->setFrom('GESTIOHUMANA@RPMCOLOMBIA.CO', 'GESTIONHUMANA');
            $mail->setFrom('GCOMPRAS@RPMCOLOMBIA.CO', 'SEGURIDAD');
            $mail->setFrom('PJORGE@RPMCOLOMBIA.CO', 'JORGEPINTO');
            $mail->setFrom('APEDRO@RPMCOLOMBIA.CO', 'PEDRO');
            $mail->setFrom('ADANIEL@RPMCOLOMBIA.CO', 'DANIEL');
            $mail->setFrom('GGILBERTO@RPMCOLOMBIA.CO', 'GILBERTO');
            $mail->setFrom('ASEBASTIAN@RPMCOLOMBIA.CO', 'SEBASTIAN');
            $mail->setFrom('SMARCOS@RPMCOLOMBIA.CO', 'MARCOS');
            $mail->setFrom('RMANUEL@RPMCOLOMBIA.CO', 'JUAN_MANUEL');
            $mail->setFrom('LANGELICA@RPMCOLOMBIA.CO', 'ANGELICA');
            $mail->setFrom('FDOMINGO@RPMCOLOMBIA.CO', 'DOMINGO');
            $mail->setFrom('BLUIS@RPMCOLOMBIA.CO', 'BLUIS');
            $mail->setFrom('SST_@RPMCOLOMBIA.CO', 'SST');
            $mail->setFrom('VENTAS@RPMCOLOMBIA.CO', 'VENTAS');
            $mail->setFrom('CLUCY@RPMCOLOMBIA.CO', 'CALIDAD');
            $mail->setFrom('PORLANDO@RPMCOLOMBIA.CO', 'SEGURIDAD');
            $mail->setFrom('CORREO_MASIVO1@RPMCOLOMBIA.CO', 'PQR');
            }
            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body    = $mensaje;

            // Enviar el correo
            $mail->send();
            echo "Correo enviado exitosamente a: " . implode(', ', $emailList);
        } catch (Exception $e) {
            echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
        }
    } else {
        echo "Proceso no válido.";
    }
} else {
    echo "Solicitud no válida.";
}
?>
<!-- Formulario HTML para enviar datos -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="FormularioPQR.php" method="post">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>