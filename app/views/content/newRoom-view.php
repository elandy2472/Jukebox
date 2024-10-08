<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("./app/views/inc/head.php"); ?>
</head>

<body id="body_newRoom">
    <main id="main_newRoom">
        <h1>
            Crea una nueva sala
        </h1>

        <div id="img_newRoom"></div>
        
        <form action="#" method="POST" id="form_newRoom">
            <label for="input_newRoom" id="label_newRoom">
                Nombre de la sala
                <input type="text" id="input_newRoom" placeholder="Nombre Sala">
            </label>
            <input type="submit" value="Crear Sala" id="input_submit_newRoom">
        </form>


        <a id="a_newRoom" href="dashboardAdmin">Atrás</a>
    </main>
</body>

</html>