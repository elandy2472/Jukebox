<!-- archivo: actualizar_empresa.php -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jukebox";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos de la empresa
if (isset($_GET['nit'])) {
    $nit = $_GET['nit'];
    $sql = "SELECT * FROM empresa WHERE nit='$nit'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $empresa = $result->fetch_assoc();
    } else {
        echo "No se encontraron datos.";
        exit();
    }
} else {
    echo "NIT no proporcionado.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/actualizar_empresa.css">
    <title>Actualizar Empresa</title>
</head>
<body>
    <div class="container">
    <section class="register">
        <h2>Actualizar Datos de la Empresa</h2>
        <form action="../../controllers/actualizarController.php" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="half-width">
                    <label for="nameEnter">Empresa</label>
                    <input type="text" id="nameEnter" name="nameEnter" placeholder="Nombre de la empresa" value="<?php echo htmlspecialchars($empresa['nombre']); ?>" required>
                </div>
                <div class="half-width">
                    <label for="address">Dirección</label>
                    <input type="text" id="address" name="address" placeholder="Dirección" value="<?php echo htmlspecialchars($empresa['direccion']); ?>" required>
                </div>
                <div class="half-width">
                    <label for="city">Ciudad</label>
                    <input type="text" id="city" name="city" placeholder="Ciudad" value="<?php echo htmlspecialchars($empresa['ciudad']); ?>" required>
                </div>
                <div>
                    <label for="nit">NIT</label>
                    <input type="text" id="nit" name="nit" placeholder="NIT" value="<?php echo htmlspecialchars($empresa['nit']); ?>" readonly required>
                </div>
                <div class="button">
                    <button type="submit"><span>Actualizar</span></button>
                </div>
            </div>
        </form>
    </section>
</div>
</body>
</html>