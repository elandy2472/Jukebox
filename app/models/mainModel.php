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
            return false;
        } else {
            return true; 
        }
    }

    public function guardarDatos($tabla, $datos) {
        $campos = implode(', ', array_column($datos, 'campo_nombre'));
        $marcadores = implode(', ', array_column($datos, 'campo_marcador'));

        $sql = "INSERT INTO $tabla ($campos) VALUES ($marcadores)";
        $query = $this->db->prepare($sql);

        foreach ($datos as $dato) {
            $query->bindValue($dato['campo_marcador'], $dato['campo_valor']);
        }

        $query->execute();
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
   

