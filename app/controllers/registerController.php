<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "jukebox";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); // Verificar la conexión
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {   // Recoge datos del form de register-view
 
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

    // Insertar en la tabla empresa
    $sql_empresa = "INSERT INTO empresa (nit, nombre, direccion, ciudad) VALUES ('$nit', '$nameEnter', '$address', '$city')";

    // Insertar en la tabla usuarioempresa
    $sql_usuarioempresa = "INSERT INTO usuarioempresa (documento, nombres, apellidos, correo, usuario, contrasena, nit) VALUES ('$cc', '$name1 $name2', '$last1 $last2', '$email', '$username', '$password', '$nit')";

    if ($conn->query($sql_empresa) === TRUE && $conn->query($sql_usuarioempresa) === TRUE) {
        echo "Registro exitoso, Redireccionar a vista home";
    } else {
        echo "Error: " . $sql_empresa . "<br>" . $conn->error;
        echo "Error: " . $sql_usuarioempresa . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
?>