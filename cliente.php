<?php
class client{
    private $client;

    public function __construct() {
        $this->client = new SoapClient(null, [
            'location' => 'http://localhost/phpCoches3/servidor.php',
            'uri' => 'http://localhost/phpCoches3/servidor.php',
            'trace' => 1
        ]);
    }
    
    public function authenticate($username, $password) {
        try {
            $result = $this->client->__soapCall('authenticate', [
                'header_params' => (object)['username' => $username, 'password' => $password]
            ]);
    
            if($result === true) {
                return true;
            } else {
                throw new Exception('Autenticación fallida: las credenciales proporcionadas son incorrectas');
            }
        } catch (SoapFault $e) {
            throw new Exception('Error de SOAP: ' . $e->getMessage());
        } 
    }
    

    public function obtenerModelos(){
        try {
            
            if($this->authenticate('ies', 'daw')) {
                $result = $this->client->__soapCall('obtenerModelos', []);
                if(is_array($result) || is_object($result)) {
                    return $result;
                } else {
                    throw new Exception('La llamada SOAP no devolvió un array ni un objeto');
                }
            } else {
                throw new Exception('Autenticación fallida');
            }
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
    

    public function ObtenerMarcasUrl() {
        return $this->client->__soapCall('ObtenerMarcasUrl', []);
    }

    public function ObtenerModelosPorMarca($marca) {
        return $this->client->__soapCall('ObtenerModelosPorMarca', [$marca]);
    }
}
?>



