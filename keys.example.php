<?php
// Identificador de su tienda
define("SHOP_ID", "~ CHANGE_ME_USER_ID ~");

// Clave de Test o Producción
define("KEY", "~ CHANGE_ME_KEY ~");

//FUNCION para obtener el signature
function getSignature($params, $keys)
{
  $content_signature = "";
  // Ordenar los campos alfabéticamente
  ksort($params);
  foreach ($params as $name => $value) {
    // Recuperación de los campos vads_
    if (substr($name, 0, 5) == 'vads_') {
      // Concatenación con el separador "+"
      $content_signature .=  $value . "+";
    }
  }
  // Añadir la clave al final del string
  $content_signature .= $keys;
  // Codificación base64 del string cifrada con el algoritmo HMAC-SHA-256
  $signature = base64_encode(hash_hmac('sha256', mb_convert_encoding($content_signature, "UTF-8"), $keys, true));
  return $signature;
}
