<?php

namespace Vantage\Simulacion\MX\Client;

use \Vantage\Simulacion\MX\Client\Configuration;
use \Vantage\Simulacion\MX\Client\ApiException;
use \Vantage\Simulacion\MX\Client\Model\AportantesPeticion;
use \Vantage\Simulacion\MX\Client\Model\NoAportantesPeticion;
use \Vantage\Simulacion\MX\Client\Api\VantAgeApi;
use \Vantage\Simulacion\MX\Client\Model\CatalogoContrato;
use \Vantage\Simulacion\MX\Client\Model\CatalogoFrecuenciaPago;
use \Vantage\Simulacion\MX\Client\Model\PersonaPeticion;

class VantAgeApiTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $config = new Configuration();
        $config->setHost('the_url');
        $this->x_api_key = "your_x_api_key";
        $client = new \GuzzleHttp\Client();
        $this->apiInstance = new VantAgeApi($client,$config);
    }  

    public function testGetVantageAportantes(){
        try {
            $request = new AportantesPeticion();
            $request->setFolio("123456");
            $request->setFechaProceso("dd/MM/yyyy");
            $request->setNumeroCuenta("00000000");
            $request->setDiasAtraso(10);
            $result = $this->apiInstance->getVantageAportantes($this->x_api_key, $request);
            print_r($result);
        } catch (ApiException | Exception $e) {
            echo 'Exception when calling TelcosSimulacionApi->getReporte: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function testGetVantageNoAportantes(){
        try {
            $tipoContrato = new CatalogoContrato();
            $catalogoPago = new CatalogoFrecuenciaPago();
            $persona = new PersonaPeticion();
            $request = new NoAportantesPeticion();

            $persona->setPrimerNombre("NOMBRE");
            $persona->setApellidoPaterno("PATERNO");
            $persona->setApellidoMaterno("MATERNO");
            $persona->setFechaNacimiento("1986-06-27");
            $request->setFolio("123456");
            $request->setFechaProceso("dd/MM/yyyy");
            $request->setTipoContrato($tipoContrato::AA);
            $request->setFrecuenciaPago($catalogoPago::N);
            $request->setDiasAtraso(10);
            $request->setPersona($persona);

            $result = $this->apiInstance->getVantageAportantes($this->x_api_key, $request);
            print_r($result);
        } catch (ApiException | Exception $e) {
            echo 'Exception when calling TelcosSimulacionApi->getReporte: ', $e->getMessage(), PHP_EOL;
        }
    }
        
}
