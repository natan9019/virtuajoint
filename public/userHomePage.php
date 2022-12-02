<!DOCTYPE HTML>
<html>
    <head>
        <title>Mi portal - Virtuajoint</title>
        <link rel="stylesheet" href="./css/styles.css">
    </head>
    <body>
        <section id="navbarSection">
            <nav class="navbar">
                <ul class="navbar-menu">
                    <li> <a href="http://virtuajoint.test/">Home</a> </li>
                    <li> <a href="http://virtuajoint.test/login.html">Log In</a> </li>
                    <li> <a href="http://virtuajoint.test/signin.html">Sign In</a> </li>
                    <li> <a href="http://virtuajoint.test/initialize.html">Initialize</a></li>
                </ul>
            </nav>
        </section>
        <section id="heroSection">
            <?php

                //Se invoca la función session start para registrar cuando se tuvo una sesión correcta: https://www.php.net/manual/en/function.session-start.php 
                session_start();

                //DECLARAMOS las variables a utilizar para la conexión (Mas a adelante hay que sacar de aqui estos datos)
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "virtuajoint";

                //Traemos los valores de los campos del formulario de registro y los convertimos en variables de php.
                //Antes de convertirlos, los pasamos a la función "test_input" para eliminar caracteres innecesarios y "\" con el fin de mejorar la seguridad
                //Validamos que los campos no vengan vacios desde el formulario
                if($_SERVER["REQUEST_METHOD"] == "post")
                {
                    //Definimos las variables a utilizar en php y las inicializamos vacias
                    $aliasUser = $psswdUser = "";
                    
                    //Validamos las variables que vienen del formulario:
                    $aliasUser = test_input($_POST["txtUserName"]);
                    $psswdUser = test_input($_POST["txtPsswd"]);
                }

                //Declaramos la funcion que valida el texto que traen los campos del formulario de login
                function test_input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

                //Intentamos abrir la conexión a la BD y hacer un select para validar que el usuario exista:
                try
                {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    
                    // Validar la conexión de base de datos.
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    //seteamos el modo de error de PDO para una excepcion:
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    //Pasamos el código SQL a la variable de PHP que se usará para ejecutarlo:
                    $sqlSelectScript = $conn->prepare("SELECT * FROM users WHERE aliasUser = '$aliasUser'");
                    $sqlSelectScript->execute();
                    echo $sqlSelectScript;
                }
                catch(PDOException $e)
                {
                    echo $sqlSelectScript . "<br><h3>El usuario no existe</h3>" . $e->getMessage();
                }

                //Cerramos la noexión al servidor de BD
                $conn = null;

            ?>

        </section>
    </body>
</html>