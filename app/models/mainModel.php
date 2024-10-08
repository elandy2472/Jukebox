<?php

namespace app\models;

use PDO;

if (file_exists(__DIR__ . "/../../config/server.php")) {
    require_once(__DIR__ . "/../../config/server.php");
}

class mainModel
{
    private $DB_SERVER = DB_SERVER;
    private $DB_NAME = DB_NAME;
    private $DB_USER = DB_USER;
    private $DB_PASS = DB_PASS;

    private $db;
    public function __construct() {
        $this->db = $this->conectar();
    }




    protected function conectar()
{
    try {
        $conexion = new PDO("mysql:host=" . $this->DB_SERVER . ";dbname=" . $this->DB_NAME, $this->DB_USER, $this->DB_PASS);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        die('Error en la conexión: ' . $e->getMessage());
    }
}

    public function limpiarCadena($cadena)
    {

        $palabras = ["<script>", "</script>", "<script src", "<script type=", "SELECT * FROM", "SELECT ", " SELECT ", "DELETE FROM", "INSERT INTO", "DROP TABLE", "DROP DATABASE", "TRUNCATE TABLE", "SHOW TABLES", "SHOW DATABASES", "<?php", "?>", "--", "^", "<", ">", "==", "=", ";", "::"];

        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);

        foreach ($palabras as $palabra) {
            $cadena = str_ireplace($palabra, "", $cadena);
        }

        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);

        return $cadena;
    }

    public function verificarDatos($filtro, $cadena)
    {
        if (preg_match("/^" . $filtro . "$/", $cadena)) {
            return false; //Devolverá FALSE porque no hay problema 
        } else {
            return true; //Devolverá True porque hay problema
        }
    }

    public function guardarDatos($tabla, $datos,)
    {
        $query = "INSERT INTO $tabla (";

        $C = 0;

        foreach ($datos as $clave) {
            if ($C >= 1) {
                $query .= ",";
            }
            $query .= $clave['campo_nombre']; //Campo_nombre, es el nombre de los campos que hay en la base de datos
            $C++;
        }

        $query .= ") VALUES (";

        $C = 0;
        foreach ($datos as $clave) {
            if ($C >= 1) {
                $query .= ",";
            }
            $query .= $clave['campo_marcador']; //Campo_marcador, es el nombre del marcador
            $C++;
        }

        $query .= ")";

        $sql = $this->conectar()->prepare($query);


        foreach ($datos as $clave) {
            $sql->bindParam($clave["campo_marcador"], $clave["campo_valor"]); //Campo_valor, es el campo del valor en el array
        }

        $sql->execute();

        return $sql;
    }

    public function seleccionDatos($tipo, $tabla, $campo, $id)
    {
        $tipo = $this->limpiarCadena($tipo);
        $tabla = $this->limpiarCadena($tabla);
        $campo = $this->limpiarCadena($campo);
        $id = $this->limpiarCadena($id);

        if ($tipo == "Unico") {
            $sql = $this->conectar()->prepare("SELECT * FROM $tabla WHERE
            $campo = :ID");
            $sql->bindParam(":ID", $id);
        } elseif ($tipo == "Normal") {
            $sql = $this->conectar()->prepare("SELECT $campo FROM $tabla ");
        }
        $sql->execute();
        return $sql;
    }

    protected function actualizarDatos($tabla, $datos, $condicion)
    {

        $query = "UPDATE $tabla SET ";

        $C = 0;
        foreach ($datos as $clave) {
            if ($C >= 1) {
                $query .= ",";
            }
            $query .= $clave["campo_nombre"] . "=" . $clave["campo_marcador"];
            $C++;
        }

        $query .= " WHERE " . $condicion["condicion_campo"] . "=" . $condicion["condicion_marcador"];

        $sql = $this->conectar()->prepare($query);

        foreach ($datos as $clave) {
            $sql->bindParam($clave["campo_marcador"], $clave["campo_valor"]);
        }

        $sql->bindParam($condicion["condicion_marcador"], $condicion["condicion_valor"]);

        $sql->execute();

        return $sql;
    }


    protected function eliminarRegistro($tabla, $campo, $id)
    {
        $sql = $this->conectar()->prepare("DELETE FROM $tabla WHERE $campo=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();

        return $sql;
    }

    protected function paginadorTablas($pagina, $numeroPaginas, $url, $botones)
    {
        /* $pagina = Pagina actual
        $numeroPaginas = Numero de paginas que se van a crear en la parte de abajo del contador de pagina
        $url = Url actual
        $botones = Limitar el numero de botones que aparecen en la parte de abajo "Los numeros"
        */

        $tabla = '<nav class="paginador" role = "navigation">';
        if ($pagina <= 1) {
            $tabla .= '<a class = "boton_deshabilitado" disabled>Anterior</a>
            
            <ul class="ul_navigation">';
        } else {
            $tabla .= '
	            <a class="pagination-previous" href="' . $url . ($pagina - 1) . '/">Anterior</a>
	            <ul class="pagination-list">
	                <li><a class="pagination-link" href="' . $url . '1/">1</a></li>
	                <li><span class="pagination-ellipsis">&hellip;</span></li>
	            ';
        }

        $ci = 0;
        for ($i = $pagina; $i <= $numeroPaginas; $i++) {

            if ($ci >= $botones) {
                break;
            }

            if ($pagina == $i) {
                $tabla .= '<li><a class="pagination-link is-current" href="' . $url . $i . '/">' . $i . '</a></li>';
            } else {
                $tabla .= '<li><a class="pagination-link" href="' . $url . $i . '/">' . $i . '</a></li>';
            }

            $ci++;
        }


        if ($pagina == $numeroPaginas) {
            $tabla .= '
            </ul>
            <a class="pagination-next is-disabled" disabled >Siguiente</a>
            ';
        } else {
            $tabla .= '
                <li><span class="pagination-ellipsis">&hellip;</span></li>
                <li><a class="pagination-link" href="' . $url . $numeroPaginas . '/">' . $numeroPaginas . '</a></li>
            </ul>
            <a class="pagination-next" href="' . $url . ($pagina + 1) . '/">Siguiente</a>
            ';
        }

        $tabla .= '</nav>';
        return $tabla;
    }

    public function obtenerNITPorUsuarioOCorreo($usuarioOcorreo) {
        // Conectar a la base de datos y buscar el NIT basado en el usuario o correo
        $sql = "SELECT nit FROM usuarioempresa WHERE usuario = :usuarioOcorreo OR correo = :usuarioOcorreo";
        
        $query = $this->db->prepare($sql);
        $query->bindParam(":usuarioOcorreo", $usuarioOcorreo, PDO::PARAM_STR);
        $query->execute();

        $resultado = $query->fetch(PDO::FETCH_ASSOC);

        // Retornar el NIT si existe
        if ($resultado) {
            return $resultado['nit'];
        } else {
            return null;
        }
    }



    public function validarCredenciales($usuarioOcorreo, $contrasena)
{
    try {
        $usuarioOcorreo = $this->limpiarCadena($usuarioOcorreo);

        $sql = $this->conectar()->prepare("
            SELECT * 
            FROM usuarioempresa 
            WHERE (usuario = :usuarioOcorreo OR correo = :usuarioOcorreo)
        ");
        $sql->bindParam(':usuarioOcorreo', $usuarioOcorreo);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $resultado = $sql->fetch(PDO::FETCH_ASSOC);

            if ($contrasena === $resultado['contrasena']) {
                return true; 
            } else {
                
                error_log("Contraseña no válida para usuario o correo: $usuarioOcorreo");
                return false; 
            }
        } else {
            
            error_log("Usuario o correo no encontrado: $usuarioOcorreo");
            return false; 
        }
    } catch (PDOException $e) {
        error_log('Error en la validación de credenciales: ' . $e->getMessage());
        return false;
    }
}

}
