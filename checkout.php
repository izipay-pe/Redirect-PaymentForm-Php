<?php
require_once "keys.example.php";

$parameters = dataForm();

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
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="center-column col-md-6">
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
          </section>

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
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
  </main>
</body>
<html>