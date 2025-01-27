<p align="center">
  <img src="https://github.com/izipay-pe/Imagenes/blob/main/logos_izipay/logo-izipay-banner-1140x100.png?raw=true" alt="Formulario" width=100%/>
</p>

# Redirect-PaymentForm-Php

## Índice

➡️ [1. Introducción](#-1-introducci%C3%B3n)  
🔑 [2. Requisitos previos](#-2-requisitos-previos)  
🚀 [3. Ejecutar ejemplo](#-3-ejecutar-ejemplo)  
🔗 [4. Pasos de integración](#4-pasos-de-integraci%C3%B3n)  
💻 [4.1. Desplegar pasarela](#41-desplegar-pasarela)  
💳 [4.2. Analizar resultado de pago](#42-analizar-resultado-del-pago)  
📡 [4.3. Pase a producción](#43pase-a-producci%C3%B3n)  
🎨 [5. Personalización](#-5-personalizaci%C3%B3n)  
📚 [6. Consideraciones](#-6-consideraciones)

## ➡️ 1. Introducción

En este manual podrás encontrar una guía paso a paso para configurar un proyecto de **[PHP]** con la pasarela de pagos de IZIPAY. Te proporcionaremos instrucciones detalladas y credenciales de prueba para la instalación y configuración del proyecto, permitiéndote trabajar y experimentar de manera segura en tu propio entorno local.
Este manual está diseñado para ayudarte a comprender el flujo de la integración de la pasarela para ayudarte a aprovechar al máximo tu proyecto y facilitar tu experiencia de desarrollo.


<p align="center">
  <img src="https://github.com/izipay-pe/Imagenes/blob/main/formulario_redireccion/Imagen-Formulario-Redireccion.png?raw=true" alt="Formulario" width="750"/>
</p>

## 🔑 2. Requisitos Previos

- Comprender el flujo de comunicación de la pasarela. [Información Aquí](https://secure.micuentaweb.pe/doc/es-PE/form-payment/standard-payment/definir-pasos-de-pago-vista-del-vendedor.html)
- Extraer credenciales del Back Office Vendedor. [Guía Aquí](https://github.com/izipay-pe/obtener-credenciales-de-conexion)
- Para este proyecto utilizamos la herramienta Visual Studio Code.
- Servidor Web
- PHP 7.0 o superior

> [!NOTE]
> Tener en cuenta que, para que el desarrollo de tu proyecto, eres libre de emplear tus herramientas preferidas.

## 🚀 3. Ejecutar ejemplo

### Instalar Xampp u otro servidor local compatible con php

Xampp, servidor web local multiplataforma que contiene los intérpretes para los lenguajes de script de php. Para instalarlo:

1. Dirigirse a la página web de [xampp](https://www.apachefriends.org/es/index.html)
2. Descargarlo e instalarlo.
3. Inicia los servicios de Apache desde el panel de control de XAMPP.


### Clonar el proyecto
```sh
git clone https://github.com/izipay-pe/Redirect-PaymentForm-Php.git
``` 

### Datos de conexión 

Reemplace **[CHANGE_ME]** con sus credenciales de `API formulario V1, V2` extraídas desde el Back Office Vendedor, revisar [Requisitos previos](#-2-requisitos-previos).

- Editar el archivo `keys.example.php` en la ruta raíz:
```php
// Identificador de su tienda
define("SHOP_ID", "~ CHANGE_ME_USER_ID ~");

// Clave de Test o Producción
define("KEY", "~ CHANGE_ME_KEY ~");
```

### Ejecutar proyecto

1. Mover el proyecto y descomprimirlo en la carpeta htdocs en la ruta de instalación de Xampp: `C://xampp/htdocs/[proyecto_php]`

2.  Abrir el navegador web(Chrome, Mozilla, Safari, etc) con el puerto 80 que abrió xampp : `http://localhost:80/[nombre_de_proyecto]`.

## 🔗4. Pasos de integración

<p align="center">
  <img src="https://i.postimg.cc/pT6SRjxZ/3-pasos.png" alt="Formulario" />
</p>

## 💻4.1. Desplegar pasarela
### Calcular la firma
Las claves de `Identificador de tienda` y `Clave de test o producción` se utilizan para calcular la firma junto a los parámetros de la compra por medio de la función `calculateSignature` y se añade al final de los parámetros. Podrás encontrarlo en el archivo `keys.example.php`.
```php
function dataForm(){
  $newParams = array(
    "vads_action_mode" => "INTERACTIVE",
    "vads_amount" => $_POST["amount"] * 100,
    "vads_ctx_mode" => "TEST", // TEST O PRODUCTION
    "vads_currency" => $_POST["currency"] == "PEN" ? 604:840, // Codigo ISO 4217
    ..
    ..
    "vads_url_return" => 'http://localhost/Redirect-PaymentForm-Php-main/result.php', //URL de retorno
    "vads_version" => "V2"
  );

  //Calcular la firma
  $newParams["signature"] = calculateSignature($newParams, KEY);

  return $newParams; 
}

function calculateSignature($parameters, $key)
{
  $content_signature = "";
  ksort($parameters);
  foreach ($parameters as $name => $value) {
    if (substr($name, 0, 5) == 'vads_') {
      $content_signature .=  $value . "+";
    }
  }
  $content_signature .= $key;
  $signature = base64_encode(hash_hmac('sha256', mb_convert_encoding($content_signature, "UTF-8"), $key, true));
  return $signature;
}
```

ℹ️ Para más información: [Calcular la firma](https://secure.micuentaweb.pe/doc/es-PE/form-payment/standard-payment/calcular-la-firma.html)
### Redirección del comprador hacia la página de pago
Para desplegar la pasarela, crea un formulario **HTML** de tipo **POST** con el valor del **ACTION** con la url de servidor de la pasarela de pago y agregale los parámetros de pago como etiquetas `<input type="hidden" name="..." value="" />`. Como se muestra el ejemplo en la ruta del archivo `checkout.php`

```html
<!-- Formulario con los datos de pago -->
<form action="https://secure.micuentaweb.pe/vads-payment/" method="post">
    <!-- Inputs generados dinámicamente -->
    <?php
      foreach ($parameters as $key => $value) {
        echo "<input type='hidden' name='$key' value='$value' >";
      }
    ?>
    <button class="btn btn-primary" type="submit" name="pagar">Pagar</button>
</form>
```
ℹ️ Para más información: [Redirección del comprador hacia la página de pago](https://secure.micuentaweb.pe/doc/es-PE/form-payment/standard-payment/1redireccion-del-comprador-hacia-la-pagina-de-pago.html)

## 💳4.2. Analizar resultado del pago

### Procesar regreso a la tienda
Se configura el método `checkSignature` que se encargara de validar la firma, retornará un valor `true` o `false`. Podrás encontrarlo en el archivo `keys.example.php`.

```php
function checkSignature($parameters){
  $signature = $parameters['signature'];

  return $signature == calculateSignature($parameters, KEY);
}
```

Se valida que la firma recibida es correcta en el archivo `result.php`.

```php
<?php
require_once "keys.example.php";

if (empty($_POST)) {
  throw new Exception("No post data received!");
}

// Validación de firma
if (!checkSignature($_POST)) {
  throw new Exception("Invalid signature");
}

?>
```
En caso que la validación sea exitosa, se renderiza el template con los valores. Como se muestra en el archivo `result.php`.

```html
<p><strong>Estado:</strong> <?= $_POST['vads_trans_status'] ?></p>
<p><strong>Monto:</strong> <?= ($_POST['vads_currency'] == 604) ? 'PEN' : 'USD'; ?>. <?= number_format($_POST['vads_amount'] / 100, 2)  ?></p>
<p><strong>Order-id:</strong> <?= $_POST['vads_order_id'] ?></p>
```
ℹ️ Para más información: [Procesar el regreso a la tienda](https://secure.micuentaweb.pe/doc/es-PE/form-payment/standard-payment/procesar-el-regreso-a-la-tienda.html)

### IPN
La IPN es una notificación de servidor a servidor (servidor de Izipay hacia el servidor del comercio) que facilita información en tiempo real y de manera automática cuando se produce un evento, por ejemplo, al registrar una transacción.

Se realiza la verificación de la firma y se retorna la respuesta del estado del pago. Se recomienda verificar el parámetro `orderStatus` para determinar si su valor es `AUTHORISED`. De esta manera verificar si el pago se ha realizado con éxito.

Podrás encontrarlo en el archivo `ipn.php`.

```php
<?php
require_once "keys.example.php";

if (empty($_POST)) {
  throw new Exception("No post data received!");
}

// Validación de Firma
if (!checkSignature($_POST)) {
  throw new Exception("Invalid signature");
}

//Verificar orderStatus: AUTHORISED
$orderStatus = $_POST['vads_trans_status'];
$orderId = $_POST['vads_order_id'];
$transactionUuid = $_POST['vads_trans_uuid'];

print 'OK! OrderStatus is ' . $orderStatus;
```

La ruta o enlace de la IPN debe ir configurada en el Backoffice Vendedor, en `Configuración -> Reglas de notificación -> URL de notificación al final del pago`

<p align="center">
  <img src="https://github.com/izipay-pe/Imagenes/blob/main/formulario_redireccion/Url-Notificacion-Redireccion.png?raw=true" alt="Url de notificacion en redireccion" width="650" />
</p>

ℹ️ Para más información: [Implementar IPN](https://secure.micuentaweb.pe/doc/es-PE/form-payment/standard-payment/implementar-la-ipn.html)

## 5. Transacción de prueba

Antes de poner en marcha su pasarela de pago en un entorno de producción, es esencial realizar pruebas para garantizar su correcto funcionamiento. 

Puede intentar realizar una transacción utilizando una tarjeta de prueba (en la parte inferior del formulario).

<p align="center">
  <img src="https://github.com/izipay-pe/Imagenes/blob/main/formulario_redireccion/Imagen-Formulario-Redireccion-testcard.png?raw=true" alt="Tarjetas de prueba" width="450"/>
</p>

- También puede encontrar tarjetas de prueba en el siguiente enlace. [Tarjetas de prueba](https://secure.micuentaweb.pe/doc/es-PE/rest/V4.0/api/kb/test_cards.html)

## 📡4.3.Pase a producción

Reemplace **[CHANGE_ME]** con sus credenciales de PRODUCCIÓN `API formulario V1, V2` extraídas desde el Back Office Vendedor, revisar [Requisitos Previos](#-2-requisitos-previos).

- Editar el archivo `keys.example.php` en la ruta raíz:
```php
// Identificador de su tienda
define("SHOP_ID", "~ CHANGE_ME_USER_ID ~");

// Clave de Test o Producción
define("KEY", "~ CHANGE_ME_KEY ~");
```

- Editar el archivo `keys.example.php`, cambia el parámetro `vads_ctx_mode` a `PRODUCTION` y la ruta de `vads_url_return`:
```php
  $newParams = array(
    "vads_action_mode" => "INTERACTIVE",
    "vads_amount" => $_POST["amount"] * 100,
    "vads_ctx_mode" => "PRODUCTION",
    "vads_currency" => $_POST["currency"] == "PEN" ? 604:840, // Codigo ISO 4217
    ..
    ..
    "vads_url_return" => '[midominio.com]/result.php', //URL de retorno
    "vads_version" => "V2"
  );
```

## 🎨 5. Personalización

Si deseas aplicar cambios específicos en la apariencia de la página de pago, puedes lograrlo mediante las opciones de personalización en el Backoffice. En este enlace [Personalización - Página de pago](https://youtu.be/hy877zTjpS0?si=TgSeoqw7qiaQDV25) podrá encontrar un video para guiarlo en la personalización.

<p align="center">
  <img src="https://github.com/izipay-pe/Imagenes/blob/main/formulario_redireccion/Personalizacion-formulario-redireccion.png?raw=true" alt="Personalizacion de formulario en redireccion"  width="750" />
</p>

## 📚 6. Consideraciones

Para obtener más información, echa un vistazo a:

- [Integración Formulario API](https://secure.micuentaweb.pe/doc/es-PE/form-payment/standard-payment/sitemap.html)
- [Lograr integración del Formulario API](https://secure.micuentaweb.pe/doc/es-PE/form-payment/quick-start-guide/sitemap.html)
