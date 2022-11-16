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
        

        /*Insertamos los valores del nuevo usuario en la BD de "Virtuajoint", tabla "users" */

        //DECLARAMOS las variables a utilizar para la conexión (Mas a adelante hay que sacar de aqui estos datos)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "virtuajoint";

        //Traemos los valores de los campos del formulario de registro y los convertimos en variables de php:
        $userFname = $_POST["fname"];
        $userLName = $_POST["lname"];
        $aliasUser = $_POST["alias"];
        $paisUSer = $_POST["country"];
        $emailUser = $_POST["email"];
        $psswdUser = $_POST["pssword"];

        //Intentamos abrir la conexión y crear la BD
        try
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO users (userFName, userLName, aliasUser, paisUser, emailUser, psswdUser)
            VALUES ('$userFname', '$userLName', '$aliasUser', '$paisUSer', '$emailUser', '$psswdUser')";
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "New record created successfully";
        } 
        catch(PDOException $e) 
        {
            echo $sql . "<br>" . $e->getMessage();
        }

        $conn = null;//cerramos la conexion a la bd

        /*Terminamos de insertar los valores del nuevo usuario en la BD de "Virtuajoint", tabla "users" */
    ?>




</body>
</html>