<?php
session_start();
require_once '../../models/mainModel.php'; // Asegúrate de incluir el modelo

function generateRoomCode() {
    return strtoupper(substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789', 6)), 0, 6));
}

function isRoomCodeUnique($modelo, $roomCode) {
    // Implementa la lógica para verificar si el código de sala existe
    $query = "SELECT COUNT(*) FROM sala WHERE codigoSala = :codigoSala";
    $stmt = $modelo->db->prepare($query);
    $stmt->bindParam(':codigoSala', $roomCode);
    $stmt->execute();
    return $stmt->fetchColumn() == 0; // Retorna true si el código es único
}

$roomName = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roomName = trim($_POST['room_name']);
    
    if (!empty($roomName)) {
        // Conectar a la base de datos y crear un objeto de mainModel
        $modelo = new \app\models\mainModel();
        
        // Aforo final predeterminado
        $aforoFinalSala = 30;
        
        // Obtener el documento del usuario que está iniciando sesión
        $documento = $_SESSION['usuario']['documento']; // Asegúrate de que esto está establecido en la sesión
        print($documento);

        do {
            $roomCode = generateRoomCode();
        } while (!isRoomCodeUnique($modelo, $roomCode)); // Generar un nuevo código si ya existe
        
        // Preparar los datos para guardar
        $datos = [
            [
                'campo_nombre' => 'nombreSala',
                'campo_marcador' => ':nombreSala',
                'campo_valor' => $roomName
            ],
            [
                'campo_nombre' => 'codigoSala',
                'campo_marcador' => ':codigoSala',
                'campo_valor' => $roomCode
            ],
            [
                'campo_nombre' => 'aforoFinalSala',
                'campo_marcador' => ':aforoFinalSala',
                'campo_valor' => $aforoFinalSala
            ],
            [
                'campo_nombre' => 'documento',
                'campo_marcador' => ':documento',
                'campo_valor' => $documento
            ]
        ];

        // Guardar los datos en la base de datos
        try {
            $modelo->guardarDatos('sala', $datos);
            $_SESSION['room_code'] = $roomCode;
            $_SESSION['room_name'] = $roomName;
            // header("Location: codigosala"); // Redireccionar después de crear la sala
            exit;
        } catch (Exception $e) {
            $error = "Error al crear la sala: " . $e->getMessage();
        }
    } else {
        $error = "Por favor introduce el nombre de una sala.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crear sala - Jukebox Pro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            color: white;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            flex-direction: column;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #333;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        nav {
            display: flex;
            align-items: center;
        }
        nav button {
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            margin-left: 1rem;
            padding: 0.5rem;
        }
        nav button:hover {
            color: white;
        }
        main {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem 1rem;
            flex-grow: 1;
        }
        h1, h2 {
            margin-bottom: 0.5rem;
        }
        p {
            color: #999;
            margin-bottom: 1.5rem;
        }
        img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 0.5rem;
        }
        input[type="text"] {
            padding: 0.5rem;
            margin-bottom: 1rem;
            background-color: #333;
            border: 1px solid #444;
            border-radius: 4px;
            color: white;
        }
        button[type="submit"] {
            padding: 0.5rem;
            background-color: #1a73e8;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #1557b0;
        }
        .error {
            color: #ff4444;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
            </div>
            <nav>
                <button>Today</button>
                <button>Explore</button>
                <button>Create</button>
                <button>Activity</button>
                <button>?</button>
                <button>👤</button>
            </nav>
        </header>
        <main>
            <h2>Crear Sala</h2>
            <p>Su sala se creará  podrá publicarse en cualquier momento.</p>
            <img src="https://i.gifer.com/origin/73/7370303fc26b3f29c54fdd6c7391e25a_w200.webp" alt="Neon-lit room representing a music venue">
            <?php if ($error): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form method="POST">
                <label for="room-name">nombre de sala</label>
                <input type="text" id="room-name" name="room_name" placeholder="Enter a room name" required value="<?php echo htmlspecialchars($roomName); ?>">
                <button type="submit">Crear</button>
            </form>
        </main>
    </div>
</body>
</html>
