<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de los datos de entrada
    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['cargo']) && isset($_POST['cedula']) && isset($_POST['proceso'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cargo = $_POST['cargo'];
        $cedula = $_POST['cedula'];
        $proceso = $_POST['proceso'];

        // Preparar y ejecutar la consulta para evitar inyección SQL
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellido, cargo, cedula, proceso) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $apellido, $cargo, $cedula, $proceso);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Usuario registrado correctamente');
                    window.location.href = 'FormularioPQR.php';
                  </script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos.";
    }
}

// Cerrar la conexión
$conn->close();