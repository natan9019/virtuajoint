<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias por tu registro</title>
</head>
<body>
    <h1>Gracias por registrarte <?php echo $_POST["fname"]; ?> </h1>
    <h2>Da click en "confirma tu cuenta" en el correo que hemos enviado al email que indicaste: "<?php echo $_POST["email"]; ?>" </h2>

    <?php
        /*Creamos la DB a utilizar*/

        //DECLARAMOS las variables a utilizar
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = $_POST["txtDbName"];
        // $dbname = "unabasemas";

        try {
            $conn = new PDO("mysql:host=$servername", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE $dbname";
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "Database: " . $dbname . " created successfully<br>";
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();                          
        }
        
        $conn = null;
        /*Terminamos de Crear la DB a utilizar*/
    ?>




</body>
</html>