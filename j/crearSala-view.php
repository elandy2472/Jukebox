<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar a Sala - Jukebox Pro</title>
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
        #mensaje {
            margin-top: 1rem;
            padding: 0.5rem;
            border-radius: 4px;
        }
        .exito {
            background-color: #4caf50;
        }
        .error {
            background-color: #f44336;
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
        <h2 id="titulo-sala">Ingresar a una sala</h2>
        <p>Ingresa el código de la sala para vincularte o desvincularte.</p>
        <img src="https://i.gifer.com/origin/73/7370303fc26b3f29c54fdd6c7391e25a_w200.webp" alt="Representación visual de una sala de música con luces de neón rosa" class="room-image">
        <form id="sala-form">
            <div id="campos-ingreso">
                <label for="codigo-sala">Código de la sala</label>
                <input type="text" id="codigo-sala" name="codigo-sala" placeholder="Ingresa el código de la sala" required maxlength="10">
                <label for="nickname">Nickname</label>
                <input type="text" id="nickname" name="nickname" placeholder="Ingresa tu nickname" required maxlength="30">
            </div>
            <button type="submit" id="boton-accion">Ingresar a la sala</button>
        </form>
        <div id="mensaje"></div>
    </main>
    <script>
        let salaActual = null;
        const form = document.getElementById('sala-form');
        const camposIngreso = document.getElementById('campos-ingreso');
        const botonAccion = document.getElementById('boton-accion');
        const tituloSala = document.getElementById('titulo-sala');
        const mensaje = document.getElementById('mensaje');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (salaActual) {
                salirDeSala();
            } else {
                ingresarASala();
            }
        });

        function ingresarASala() {
            const codigoSala = document.getElementById('codigo-sala').value;
            const nickname = document.getElementById('nickname').value;

            if (codigoSala.length > 10) {
                mostrarMensaje('El código de la sala no puede superar los 10 caracteres.', 'error');
                return;
            }

            if (nickname.length > 30) {
                mostrarMensaje('El nickname no puede superar los 30 caracteres.', 'error');
                return;
            }

            // Aquí iría la lógica para verificar el código y el nickname con el servidor
            // Por ahora, simularemos una verificación exitosa
            console.log('Ingresando a la sala:', codigoSala, 'con nickname:', nickname);
            salaActual = codigoSala;
            actualizarInterfaz();
            mostrarMensaje(`Te has vinculado a la sala ${codigoSala}`, 'exito');
        }

        function salirDeSala() {
            console.log('Saliendo de la sala:', salaActual);
            mostrarMensaje(`Has salido de la sala ${salaActual}`, 'exito');
            salaActual = null;
            actualizarInterfaz();
        }

        function actualizarInterfaz() {
            if (salaActual) {
                tituloSala.textContent = `Sala actual: ${salaActual}`;
                camposIngreso.style.display = 'none';
                botonAccion.textContent = 'Salir de la sala';
            } else {
                tituloSala.textContent = 'Ingresar a una sala';
                camposIngreso.style.display = 'block';
                botonAccion.textContent = 'Ingresar a la sala';
                form.reset();
            }
        }

        function mostrarMensaje(texto, tipo) {
            mensaje.textContent = texto;
            mensaje.className = tipo;
        }
    </script>
</body>
</html>