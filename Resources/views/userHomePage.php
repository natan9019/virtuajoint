<!DOCTYPE HTML>
<html>
    <head>
        <title>Mi portal - Virtuajoint</title>
        <link rel="stylesheet" href="./css/styles.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <section id="navbarSection">
            <?PHP
                include('navbarMainMenu.php');
                include('sideBarMenu.php');
                // invocamos el archivo de la configuracion de BD
                include('../config/database.php');
            ?>
        </section>
        <div class="main" id="main" style="margin-left: 180px;">
            <div class="w3-container" style="display: initial;">
                <span title="open Sidebar" style="display: none; color:aqua;" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">☰</span>
                <h3 class="h3" >Mi portal</h3>
                <?PHP
                    //Se invoca la función session start para registrar cuando se tuvo una sesión correcta: https://www.php.net/manual/en/function.session-start.php 
                    // session_start();
    
                    //Declaramos la variable donde se traerá el select del alias
                    $returnedAlias = "";
    
                    //Traemos los valores de los campos del formulario de registro y los convertimos en variables de php. Antes de convertirlos, los pasamos a la función "test_input" para eliminar caracteres innecesarios y "\" con el fin de mejorar la seguridad Validamos que los campos no vengan vacios desde el formulario
                    if($_SERVER["REQUEST_METHOD"] == "POST")
                    {
                        //Definimos las variables a utilizar en php y las inicializamos vacias
                        $aliasUser = $psswdUserFromTxt = "";
                        
                        //Validamos las variables que vienen del formulario:
                        $aliasUser = test_input($_POST["txtUserName"]);
                        $psswdUserFromTxt = test_input($_POST["txtPsswd"]);
                    }
    
                    //Declaramos la funcion que valida el texto que traen los campos del formulario de login
                    function test_input($data)
                    {
                        $data = trim($data);
                        $data = stripslashes($data); 
                        $data = htmlspecialchars($data);
                        return $data;
                    }
    
                    //Cuando se invoca esta clase renderiza la tabla en pantalla con los registros encontrados en la BD
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
    
                    //Abrimos la conexión y traemos el alias desde la base de datos
                    try
                    {
                        //Esto de abajo lo comenté por que ahora incluyo el archivo database.php
                        //Definimos la cadena de conexión.
                        // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
                        //seteamos el modo de error de PDO para una posible excepcion:
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        //Esto de arriba lo comenté por que ahora incluyo el archivo database.php
    
    
                        //Creamos la variable PHP y le pasamos el script SQL:
                        $sqlSelectWhereScript = $conn->prepare("SELECT aliasUser FROM users WHERE aliasUser = '$aliasUser'");
                        $sqlSelectWhereScript->execute();
    
                        // set the resulting array to associative
                        $result = $sqlSelectWhereScript->setFetchMode(PDO::FETCH_ASSOC);
    
                        //Asignamos el resultado traido de la BD a la variable returnedAlias
                        foreach(new TableRows(new RecursiveArrayIterator($sqlSelectWhereScript->fetchAll())) as $column=>$register) 
                        {
                            $returnedAlias = $register;
                        }
    
                        //Volcado de variable para verificar el valor del alias traido de la bd
                        // var_dump($returnedAlias);
                    }
                    
                    catch(PDOException $e)
                    {
                        echo $sqlSelectWhereScript . "<br><h3>La conexión a la bd falló </h3>" . $e->getMessage();
                    }                     
                    
                    //Validamos si el usuario existe, si es verdadero mostramos su info en una tabla, si es falso mostramos un mensaje de error:
                    if(empty($returnedAlias))
                    {
                        echo "<p>El usuario no existe, ¡registrate primero!</p>";
                    }
                    else 
                    {
                        /*Ya que se validó que el usuario existe, validamos la contraseña*/
    
                        //Traemos todos los valores del alias que coincida con el nombre de usuario ingresado
                        $sqlSelectUser = $conn->prepare("SELECT * FROM users WHERE aliasUser =:aliasUser");
    
                        $sqlSelectUser->bindParam("aliasUser", $aliasUser, PDO::PARAM_STR);
                        $sqlSelectUser->execute();
    
                        $resultado = $sqlSelectUser->fetch(PDO::FETCH_ASSOC);
    
                        // //Validamos que la contraseña ingresada, sea la misma que está en la BD para ese usuario:
                        if(password_verify($psswdUserFromTxt, $resultado['hashPsswdUser']))
                        {
                            //Mostramos el alias del usuario en pantalla:
                            echo "<p>Bienvenido $returnedAlias</p><br>";
    
                            //Imprimimos las cabeceras de la tabla
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
    
                            //Intentamos abrir la conexión a la BD y hacer un select para traer la info del usuario
                            try
                            {
                                // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                
                                // //seteamos el modo de error de PDO para una excepcion:
                                // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                
                                //Pasamos el código SQL a la variable de PHP que se usará para ejecutarlo:
                                $sqlSelectScript = $conn->prepare("SELECT * FROM users where aliasUser = '$aliasUser'");
                                $sqlSelectScript->execute();
                                
                                // set the resulting array to associative
                                $result = $sqlSelectScript->setFetchMode(PDO::FETCH_ASSOC);
    
                                foreach(new TableRows(new RecursiveArrayIterator($sqlSelectScript->fetchAll())) as $column=>$register) 
                                {
                                    echo $register;
                                }
                            }
                            catch(PDOException $e)
                            {
                                echo $sqlSelectScript . "<br><h3>La conexión a la bd falló</h3>" . $e->getMessage();
                            }
    
                            //Cerramos la etiqueta del elemento tabla
                            echo "</table>";
                            
                            //Volcamos las variables para ver su contenido
                            // echo "<br><p>";
                            //     var_dump($result);
                            // echo "</p>";
                            // echo "<br><p>";
                            //     var_dump($sqlSelectScript);
                            // echo "</p>";
                            // echo "<br><p>";
                            //     var_dump($column, $register);
                            // echo "</p>";
                        }  
                        else
                        {
                            echo "<p>ERROR: El usuario es correcto, pero la contraseña no coincide</p><br>";
                        }
                    }  
                    
    
                    //Cerramos la conexión al servidor de BD abierta 
                    $conn = null;
                        
                    include('footer.php');
                ?>
            </div>
        </div>
    </body>
</html>