
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register-view.css">
    <title>Register</title>
</head>
<body>
    <section class="register">
        <h2>Registra tu empresa</h2>

        <form action="../../controllers/registerController.php" method="post" enctype="multipart/form-data">

        <div class="content">

            <div class="dataName">

                <label for="name1">Primer nombre</label>
                <input type="text" id="name1" name="name1" placeholder="Nombre" minlength="4" maxlength="15" required>

                <label for="name2">Segundo nombre</label>
                <input type="text" id="name2" name="name2" placeholder="Nombre" minlength="4" maxlength="15">

                <label for="last1">Primer apellido</label>
                <input type="text" id="last1" name="last1" placeholder="Apellido"  minlength="4" maxlength="15" required>

                <label for="last2">Segundo apellido</label>
                <input type="text" id="last2" name="last2" placeholder="Apellido" minlength="4" maxlength="15">

            </div>

            <div class="dataAcount">

            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" placeholder="Correo electrónico" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>

            <label for="cc">Tipo de documento</label>
            <input type="text" id="cc" name="cc" placeholder="Cédula" minlength="5" maxlength="18" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
          

            <label for="username">Usuario</label>
            <input type="text" id="username" name="username" placeholder="Nombre de usuario" minlength="4" maxlength="15" required>

            <label for="password">Contraseña</label>
            <!--             <input type="password" id="password" name="password" placeholder="Contraseña"  minlength="8" maxlength="20" pattern="(?=.*[A-Z])" required>--> 
       <input type="password" id="password" name="password" placeholder="Contraseña"  minlength="8" maxlength="20" required>

        </div>

            <div class="dataEnterprise">
            <label for="nameEnter">Empresa</label>
            <input type="text" id="nameEnter" name="nameEnter" placeholder="Nombre de la empresa"  minlength="4" maxlength="50" required>

            <label for="address">Dirección</label>
            <input type="text" id="address" name="address" placeholder="Dirección" minlength="4" maxlength="50" required>

            <label for="city">Ciudad</label>
            <input type="text" id="city" name="city" placeholder="Ciudad" minlength="4" maxlength="50" required>

            <div class="uploadDocuments">
                <input type="file" required>
            </div>

            <label for="nit">NIT</label>
            <input type="text" id="nit" name="nit" placeholder="NIT"  minlength="5" maxlength="12" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>


            </div>

            <div class="checkbox">

                <input type="checkbox"><span>He leído y acepto los terminos del servicio</span>

            </div>

            <div class="button">

           <!--  <input type="button" value="Next"> -->
             <button type="submit"><span>Next</span></button>

            </div>

        </div>
        </form>
    </section>

</body>
</html>