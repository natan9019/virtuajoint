<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias por tu registro</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?PHP
        include('navbarMainMenu.php');
    ?>


    <section class="mainSection">
        <h1>Gracias por registrarte <?php echo $_POST["txtFName"]; ?> </h1>
        <h2>Da click en "confirma tu cuenta" en el correo que hemos enviado al email que indicaste: "<?php echo $_POST["txtEmail"]; ?>" </h2>
        <?php
            // invocamos el archivo de la configuracion de BD
            // include('C:\laragon\www\virtuajoint\config\database.php');
            //Así me explicó Fidelmar y funcionó
            include('../../config/database.php');
            
            

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

                //Generamos el Hash(60 caracteres) con el password ingresado por el usuario
                $psswdHash = password_hash($psswdUser, PASSWORD_BCRYPT);
            }

            //Aqui validamos cada variable con la función test_input
            function test_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            /*Insertamos los valores del nuevo usuario en la BD de "Virtuajoint", tabla "usuarios" */
            try
            {
                // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // // set the PDO error mode to exception
                // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO usuarios (userFName, userLName, aliasUser, idPaisUser, genderUser, emailUser, hashPsswdUser, websiteUser)
                VALUES ('$userFName', '$userLName', '$aliasUser', '$countryUser', '$genderUser', '$emailUser', '$psswdHash', '$websiteUser')";
                // use exec() because no results are returned
                $conn->exec($sql);
                echo "<h3>Registro agregado correctamente<h3>";
                // echo "<h3>Hash del password: $psswdHash<h3>";
            } 
            catch(PDOException $e) 
            {
                echo $sql . "<br>" . $e->getMessage();
            }

            $conn = null;//cerramos la conexion a la bd

            /*Terminamos de insertar los valores del nuevo usuario en la BD de "Virtuajoint", tabla "usuarios" */
        ?>
    </section>


</body>
</html>