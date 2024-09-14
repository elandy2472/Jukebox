<?php
session_start();

function generateRoomCode() {
    return strtoupper(substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789', 6)), 0, 6));
}

$roomName = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roomName = trim($_POST['room_name']);
    if (!empty($roomName)) {
        $roomCode = generateRoomCode();
        $_SESSION['room_code'] = $roomCode;
        $_SESSION['room_name'] = $roomName;
        header("Location: codigosala");
        exit;
    } else {
        $error = "Please enter a room name.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Room - Jukebox Pro</title>
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
            <h2>Create a room</h2>
            <p>Your room will be created as a draft and can be published at any time.</p>
            <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/6%20CREAR%20SALA-mQr7P4YmFeZwpJt4MzbDsnTKPhVNjc.jpg" alt="Neon-lit room representing a music venue">
            <?php if ($error): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <form method="POST">
                <label for="room-name">Room name</label>
                <input type="text" id="room-name" name="room_name" placeholder="Enter a room name" required value="<?php echo htmlspecialchars($roomName); ?>">
                <button type="submit">Create</button>
            </form>
        </main>
    </div>
</body>
</html>
