# vantage-simulacion-client-php

Es un modelo que segmenta a los clientes morosos en 6 calificaciones, de acuerdo al avance esperado de mora en los siguientes 30 días. Reduce costos de gestión y administración de cartera morosa al segmentar a la población.

## Requisitos

PHP 7.1 ó superior

### Dependencias adicionales

- Se debe contar con las siguientes dependencias de PHP:
  - ext-curl
  - ext-mbstring
- En caso de no ser así, para linux use los siguientes comandos

```sh
#ejemplo con php en versión 7.3 para otra versión colocar php{version}-curl
apt-get install php7.3-curl
apt-get install php7.3-mbstring
```

- Composer [vea como instalar][1]

## Instalación

Ejecutar: `composer install`

## Guía de inicio

### Paso 1. Agregar el producto a la aplicación

Al iniciar sesión seguir los siguientes pasos:

1.  Dar clic en la sección "**Mis aplicaciones**".
2.  Seleccionar la aplicación.
3.  Ir a la pestaña de "**Editar '@tuApp**' ".
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/edit_applications.jpg" width="900">
    </p>
4.  Al abrirse la ventana emergente, seleccionar el producto.
5.  Dar clic en el botón "**Guardar App**":
    <p align="center">
      <img src="https://github.com/APIHub-CdC/imagenes-cdc/blob/master/selected_product.jpg" width="400">
    </p>

### Paso 2. Capturar los datos de la petición

Los siguientes datos a modificar se encuentran en **test/Api/ApiTest.php**

Es importante contar con el setUp() que se encargará de inicializar la petición. Por tanto, se debe modificar la URL (**url_API**); y la API KEY (**x_api_key**), como se muestra en el siguiente fragmento de código:

```php
public function setUp()
{
    $config = new Configuration();
    $config->setHost('the_url');
    $this->x_api_key = "your_x_api_key";
    $client = new \GuzzleHttp\Client();
    $this->apiInstance = new VantAgeApi($client,$config);
} 
```

Para la petición se deberá modificar el siguiente fragmento de código con los datos correspondientes:

> **NOTA:** Para más ejemplos de simulación, consulte la colección de Postman.

```php
/**
* Este son los métodos que se serán ejecutados en la prueba ubicado en path/to/repository/test/Api/ApiTest.php
*/
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
```

## Pruebas unitarias

Para ejecutar las pruebas unitarias:

```sh
./vendor/bin/phpunit
```

[1]: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos
