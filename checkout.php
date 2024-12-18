<?php
require_once "keys.example.php";
date_default_timezone_set("UTC");

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
// Configuración inicial de pago
$datos = array(
  "vads_action_mode" => "INTERACTIVE",
  "vads_amount" => $_POST["amount"] * 100,
  "vads_ctx_mode" => "TEST",
  "vads_currency" => $_POST["currency"] == "PEN" ? 604:840, // Moneda PEN
  "vads_cust_address" => $_POST["address"],
  "vads_cust_city" => $_POST["city"],
  "vads_cust_country" => $_POST["country"],
  "vads_cust_email" => $_POST["email"],
  "vads_cust_first_name" => $_POST["firstName"],
  "vads_cust_last_name" => $_POST["lastName"],
  "vads_cust_national_id" => $_POST["identityCode"],
  "vads_cust_phone" => $_POST["phoneNumber"],
  "vads_cust_state" => $_POST["state"],
  "vads_cust_zip" => $_POST["zipCode"],
  "vads_order_id" => $_POST["orderId"],
  "vads_page_action" => "PAYMENT",
  "vads_payment_config" => "SINGLE",
  "vads_return_mode" => "POST",
  "vads_site_id" => SHOP_ID,
  "vads_trans_date" => date("YmdHis"), //Fecha en formato UTC
  "vads_trans_id" =>  substr(md5(time()), -6),      //"af491z",
  "vads_url_return" => $protocol . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . "/result.php",
  "vads_version" => "V2",
  "signature" => ""
);

// generar el signature
$datos["signature"] = getSignature($datos, KEY);

?>
<!DOCTYPE html>
<html>
<head>
  <title>checkout</title>
  <link rel='stylesheet' href='css/style.css' />
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/journal/bootstrap.min.css"
    integrity="sha384-QDSPDoVOoSWz2ypaRUidLmLYl4RyoBWI44iA5agn6jHegBxZkNqgm2eHb6yZ5bYs" crossorigin="anonymous" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <nav class="navbar bg-primary" style="background-color: #FF2D46!important;">
    <div class="container-fluid">
      <a href="/" class="navbar-brand mb-1"><img src="https://iziweb001b.s3.amazonaws.com/webresources/img/logo.png" width="80"></a>
    </div>
  </nav>
  <main>
    <div class="center-column mx-auto col-md-6">
      <section class="customer-details">
        <h2>Datos del pago</h2>
        <!-- Order ID -->
        <div class="form-group">
          <label for="orderId">Order-id</label>
          <input readonly class="form-control" value="<?= $_POST["orderId"] ?>" />
        </div>

        <!-- Monto -->
        <div class="form-group">
          <label for="amount">Monto</label>
          <input readonly class="form-control" value="<?= number_format($_POST['amount'] , 2) ?>" />
        </div>

        <!-- Moneda -->
        <div class="form-group">
          <label for="amount">Moneda</label>
          <input readonly class="form-control" value="<?= $_POST['currency'] ?>" />
        </div>
    </div>
    <section class="container text-center">
      <form class="from-checkout" action="https://secure.micuentaweb.pe/vads-payment/" method="post">
        <?php
        foreach ($datos as $key => $value) {
          echo "<input type='hidden' name='$key' value='$value' >";
        }
        ?>
        <button class="btn btn-checkout" type="submit" name="pagar">Pagar</button>
      </form>
    </section>
  </main>
</body>
<html>