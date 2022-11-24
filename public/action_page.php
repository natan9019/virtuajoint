<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias por tu registro</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <nav class="navbar">
        <ul class="navbar-menu">
            <li> <a href="http://virtuajoint.test/">Home</a> </li>
            <li> <a href="http://virtuajoint.test/login.html">Login</a> </li>
            <li> <a href="http://virtuajoint.test/signin.html">Sign In</a> </li>
            <li> <a href="http://virtuajoint.test/initialize.html">Initialize</a></li>
        </ul>
    </nav>
    <!-- FIXME El texto para los H2 y el texto sin formato se ve muy pequeño -->
    <h1>Gracias por registrarte <?php echo $_POST["txtFName"]; ?> </h1>
    <h2>Da click en "confirma tu cuenta" en el correo que hemos enviado al email que indicaste: "<?php echo $_POST["txtEmail"]; ?>" </h2>

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
            $userFNameErr = $userLNameErr = $aliasUserErr = $countryUserErr = $genderUserErr = $emailUserErr = $psswdUserErr  = $websiteUserErr = "";
            //variables para los valores del POST:
            $userFName = $userLName = $aliasUser = $countryUser = $genderUser = $emailUser = $psswdUser  = $websiteUser = "";

            //Validamos las variables que vienen del formulario
            $userFName = test_input($_POST["txtFName"]);
            $userLName = test_input($_POST["txtLName"]);
            $aliasUser = test_input($_POST["txtAlias"]);
            $countryUser = test_input($_POST["txtCountry"]);
            $genderUser = test_input($_POST["txtGender"]);
            $emailUser = test_input($_POST["txtEmail"]);
            $psswdUser = test_input($_POST["txtPassword"]);
            $websiteUser = test_input($_POST["txtWebsite"]);
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
            $sql = "INSERT INTO users (userFName, userLName, aliasUser, paisUser, genderUser, emailUser, psswdUser, websiteUser)
            VALUES ('$userFName', '$userLName', '$aliasUser', '$countryUser', '$genderUser', '$emailUser', '$psswdUser', '$websiteUser')";
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "<h3>Registro agregado correctamente<h3>";
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