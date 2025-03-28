<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jukebox";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $nameEnter = isset($_POST['nameEnter']) ? $conn->real_escape_string($_POST['nameEnter']) : '';
    $address = isset($_POST['address']) ? $conn->real_escape_string($_POST['address']) : '';
    $city = isset($_POST['city']) ? $conn->real_escape_string($_POST['city']) : '';
    $nit = isset($_POST['nit']) ? $conn->real_escape_string($_POST['nit']) : '';

    // Verificar que las variables no estén vacías
    if (!empty($nameEnter) && !empty($address) && !empty($city) && !empty($nit)) {
        // Actualizar en la tabla empresa
        $sql = "UPDATE empresa SET nombre='$nameEnter', direccion='$address', ciudad='$city' WHERE nit='$nit'";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../views/content/success.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Todos los campos son requeridos.";
    }

    $conn->close();
}
?>
