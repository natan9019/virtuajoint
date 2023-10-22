<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/Resources/css/styles.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Eliminar BD</title>
    </head>
    <body>
        <?PHP
            include('navbarMainMenu.php');
            include('sideBarMenu.php');
        ?>
        <div class="main" id="main" style="margin-left: 180px;">
            <div class="w3-container" style="display: initial;">
                <span title="open Sidebar" style="display: none; color:aqua;" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">☰</span>
                <h3 class="h3" >Resultados de la eliminacion de BD:</h3>
                <br>
                <?PHP                    
                    //DECLARAMOS las variables a utilizar para la conexión 
                    $servername = $_POST["txtServerName"];
                    $username = $_POST["txtAdminName"];
                    $password = $_POST["txtPassword"];
                    $dbname = $_POST["txtDbName"];
                    $psswdSuperAdmin = $_POST["txtPsswdSA"];
            
                    /******************************* Creación de la bd***********************/

                    //Traemos los valores de los campos del formulario de registro y los convertimos en variables de php. Antes de convertirlos, los pasamos a la función "test_input" para eliminar caracteres innecesarios y "\" con el fin de mejorar la seguridad. Validamos que los campos no vengan vacios desde el formulario
                    if ($_SERVER["REQUEST_METHOD"] == "POST")
                    {
                        $dbname = test_input($dbname);
                    }

                    //Aqui validamos cada variable con la función test_input
                    function test_input($data)
                    {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }

                    //Intentamos abrir la conexión y crear la BD
                    try 
                    {
                        $conn = new PDO("mysql:host=$servername", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        // $sql = "CREATE DATABASE $dbname";
                        $sql = "DROP DATABASE `virtuajoint`;";
                        // use exec() because no results are returned
                        $conn->exec($sql);
                        echo "<p>Database " . $dbname . " eliminated successfully</p>";
                    } 
                    catch(PDOException $e) //Si no pudo, lanza un error en pantalla
                    {
                        echo "<p>Error: ". $sql . "<br>" . $e->getMessage() . "</p><br>";                          
                    }
                    
                    $conn = null;//cerramos la conexion a la bd 

                    //Incluimos el footer en la página
                    include('footer.php');
                ?>
            </div>
        </div>
    </body>
</html>

