<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Tu usuario de MySQL
$password = ""; // Tu contraseña de MySQL
$dbname = "jukebox"; // Nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $name1 = $_POST['name1'];
    $name2 = $_POST['name2'];
    $last1 = $_POST['last1'];
    $last2 = $_POST['last2'];
    $email = $_POST['email'];
    $cc = $_POST['cc'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nameEnter = $_POST['nameEnter'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $nit = $_POST['nit'];

    // Insertar datos en la tabla `empresa`
    $sql_empresa = "INSERT INTO empresa (nit, nombre, direccion, ciudad) VALUES ('$nit', '$nameEnter', '$address', '$city')";

    // Insertar datos en la tabla `usuarioempresa`
    $sql_usuarioempresa = "INSERT INTO usuarioempresa (documento, nombres, apellidos, correo, usuario, contrasena, nit) VALUES ('$cc', '$name1 $name2', '$last1 $last2', '$email', '$username', '$password', '$nit')";

    if ($conn->query($sql_empresa) === TRUE && $conn->query($sql_usuarioempresa) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql_empresa . "<br>" . $conn->error;
        echo "Error: " . $sql_usuarioempresa . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
?>