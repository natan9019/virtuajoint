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

                //Traemos los valores de los campos del formulario de registro y los convertimos en variables de php. Antes de convertirlos, los pasamos a la función "test_input" para eliminar caracteres innecesarios y "\" con el fin de mejorar la seguridad Validamos que los campos no vengan vacios desde el formulario
                if($_SERVER["REQUEST_METHOD"] == "POST")
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
                echo "<table style='border: solid 1px black;'>";
                echo 
                "<tr>
                    <th>Número</th>
                    <th>Usuario</th>
                    <th>Apellido</th>
                    <th>Alias</th>
                    <th>Pais</th>
                    <th>Genero</th>
                    <th>E-Mail</th>
                    <th>Contraseña</th>
                    <th>Web Site</th>
                    <th>Registrado</th>
                </tr>";

                class TableRows extends RecursiveIteratorIterator 
                {
                    function __construct($it) {
                        parent::__construct($it, self::LEAVES_ONLY);
                    }

                    function current() {
                        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
                    }

                    function beginChildren() {
                        echo "<tr>";
                    }

                    function endChildren() {
                        echo "</tr>" . "\n";
                    }
                }

                try
                {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    
                    //seteamos el modo de error de PDO para una excepcion:
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    //Pasamos el código SQL a la variable de PHP que se usará para ejecutarlo:
                    // $sqlSelectScript = $conn->prepare("SELECT * FROM users WHERE aliasUser = '$aliasUser'");
                    $sqlSelectScript = $conn->prepare("SELECT * FROM users where aliasUser = '$aliasUser'");
                    $sqlSelectScript->execute();
                    
                    // set the resulting array to associative
                    $result = $sqlSelectScript->setFetchMode(PDO::FETCH_ASSOC);

                    foreach(new TableRows(new RecursiveArrayIterator($sqlSelectScript->fetchAll())) as $k=>$v) 
                    {
                        echo $v;
                    }

                }
                catch(PDOException $e)
                {
                    echo $sqlSelectScript . "<br><h3>El usuario no existe</h3>" . $e->getMessage();
                }

                //Cerramos la conexión al servidor de BD
                $conn = null;
                echo "</table>";

            ?>

        </section>
    </body>
</html>