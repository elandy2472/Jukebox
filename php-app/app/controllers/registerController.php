<?php

$servername = "mysql";
$username = "user";
$password = "password";
$dbname = "jukebox";

try {
    // Conexión a la base de datos
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Capturar datos del formulario
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

        // Validar duplicados en usuarioempresa
        $check_sql = "SELECT documento, correo, usuario FROM usuarioempresa WHERE documento = :cc OR correo = :email OR usuario = :username";
        $stmt_check = $conn->prepare($check_sql);
        $stmt_check->bindParam(':cc', $cc);
        $stmt_check->bindParam(':email', $email);
        $stmt_check->bindParam(':username', $username);
        $stmt_check->execute();
        $row = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $response = [
                'status' => 'error',
                'field' => $row['documento'] == $cc ? 'cc' : ($row['correo'] == $email ? 'email' : 'username'),
                'message' => $row['documento'] == $cc
                    ? 'El documento ya está registrado.'
                    : ($row['correo'] == $email ? 'El correo ya está registrado.' : 'El nombre de usuario ya está registrado.')
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

        // Manejo de archivos adjuntos
        $fileDataEncoded = null;
        if (isset($_FILES['legalDocument']) && $_FILES['legalDocument']['error'] == 0) {
            $fileData = file_get_contents($_FILES['legalDocument']['tmp_name']);
            $fileDataEncoded = base64_encode($fileData);
        }

        // Encriptar contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Nombres completos
        $name1_full = $name1 . ' ' . $name2;
        $last1_full = $last1 . ' ' . $last2;

        // Transacción para insertar en ambas tablas
        $conn->beginTransaction();

        try {
            // Insertar en la tabla empresa
            $sql_empresa = "INSERT INTO empresa (nit, nombre, direccion, ciudad) VALUES (:nit, :nameEnter, :address, :city)";
            $stmt_empresa = $conn->prepare($sql_empresa);
            $stmt_empresa->bindParam(':nit', $nit);
            $stmt_empresa->bindParam(':nameEnter', $nameEnter);
            $stmt_empresa->bindParam(':address', $address);
            $stmt_empresa->bindParam(':city', $city);
            $stmt_empresa->execute();

            // Insertar en la tabla usuarioempresa
            $sql_usuarioempresa = "INSERT INTO usuarioempresa 
                (documento, nombres, apellidos, correo, usuario, contrasena, nit, imgDocumentoLegal) 
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
            $stmt_usuarioempresa->execute();

            // Confirmar transacción
            $conn->commit();

            // Respuesta de éxito
            $response = [
                'status' => 'success',
                'message' => 'Registro exitoso.'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        } catch (PDOException $e) {
            // Revertir transacción en caso de error
            $conn->rollBack();
            throw $e;
        }
    }
} catch (PDOException $e) {
    // Manejar errores generales
    error_log("Error de PDO: " . $e->getMessage());
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => 'Error en el servidor: ' . $e->getMessage()
    ]);
    exit();
}

$conn = null;
