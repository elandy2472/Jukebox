<?php

$tiempo_maximo_inactividad = 600; 
$tiempo_notificacion = 540; 

if (isset($_SESSION['usuario'])) {
    if (isset($_SESSION['ultimo_acceso'])) {
        $tiempo_inactividad = time() - $_SESSION['ultimo_acceso'];

        if ($tiempo_inactividad > $tiempo_notificacion && $tiempo_inactividad < $tiempo_maximo_inactividad) {
            $tiempo_restante = $tiempo_maximo_inactividad - $tiempo_inactividad;
            echo "<script>
                    alert('Tu sesión expirará en $tiempo_restante segundos. Por favor, interactúa para mantener la sesión.');
                  </script>";
        }

        if ($tiempo_inactividad >= $tiempo_maximo_inactividad) {
            $log = fopen("log_sesiones.txt", "a");
            fwrite($log, "Sesión destruida para el usuario {$_SESSION['usuario']} por inactividad el " . date("Y-m-d H:i:s") . "\n");
            fclose($log);

            session_unset();
            session_destroy();
            header("Location: login");
            exit();
        }
    }

    $_SESSION['ultimo_acceso'] = time();
} else {
    header("Location: login");
    exit();
}
?>
