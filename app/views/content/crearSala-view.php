<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Sala - Jukebox Pro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: white;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: #1a1a1a;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo-icon {
            width: 24px;
            height: 24px;
            background-color: white;
            margin-right: 0.5rem;
        }
        .nav-buttons button {
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            margin-left: 1rem;
        }
        .nav-buttons button:hover {
            color: white;
        }
        main {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        p {
            color: #999;
            margin-bottom: 1.5rem;
        }
        .room-image {
            width: 100%;
            height: 200px;
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
        input {
            padding: 0.5rem;
            margin-bottom: 1rem;
            background-color: #2a2a2a;
            border: none;
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
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <div class="logo-icon" aria-hidden="true"></div>
            <h1>Jukebox Pro</h1>
        </div>
        <nav class="nav-buttons">
            <button aria-label="Panel de control">Panel de control</button>
            <button aria-label="Ayuda">?</button>
            <button aria-label="Perfil de usuario">👤</button>
        </nav>
    </header>
    <main>
        <h2>Crear una sala</h2>
        <p>Tu sala se creará como borrador y podrá publicarse en cualquier momento.</p>
        <img src="https://placeholder.com/600x300" alt="Representación visual de una sala de música con luces de neón rosa" class="room-image">
        <form id="crear-sala-form">
            <label for="nombre-sala">Nombre de la sala</label>
            <input type="text" id="nombre-sala" name="nombre-sala" placeholder="Ingresa un nombre para la sala" required>
            <button type="submit">Crear</button>
        </form>
    </main>
    <script>
        document.getElementById('crear-sala-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const nombreSala = document.getElementById('nombre-sala').value;
            console.log('Creando sala:', nombreSala);
            // Aquí iría la lógica para crear la sala
            // En una implementación real, aquí se haría una llamada a la API para crear la sala
            alert('Sala creada: ' + nombreSala);
        });
    </script>
</body>
</html>