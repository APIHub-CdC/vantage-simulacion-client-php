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
use \Vantage\Simulacion\MX\Client\Model\DomicilioPeticion;
use \Vantage\Simulacion\MX\Client\Model\CatalogoEstados;

class ApiTest extends \PHPUnit_Framework_TestCase
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
            $tipoContrato = new CatalogoContrato();

            $request->setFolio("1500001");
            $request->setTipoContrato($tipoContrato::CA);
            $request->setNumeroCuenta("2000001");
            $request->setDiasAtraso(21);
            $result = $this->apiInstance->getVantageAportantes($this->x_api_key, $request);
            print_r($result);
        } catch (ApiException | Exception $e) {
            echo 'Exception when calling ApiTest->testGetVantageAportantes: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function testGetVantageNoAportantes(){
        try {
            $tipoContrato = new CatalogoContrato();
            $catalogoPago = new CatalogoFrecuenciaPago();
            $persona = new PersonaPeticion();
            $domicilio = new DomicilioPeticion();
            $catalogoEstados = new CatalogoEstados();
            $request = new NoAportantesPeticion();
            
            $domicilio->setDireccion("PASADISO ENCONTRADO 1");
            $domicilio->setColoniaPoblacion("MONTEVIDEO");
            $domicilio->setDelegacionMunicipio("GUSTAVO A MADERO");
            $domicilio->setCiudad("CIUDAD DE MÉXICO");
            $domicilio->setEstado($catalogoEstados::CDMX);
            $domicilio->setCp("07730");

            $persona->setPrimerNombre("JUAN01");
            $persona->setApellidoPaterno("PRUEBAP01");
            $persona->setApellidoMaterno("PRUEBAM01");
            $persona->setFechaNacimiento("1980-01-01");
            $persona->setDomicilio($domicilio);

            $request->setFolio("1600001");
            $request->setTipoProducto("R");
            $request->setTipoContrato($tipoContrato::TC);
            $request->setFrecuenciaPago($catalogoPago::M);
            $request->setDiasAtraso(21);
            $request->setNumeroCuenta("3000001");
            $request->setFechaApertura("2019-01-01");
            $request->setSaldoActual(15301);
            $request->setPersona($persona);


            $result = $this->apiInstance->getVantageNoAportantes($this->x_api_key, $request);
            print_r($result);
        } catch (ApiException | Exception $e) {
            echo 'Exception when calling ApiTest->testGetVantageNoAportantes: ', $e->getMessage(), PHP_EOL;
        }
    }
        
}
