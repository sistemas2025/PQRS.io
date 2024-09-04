<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULARIO DE PQR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
    <div class="text-center">
    <img src="logo/bopetin.png"alt="Imagen de la portada" class="img-fluid" style="max-width: 550px; height: 150px;">
        </div>
    </div>
    <form action="correo.php" method="post">
        <h2>FORMULARIO DE PQRS</h2>
        <div class="mb-3">
             <!-- Resto del formulario -->
            <P>Tus ideas (requerimientos) nos interesa, danos a conocerlas. Los datos serán tratados de acuerdo a lo previsto en la Ley 1581 de 2012 “por la cual se dictan las disposiciones generales para la protección de datos personales”.</P>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required><br>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo electronico</label>
            <input type="text" class="form-control" id="correo" name="correo" required><br>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required><br>
        </div>
        <label for="descripcion">Descripción:</label>
        <select id="descripcion" name="descripcion" required>
            <option value="Peticion">Peticion</option>
            <option value="Queja">Queja</option>
            <option value="Reclamo">Reclamo</option>
            <option value="Sugerencia">Sugerencia</option>
            <option value="Otro">Otro</option>
                <?php
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

                // Cerrar la conexión
                $conn->close();
                ?>
            </select>
        </div>
        <div class="mb-3">
            <form action="correo.php" method="post">
            <label for="proceso" class="form-label">Proceso dirigido a</label>
            <select class="form-control" id="proceso" name="proceso" required>
            <option value="">Seleccionar proceso</option>
            <option value="Gestion_humana">GESTION HUMANA</option>
            <option value="COMPRAS">COMPRAS</option>
            <option value="TALLER">DISEÑO Y TALLER</option>
            <option value="GERENCIA">GERENCIA</option>
            <option value="PRODUCCION">PRODUCCION</option>
            <option value="LOGISTICA">PLANEACION Y LOGISTICA</option>
            <option value="COMERCIAL">COMERCIAL INVESTIGACION Y DESARROLLO</option>
            <option value="SST">SEGURIDAD Y SALUD EN EL TRABAJO (SST)</option>
            <option value="VENTAS">VENTAS</option>
            <option value="CALIDAD">CONTROL CALIDAD</option>
            <option value="MANTENIMIENTO">MANTENIMIENTO</option>
            <option value="SISTEMAS">SISTEMAS</option>
            <option value="SEGURIDAD">SEGURIDAD</option>
            </select>

        </div>
        <div class="mb-3">
            <label for="observacion" class="form-label">Observación</label>
            <textarea class="form-control" id="observacion" name="observacion" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
        <p>Para  RPMCOLOMBIA S.A es importante dar respuesta a los requerimientos de nuestros clientes, por lo tanto haremos llegar el seguimiento al correo inscrito en la encuesta.</p>
    </form>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>