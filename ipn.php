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