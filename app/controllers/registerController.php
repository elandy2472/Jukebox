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

        // Comprobamos si el documento o el correo o el usuario ya están registrados
        $check_sql = "SELECT documento, correo, usuario FROM usuarioempresa WHERE documento = :cc OR correo = :email OR usuario = :username";
        $stmt_check = $conn->prepare($check_sql);
        $stmt_check->bindParam(':cc', $cc);
        $stmt_check->bindParam(':email', $email);
        $stmt_check->bindParam(':username', $username);
        $stmt_check->execute();
        $row = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            if ($row['documento'] == $cc) {
                $response = [
                    'status' => 'error',
                    'field' => 'cc',
                    'message' => 'El documento ya está registrado.'
                ];
            } elseif ($row['correo'] == $email) {
                $response = [
                    'status' => 'error',
                    'field' => 'email',
                    'message' => 'El correo ya está registrado.'
                ];
            } elseif ($row['usuario'] == $username) {
                $response = [
                    'status' => 'error',
                    'field' => 'username',
                    'message' => 'El nombre de usuario ya está registrado.'
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

        // Manejo del archivo adjunto
        if (isset($_FILES['legalDocument']) && $_FILES['legalDocument']['error'] == 0) {
            // Leer el archivo como binario
            $fileData = file_get_contents($_FILES['legalDocument']['tmp_name']);
            // Encriptar el archivo usando base64
            $fileDataEncoded = base64_encode($fileData);
        } else {
            $fileDataEncoded = null;
        }

        // Encriptamos la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertamos la empresa
        $sql_empresa = "INSERT INTO empresa (nit, nombre, direccion, ciudad) VALUES (:nit, :nameEnter, :address, :city)";
        $stmt_empresa = $conn->prepare($sql_empresa);
        $stmt_empresa->bindParam(':nit', $nit);
        $stmt_empresa->bindParam(':nameEnter', $nameEnter);
        $stmt_empresa->bindParam(':address', $address);
        $stmt_empresa->bindParam(':city', $city);
        $stmt_empresa->execute();

        // Insertamos el usuario
        $sql_usuarioempresa = "INSERT INTO usuarioempresa (documento, nombres, apellidos, correo, usuario, contrasena, nit, imgDocumentoLegal) 
                               VALUES (:cc, :nombres, :apellidos, :email, :username, :password, :nit, :imgDocumentoLegal)";
        $stmt_usuarioempresa = $conn->prepare($sql_usuarioempresa);
        $stmt_usuarioempresa->bindParam(':cc', $cc);
        $stmt_usuarioempresa->bindParam(':nombres', $name1_full);
        $stmt_usuarioempresa->bindParam(':apellidos', $last1_full);
        $stmt_usuarioempresa->bindParam(':email', $email);
        $stmt_usuarioempresa->bindParam(':username', $username);
        $stmt_usuarioempresa->bindParam(':password', $hashed_password);
        $stmt_usuarioempresa->bindParam(':nit', $nit);
        $stmt_usuarioempresa->bindParam(':imgDocumentoLegal', $fileDataEncoded, PDO::PARAM_LOB);

        $name1_full = $name1 . ' ' . $name2;
        $last1_full = $last1 . ' ' . $last2;

        $stmt_usuarioempresa->execute();

        $response = [
            'status' => 'success',
            'message' => 'Registro exitoso.'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
