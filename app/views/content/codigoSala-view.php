<?php
session_start();

if (!isset($_SESSION['room_code']) || !isset($_SESSION['room_name'])) {
    header("Location: crearSala-view.php");
    exit;
}

$roomCode = $_SESSION['room_code'];
$roomName = $_SESSION['room_name'];

function shareCode() {
    // Implement share functionality here
    return "Sharing functionality to be implemented.";
}

if (isset($_POST['share'])) {
    $shareMessage = shareCode();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Code - Jukebox Pro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            color: white;
            margin: 0;
            padding: 0;
        }
        .container {
            min-height: 100vh;
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
            text-align: center;
        }
        h1, h2 {
            margin-bottom: 0.5rem;
        }
        p {
            color: #999;
            margin-bottom: 1.5rem;
        }
        .room-code {
            background-color: #1e1e1e;
            padding: 1rem;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .room-code span {
            font-size: 2rem;
            font-weight: bold;
        }
        .copy-icon {
            cursor: pointer;
            font-size: 1.5rem;
        }
        .button {
            padding: 0.5rem 1rem;
            background-color: #1a73e8;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            margin-bottom: 1rem;
        }
        .button:hover {
            background-color: #1557b0;
        }
        .done-button {
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 1rem;
            margin-bottom: 1rem;
        }
        .done-button:hover {
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <span style="font-size: 24px;">☰</span>
                <h1 style="margin-left: 10px;">Jukebox Pro</h1>
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
            <button class="done-button" onclick="window.location.href='sala/<?php echo $roomCode; ?>'">ir a sala</button>
            <h2>Codigo De Sala </h2>
            <p>Comparte El Codigo De Sala con tus amigos</p>
            <div class="room-code">
                <span>#</span>
                <span><?php echo htmlspecialchars($roomCode); ?></span>
                <span class="copy-icon" onclick="copyCode()" title="Copy code">📋</span>
            </div>
            <form method="POST">
                <button type="submit" name="share" class="button">Compartir Codigo</button>
            </form>
            <p>Tus amigos también pueden unirse buscándolos en la aplicación.</p>
            <?php if (isset($shareMessage)): ?>
                <p><?php echo htmlspecialchars($shareMessage); ?></p>
            <?php endif; ?>
        </main>
    </div>
    <script>
        function copyCode() {
            var code = "<?php echo $roomCode; ?>";
            navigator.clipboard.writeText(code).then(function() {
                alert("Código de sala copiado al portapapeles!");
            }, function(err) {
                console.error('No se pudo copiar el texto: ', err);
            });
        }
    </script>
</body>
</html>