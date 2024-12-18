<!DOCTYPE html>
<html>

<head>
    <title>Izipay - Formulario Incrustado</title>
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
    <section class="container">
        <form class="col-md-12" action="checkout.php" method="POST">
            <div class="row">
                <div class="left-column col-md-6">
                    <section class="customer-details">
                        <h2>Datos del cliente</h2>
                        <div class="form-row">
                            <!-- Nombre -->
                            <div class="form-group col-md-6">
                                <label for="firstName">Nombre</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Nombre" required>
                            </div>
                            <!-- Apellido -->
                            <div class="form-group col-md-6">
                                <label for="lastName">Apellido</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Apellido" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>

                        <!-- Teléfono -->
                        <div class="form-group">
                            <label for="phoneNumber">Teléfono</label>
                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="999999999" required>
                        </div>

                        <div class="form-row">
                            <!-- Tipo de Documento -->
                            <div class="form-group col-md-4">
                                <label for="identityType">Tipo de Documento</label>
                                <select class="form-control" id="identityType" name="identityType">
                                    <option value="DNI">DNI</option>
                                    <option value="PS">Pasaporte</option>
                                    <option value="CE">Carné de Extranjería</option>
                                </select>
                            </div>

                            <!-- Documento -->
                            <div class="form-group col-md-8">
                                <label for="identityCode">Documento</label>
                                <input type="text" class="form-control" id="identityCode" name="identityCode" placeholder="Doc. Identidad" required>
                            </div>
                        </div>
                    </section>
                    <section class="billing-details">
                        <h2>Datos de envío</h2>
                        <!-- Dirección -->
                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Nombre de la calle y número de casa" required>
                        </div>

                        <div class="form-row">
                            <!-- País -->
                            <div class="form-group col-md-6">
                                <label for="country">País</label>
                                <select class="form-control" id="country" name="country">
                                    <option value="PE">Perú</option>
                                    <option value="AR">Argentina</option>
                                    <option value="CL">Chile</option>
                                    <option value="CO">Colombia</option>
                                    <!-- Agrega más países si es necesario -->
                                </select>
                            </div>

                            <!-- Estado -->
                            <div class="form-group col-md-6">
                                <label for="state">Departamento</label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="Departamento" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <!-- Ciudad -->
                            <div class="form-group col-md-6">
                                <label for="city">Distrito</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Distrito" required>
                            </div>

                            <!-- Código Postal -->
                            <div class="form-group col-md-6">
                                <label for="zipCode">Código Postal</label>
                                <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="15021" required>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="right-column col-md-6">
                    <section class="customer-details">
                        <h2>Datos del pago</h2>
                        <!-- Order ID -->
                        <div class="form-group">
                            <label for="orderId">Order-id</label>
                            <input type="text" class="form-control" id="orderId" name="orderId" placeholder="Order" required>
                        </div>

                        <!-- Monto -->
                        <div class="form-group">
                            <label for="amount">Monto</label>
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="0.00" step="0.01" min="0" required>
                        </div>

                        <!--Moneda-->
                        <div class="form-group">
                            <label for="currency">Moneda</label>
                            <select class="form-control" id="currency" name="currency">
                                <option value="PEN">Soles</option>
                                <option value="USD">Dólares</option>
                            </select>
                        </div>
                    </section>
                    <button class="btn btn-primary" type="submit">Pagar</button>
                </div>
            </div>
        </form>
    </section>
</body>

</html>