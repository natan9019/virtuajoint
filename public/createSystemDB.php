<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BD Creada</title>
</head>
<body>
    <h1>Haz creado tu Base de datos: <?php echo $_POST["txtDbName"]; ?> </h1>

    <?php
        

        /*Insertamos los valores del nuevo usuario en la BD de "Virtuajoint", tabla "users" */

        //DECLARAMOS las variables a utilizar para la conexión (Mas a adelante hay que sacar de aqui estos datos)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "virtuajoint";

        //Traemos los valores de los campos del formulario de registro y los convertimos en variables de php.
        //Antes de convertirlos, los pasamos a la función "test_input" para eliminar caracteres innecesarios y "\" con el fin de mejorar la seguridad
        //Validamos que los campos no vengan vacios desde el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            //Definimos las variables a utilizar y las inicializamos vacias
            //variables de error:
            $fnameErr = $lnameErr = $aliasErr = $countryErr = $psswordErr = $emailErr = $genderErr = $websiteErr = "";
            //variables para los valores del POST:
            $userFname = $userLName = $aliasUser = $countryUser = $emailUser = $psswdUser = $genderErr = $websiteErr = "";

            if(empty($_POST["fname"]))
            {
                $nameErr = "El nombre es requerido";
            }
            $userFname = test_input($_POST["fname"]);
            $userLName = test_input($_POST["lname"]);
            $aliasUser = test_input($_POST["alias"]);
            $countryUser = test_input($_POST["country"]);
            $emailUser = test_input($_POST["email"]);
            $psswdUser = test_input($_POST["pssword"]);
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

<?php
/*Creamos la BD de Virtuajoint */

        //DECLARAMOS las variables a utilizar (Mas a adelante hay que sacar de aqui estos datos)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = $_POST["txtDbName"];

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
            echo $sql . "<br>" . $e->getMessage();                          
        }
        
        $conn = null;//cierra la conexión

 ?>