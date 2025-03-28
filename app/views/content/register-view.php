<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href=".\app\views\css\register-view.css">
<?php require_once("./app/views/inc/head.php"); ?>
</head>

<body>
<?php require_once("./app/views/inc/navbar.php") ?>
    <section class="register">

        <h2>Registra tu empresa</h2>
        <form action="./app/controllers/registerController.php" method="post" enctype="multipart/form-data">

            <div class="content">

                <div class="half-width">
                    <label for="name1">Primer nombre</label>
                    <input type="text" id="name1" name="name1" placeholder="Nombre" title="Debe tener entre 4 y 15 caracteres, sin espacio, numeros ni C. especiales" pattern="[a-zA-Z]+"  minlength="4" maxlength="15" required>
                </div>
                <div class="half-width">
                    <label for="name2">Segundo nombre</label>
                    <input type="text" id="name2" name="name2" placeholder="Nombre" title="Debe tener entre 4 y 15 caracteres, sin espacio, numeros ni C. especiales" pattern="[a-zA-Z]+" minlength="4" maxlength="15">
                </div>

                <div class="half-width">
                    <label for="last1">Primer apellido</label>
                    <input type="text" id="last1" name="last1" placeholder="Apellido" title="Debe tener entre 4 y 15 caracteres, sin espacio, numeros ni C. especiales" pattern="[a-zA-Z]+" minlength="4" maxlength="15" required>
                </div>
                <div class="half-width">
                    <label for="last2">Segundo apellido</label>
                    <input type="text" id="last2" name="last2" placeholder="Apellido" title="Debe tener entre 4 y 15 caracteres, sin espacio, numeros ni C. especiales" pattern="[a-zA-Z]+" minlength="4" maxlength="15">
                </div>

                <div>
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" placeholder="Correo electrónico"title="Debe un @ y extencion de dominio" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                </div>

                <div>
                    <label for="cc">Tipo de documento</label>
                    <input type="text" id="cc" name="cc" placeholder="Cédula" minlength="7" maxlength="11" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                </div>

                <div>
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" placeholder="Nombre de usuario" minlength="4" maxlength="15" required>
                </div>

                <div>
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Contraseña" minlength="8" maxlength="20" 
                    pattern="(?=.*[A-Z])[A-Za-z\d]{8,20}" title="Debe tener entre 8 y 20 caracteres, y al menos una letra mayúscula" required>
                </div>

                <div>
                    <label for="nameEnter">Empresa</label>
                    <input type="text" id="nameEnter" name="nameEnter" placeholder="Nombre de la empresa" pattern="[a-zA-Z]+" minlength="4" maxlength="50" required>
                </div>

                <div class="half-width">
                    <label for="address">Dirección</label>
                    <input type="text" id="address" name="address" placeholder="Dirección" minlength="4" maxlength="50" required>
                </div>
                <div class="half-width">
                    <label for="city">Ciudad</label>
                    <input type="text" id="city" name="city" placeholder="Ciudad" minlength="4" maxlength="50" required>
                </div>

                <div class="uploadDocuments">
                    <label for="legalDocument">Sube tu documento legal</label>
                    <input type="file" id="legalDocument" name="legalDocument" accept="image/*,application/pdf" onchange="showFileName()" required>
                    <span class="file-name" id="file-name">No se ha seleccionado ningún archivo IMG o PDF</span>
                </div>

                <div>
                    <label for="nit">NIT</label>
                    <input type="text" id="nit" name="nit" placeholder="NIT" minlength="5" maxlength="12" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                </div>

                <div class="checkbox">
                    <input type="checkbox" required><span>He leído y acepto los términos del servicio</span>
                </div>

                <div class="button">
                    <button type="submit"><span>Next</span></button>
                </div>

            </div>
        </form>
    </section>

    <script>
        function showFileName() {
            const input = document.getElementById('legalDocument');
            const fileName = document.getElementById('file-name');
            fileName.textContent = input.files.length > 0 ? input.files[0].name : 'No se ha seleccionado ningún archivo';
        }
    </script>
<script>
    document.querySelector("form").addEventListener("submit", function (event) {
        event.preventDefault(); // Evitar el envío estándar del formulario

        const formData = new FormData(this);

        fetch('./app/controllers/registerController.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                // Mostrar el mensaje de error en el formulario
                alert(data.message);
            } else if (data.status === 'success') {
                // Mostrar notificación de éxito
                alert(data.message);
                window.location.href = '../../jukebox/login';
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>




</body>

</html>