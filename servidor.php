<?php

class server{
    private $con;
    private $IsAuthenticated;

    public function __construct() {
        $this->con = (is_null($this->con)) ? self::connect() : $this->con;
        $this->IsAuthenticated = false;
    }

    static function connect() {
        try {
            $user = "root";
            $pass = "";
            $dbname = "coches";
            $host = "127.0.0.1";

            $con = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            print "<p>Error: " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    function obtenerModelos() {
        try {
            $sql = "SELECT m.marca, mo.modelo FROM marcas m
                    INNER JOIN modelos mo ON m.id = mo.marca
                    ORDER BY m.id, mo.id";
        
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($result === false) {
                throw new Exception('Error al ejecutar la consulta SQL');
            }
        
            $modelos = [];
            foreach ($result as $row) {
                $modelos[$row["marca"]][] = $row["modelo"];
            }
        
            return $modelos;
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
    

    public function authenticate($header_params) {
        if ($header_params->username === 'ies' && $header_params->password == 'daw') {
        $this->IsAuthenticated = true;
            return true;
        } else {
            throw new SoapFault('Wrong user/pass combination', 401);
        }
    }

    public function ObtenerMarcasUrl() {
        $sql = "SELECT marca, url FROM marcas";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $marcasUrls = [];

        foreach ($result as $row) {
            $marcasUrls[$row["marca"]] = $row["url"];
        }

        return $marcasUrls;
    }

    public function ObtenerModelosPorMarca($marca) {
        $sql = "SELECT modelo FROM modelos WHERE marca = :marca";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $modelos = [];

        foreach ($result as $row) {
            $modelos[] = $row["modelo"];
        }

        return $modelos;
    }
}

$params = array('uri' => 'http://localhost/phpCoches3/servidor.php');
$server = new SoapServer(null, $params);
$server->setClass('server');
$server->handle();
?>
