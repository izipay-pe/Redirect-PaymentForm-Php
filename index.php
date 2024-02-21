<?php
session_start();
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

    <div id="root">
        <div class="App">
            <h2>Pasarela de pago <img src="https://iziweb001.s3.amazonaws.com/webresources/img/logo.png" alt="Logo de Izipay"></h2>
            <div class="List-Product" id="List-Product">
                <div class="Product">
                    <h4>izi Jr</h4><img src="https://www.izipay.pe/_nuxt/dist/img/izi-jr-large.1272137.png" alt="izi Jr">
                    <input type="hidden" id="amount" value="90">
                    <p><span>S/</span>90</p><button>Comprar</button>
                </div>
                <div class="Product">
                    <h4>izi android</h4><img src="https://www.izipay.pe/_nuxt/dist/img/izi-android-large.15bbbeb.png" alt="izi android">
                    <input type="hidden" id="amount" value="100">
                    <p><span>S/</span>100</p><button>Comprar</button>
                </div>
                <div class="Product">
                    <h4>Gestiona tu negocio</h4><img src="https://www.izipay.pe/_nuxt/dist/img/img-pos.8c27182.png" alt="Gestiona tu negocio">
                    <input type="hidden" id="amount" value="250">
                    <p><span>S/</span>250</p><button>Comprar</button>
                </div>
                <div class="Product">
                    <h4>Agente Izipay</h4><img src="https://www.izipay.pe/_nuxt/dist/img/agente-izipay-large.74b5825.png" alt="Agente Izipay">
                    <input type="hidden" id="amount" value="200">
                    <p><span>S/</span>200</p><button>Comprar</button>
                </div>
            </div>
            <?php
                if(isset($_POST["product"])){
                    $_SESSION["product"] = $_POST['product'];
                    echo "
                    <div class='content-checkout'>
                        <div class='cart'>
                            <div class='Product'>
                                <h4>".$_POST['product']."</h4><img src=".$_POST["image"]." alt=".$_POST["image"].">
                                <p><span>S/</span>". $_POST["amount"]."</p>
                            </div>
                        </div>
                        <div class='checkout'>
                            <h3>Datos del cliente</h3>
                            <form id='form-control' method='post'> 
                                <input type='hidden' value=".$_POST["amount"]." />
                                <input type='hidden' value=".$_POST["image"]." />
                                <div class='control-group'>
                                    <label for='firstname'>First Name</label>
                                    <input type'text' id='firstname' name='firstname' autocomplete='off' required='' value=''>
                                </div>
                                <div class='control-group'>
                                    <label for='lastname'>Last Name</label>
                                    <input type'text' id='lastname' name='lastname' autocomplete='off' required='' value=''>
                                </div>
                                <div class='control-group'>
                                    <label for='email'>Email</label>
                                    <input type'emai' id='email' name='email' autocomplete='off' required='' value=''>
                                </div>
                                <button>Registrar</button>
                            </form>
                        </div>
                    </div>
                  <script> 
                    window.scroll({top:400,left:100,behavior:'smooth'})
                    document.getElementById('form-control').addEventListener('click',(e)=>{
                    if(e.target.nodeName == 'INPUT'){
                        let group = e.target.parentElement.children;
                        group[0].style.top = '-5px';
                        group[0].style.fontSize = '12px';
                        e.target.addEventListener('blur',(e)=> {
                            if(group[1].value.length === 0){
                                group[0].style.top = '12px';
                                group[0].style.fontSize = '16px';
                            }
                        })
                    }
                    document.getElementById('form-control').addEventListener('submit',(e)=> infoPayment(e))
                })</script>
                  ";
                }else{
                    
                }
            ?>
        </div>
        <footer class="Soporte-Ecommerce">
            <figure><img src="https://iziweb001.s3.amazonaws.com/webresources/img/img-ico-call.png" alt="imagen de call center"></figure>
            <div>
                <h4><a href="tel:012130808">(01) 213-0808</a><a href="tel:010801-18181">0801-18181</a><a href="mailto:soporteecommerce@izipay.pe" style="color: rgb(0, 160, 157);">SoporteEcommerce@izipay.pe</a></h4>
                <p>Estaremos felices de ayudarte.</p>
            </div>
        </footer>
    </div>


    <script>
        const sendData = (path, parameters, method = 'post') => {
            const form = document.createElement('form');
            form.method = method;
            form.action = path;
            document.body.appendChild(form);

            for (const key in parameters) {
                const formField = document.createElement('input');
                formField.type = 'hidden';
                formField.name = key;
                formField.value = parameters[key];
                form.appendChild(formField);
            }
            form.submit();
        }
        document.getElementById("List-Product").addEventListener("click", (e) => {
            if (e.target.nodeName == "BUTTON") {
                let data = {
                    product: e.target.parentElement.children[0].innerText,
                    image: e.target.parentElement.children[1].src,
                    amount: e.target.parentElement.children[2].value,
                }
                e.target.parentElement.parentElement.outerHTML  = "";
                // sendData('infoPayment.php', data, "post");
                sendData('index.php', data, "post");
            }
        })
        
       const infoPayment = (e) =>{
        e.preventDefault();
        console.log(e.target.children[2]);
            let dataPayment = {
                amount: e.target.children[0].value,
                image:  e.target.children[1].value,
                firstName: e.target.children[2].children[1].value,
                lastName: e.target.children[3].children[1].value,
                email: e.target.children[4].children[1].value,
            }
            sendData('infoPayment.php', dataPayment, "post");
       }
    </script>
</body>

</html>