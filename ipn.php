<?php
require_once "keys.example.php";

// Verificar datos en POST
if (empty($_POST)) {
    throw new Exception("No post data received!");
}

// Validación de Firma
if (getSignature($_POST, KEY) != $_POST["signature"] ) {
    throw new Exception("Invalid signature");
  }

// Verificar vads_trans_status PAID
$orderStatus = $_POST['vads_trans_status'];
$orderId = $_POST['vads_order_id'];
$transactionUuid = $_POST['vads_trans_uuid'];

print 'OK! OrderStatus is ' . $orderStatus;