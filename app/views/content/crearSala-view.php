<?php
session_start();

function generateRoomCode() {
    return strtoupper(substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789', 6)), 0, 6));
}

$roomName = '';
$createdRoom = null;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roomName = trim($_POST['room_name']);
    if (!empty($roomName)) {
        $roomCode = generateRoomCode();
        $createdRoom = [
            'name' => $roomName,
            'code' => $roomCode
        ];
        $_SESSION['created_room'] = $createdRoom;
        $message = "Room \"{$roomName}\" has been created as a draft.";
        $roomName = '';
    }
}

$createdRoom = isset($_SESSION['created_room']) ? $_SESSION['created_room'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jukebox Pro - Create a Room</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            color: white;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
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
        nav button {
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            margin-left: 1rem;
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
        .message {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border-radius: 4px;
            margin-top: 1rem;
        }
        .created-room {
            background-color: #333;
            padding: 1rem;
            border-radius: 4px;
            margin-top: 1rem;
        }
        .created-room a {
            color: #1a73e8;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <span style="font-size: 24px;">☰</span>
            <h1 style="margin-left: 10px;">Jukebox Pro</h1>
        </div>
        <nav>
            <button>Panel de control</button>
            <button>?</button>
            <button>👤</button>
        </nav>
    </header>
    <div class="container">
        <h2>Create a room</h2>
        <p>Your room will be created as a draft and can be published at any time.</p>
        <img src="https://i.gifer.com/origin/73/7370303fc26b3f29c54fdd6c7391e25a_w200.webp" alt="Neon-lit room representing a music venue">
        <form method="POST">
            <label for="room-name">Room name</label>
            <input type="text" id="room-name" name="room_name" placeholder="Enter a room name" required value="<?php echo htmlspecialchars($roomName); ?>">
            <button type="submit">Create</button>
        </form>
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <?php if ($createdRoom): ?>
            <div class="created-room">
                <h3>Room Created: <?php echo htmlspecialchars($createdRoom['name']); ?></h3>
                <p>Room Code: <?php echo htmlspecialchars($createdRoom['code']); ?></p>
                <p>Share Link: <a href="http://localhost/Jukebox/sala/<?php echo urlencode($createdRoom['code']); ?>">http://localhost/Jukebox/sala/<?php echo htmlspecialchars($createdRoom['code']); ?></a></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>