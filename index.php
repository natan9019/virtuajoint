<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="images/food-and-drink-svgrepo-com.svg"/>
        <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Source+Sans+Pro&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./Resources/css/styles.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Home - VirtuaJoint</title>
        
    </head>
    <body class="fondo">
        <?PHP
            include('./Resources/views/navbarMainMenu.php');
        ?>
        <!-- <header class="header">
            <div class="container">
                <figure class="logo">
                    <img class="logo-principal" src="images/Simba Cabeza.png" height="50px" alt="Logo de Kahory's Shop" />
                </figure>
            </div>
        </header> -->
        <section class="hero">
            <div class="container">
                <h1>
                    Bienvenido a <strong class="color-strong">VirtuaJoint</strong>  
                </h1>
                <img class="hero-image" src="images/Simba el  Gato.png" width="300" alt="Imagen principal del sitio">   
            </div>
        </section>
        <section id="portafolio" class="portfolio">
            <div class="container">
                <!-- <h2>Mi catálogo de productos</h2> -->
                <!-- <article class="project">
                    <div class="project-details">
                        <h3 class="project-title">Banner Secundario</h3>
                        <p class="project-date"><small><strong>Presentación: </strong>390g.</small></p>
                        <p class="project-date"><small><strong>Disponibles: </strong></small>120</p>
                        <p class="project-description">Experimenta una sensación increíble al comer alguno de nuestros nutritivos alimentos</p>
                        <p class="project-url"><small><strong><a href="https://www.cocinacaserayfacil.net/comidas-faciles-rapidas-ricas-de-hacer/" target="_blank">Mas información:</a></strong> </small></p>
                    </div>
                    <figure class="project-imageContainer">
                        <img class="project-image" src="images/comidas_varias2.jpg" width="800" alt="Palmolive Agave Azul"/>
                    </figure>        
                </article> -->

                
            </div>
        </section>
 
        <!-- <section id="contacto" class="contact">
            <div class="container">
                <div class="sub-container">
                    <form action="/suscripcion/" class="form-email">
                        <h3>Contactame</h3>
                        <input type="text" placeholder="Déjame tu email">
                        <button>Enviar</button>
                    </form>
                    <div class="social">
                        <a href="https://twitter.com/LemuelNatan" class="social-link twitter"></a>
                        <a href="http://facebook.com/natan9019" class="social-link facebook"></a>
                        <a href="https://web.whatsapp.com/" class="social-link whatsapp"></a>
                        <a href="https://www.instagram.com/natan_9019/" class="social-link instagram"></a>
                    </div>
                </div>
            </div>
        </section> -->
        <?php
            include('./Resources/views/footer.php');
        ?>
    </body>
</html> 
    
