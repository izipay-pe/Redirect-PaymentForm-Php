<?php
session_start();
require_once "configKey.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Redirect Form Izipay</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
</head>
<body>
  <div class="root">
    <div class="App">
      <h2>Pago Finalizado<img src="https://iziweb001.s3.amazonaws.com/webresources/img/logo.png" alt="Logo de Izipay"></h2>
      <div class="content-checkout">
        <div class='content-respuesta'>
          <div class='respuesta'>
                <?php
                    if(empty($_POST)){
                        echo "Post is empty";
                    }else{
                        echo "<h4>Respuesta de Pago</h4>";
                        foreach($_POST as $name => $value){
                          echo "<p>$name => <span>$value</span></p>";
                        }

                        // $archivo = fopen("data.php","w+b");
                        // if($archivo == false){
                        //     echo "error al crear el archivo";
                        // }else{
                        //     echo "el archivo ha sido creado";
                        //     fwrite($archivo, json_encode($_POST));
                        // }
                        // fclose($archivo);
                    }
                    ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="Soporte-Ecommerce">
    <figure><img src="https://iziweb001.s3.amazonaws.com/webresources/img/img-ico-call.png" alt="imagen de call center"></figure>
    <div>
        <h4><a href="tel:012130808">(01) 213-0808</a><a href="tel:010801-18181">0801-18181</a><a href="mailto:soporteecommerce@izipay.pe" style="color: rgb(0, 160, 157);">SoporteEcommerce@izipay.pe</a></h4>
        <p>Estaremos felices de ayudarte.</p>
    </div>
  </footer>
</body>
</html>