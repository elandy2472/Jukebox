<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jukebox";

try {
 
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        
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

   
        $sql_empresa = "INSERT INTO empresa (nit, nombre, direccion, ciudad) VALUES (:nit, :nameEnter, :address, :city)";
        $stmt_empresa = $conn->prepare($sql_empresa);
        $stmt_empresa->bindParam(':nit', $nit);
        $stmt_empresa->bindParam(':nameEnter', $nameEnter);
        $stmt_empresa->bindParam(':address', $address);
        $stmt_empresa->bindParam(':city', $city);
        $stmt_empresa->execute();

       
        $sql_usuarioempresa = "INSERT INTO usuarioempresa (documento, nombres, apellidos, correo, usuario, contrasena, nit) 
                               VALUES (:cc, :nombres, :apellidos, :email, :username, :password, :nit)";
        $stmt_usuarioempresa = $conn->prepare($sql_usuarioempresa);
        $stmt_usuarioempresa->bindParam(':cc', $cc);
        $stmt_usuarioempresa->bindParam(':nombres', $name1_full);
        $stmt_usuarioempresa->bindParam(':apellidos', $last1_full);
        $stmt_usuarioempresa->bindParam(':email', $email);
        $stmt_usuarioempresa->bindParam(':username', $username);
        $stmt_usuarioempresa->bindParam(':password', $password);
        $stmt_usuarioempresa->bindParam(':nit', $nit);

        $name1_full = $name1 . ' ' . $name2;
        $last1_full = $last1 . ' ' . $last2;

        $stmt_usuarioempresa->execute();

        echo "Registro exitoso, Redireccionar a vista home";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$conn = null;

?>
