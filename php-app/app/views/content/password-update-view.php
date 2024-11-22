<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Contraseña</title>
    <link rel="stylesheet" href="../css/passstyles.css">
</head>
<body>
    <section class="password-update">
        <h2>Cambiar Contraseña</h2>
        <form id="passwordForm" method="post">
            <input type="text" name="documento" placeholder="Documento" required>
            <input type="password" name="currentPassword" placeholder="Contraseña Actual" required>
            <input type="password" name="newPassword" placeholder="Nueva Contraseña" required>
            <input type="password" name="confirmPassword" placeholder="Confirmar Nueva Contraseña" required>
            <button type="submit">Actualizar Contraseña</button>
            <p id="notification" class="notification"></p>
        </form>
    </section>
    <script>
        document.getElementById('passwordForm').addEventListener('submit', async function (event) {
            event.preventDefault();

            const formData = new FormData(this);
            const response = await fetch('../../controllers/PasswordController.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            const notification = document.getElementById('notification');

            if (result.status === 'success') {
                notification.textContent = result.message;
                notification.style.color = 'green';
                setTimeout(() => {
                    window.location.href = 'dashboardAdminGeneral-view.php';
                }, 2000); 
            } else {
                notification.textContent = result.message;
                notification.style.color = 'red';
            }
        });
    </script>
</body>
</html>
