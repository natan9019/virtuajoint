<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BD Creada</title>
</head>
<body>
    <?php
        //DECLARAMOS las variables a utilizar para la conexión (Mas a adelante hay que sacar de aqui estos datos)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = $_POST["txtDbName"];
 
        //Traemos los valores de los campos del formulario de registro y los convertimos en variables de php.
        //Antes de convertirlos, los pasamos a la función "test_input" para eliminar caracteres innecesarios y "\" con el fin de mejorar la seguridad
        //Validamos que los campos no vengan vacios desde el formulario
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
            $sql = "CREATE DATABASE $dbname";
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "Database: " . $dbname . " created successfully<br>";
        } 
        catch(PDOException $e) //Si no pudo, lanza un error en pantalla
        {
            echo "Error: ". $sql . "<br>" . $e->getMessage();                          
        }
        
        $conn = null;//cerramos la conexion a la bd 
    ?>

    


</body>
</html>
