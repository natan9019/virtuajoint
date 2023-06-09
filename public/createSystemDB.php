<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Inicializando</title>
</head>
<body>
    <?PHP
        include('navbarMainMenu.php');
    ?>
    <?php
        //DECLARAMOS las variables a utilizar para la conexión (Mas a adelante hay que sacar de aqui estos datos)
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
            $sql = "CREATE DATABASE $dbname";
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "<p>Database: " . $dbname . " created successfully</p><br>";
        } 
        catch(PDOException $e) //Si no pudo, lanza un error en pantalla
        {
            echo "<p>Error: ". $sql . "<br>" . $e->getMessage() . "</p><br>";                          
        }
        
        $conn = null;//cerramos la conexion a la bd 

        /******************************* Creación de la tabla usuarios***********************/
        try 
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // sql to create table
            $sqlQueryCreateTable = "CREATE TABLE `users` (
                `idUser` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id autoincremental del usuario',
                `userFName` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Nombre del usuario' COLLATE 'utf8mb4_general_ci',
                `userLName` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Apellido del usuario' COLLATE 'utf8mb4_general_ci',
                `aliasUser` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Nickname o nombre de usuario dentro del sistema' COLLATE 'utf8mb4_general_ci',
                `paisUser` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Nacionalidad del usuario' COLLATE 'utf8mb4_general_ci',
                `genderUser` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Genero del usuario' COLLATE 'utf8mb4_general_ci',
                `emailUser` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Correo electronico del usuario' COLLATE 'utf8mb4_general_ci',
                `hashPsswdUser` VARCHAR(100) NOT NULL DEFAULT '' COMMENT 'Hash de la contraseña del usuario' COLLATE 'utf8mb4_general_ci',
                `websiteUser` VARCHAR(50) COMMENT 'Sitio web del usuario (OPCIONAL)' COLLATE 'utf8mb4_general_ci',
                `regDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro de tiempo de la creación del usuario',
                PRIMARY KEY (`idUser`) USING BTREE
            )
            COMMENT='Usuarios del sistema VirtuaJoint'
            COLLATE='utf8mb4_general_ci'
            ENGINE=InnoDB
            AUTO_INCREMENT=0";

            // use exec() because no results are returned
            $conn->exec($sqlQueryCreateTable);
            echo "<p>Table Users created successfully</p>" . "<br>";
        } 
        catch(PDOException $e) 
        {
            echo "<p>" . $sqlQueryCreateTable . "<br>" . $e->getMessage() . "</p><br>";
        }
        //Cerramos la conexión a la base:
        $conn = null;

        //Generamos el hash de la contraseña del SuperAdmin
        $psswdHashSA = password_hash($psswdSuperAdmin, PASSWORD_BCRYPT);
        
        /******************************* Insertamos el usuario superadmin en la tabla usuarios***********************/
        try
        {
            //Abrimos la conexión usando PDO y le pasamos los parametros:
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // configuramos el modo de error de PDO con una excepecion:
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Metemos en una variable el código SQL a ejecutar:
            $sqlInsertInTable = "INSERT INTO users (idUser, userFName, userLName, aliasUser, paisUser, genderUser, emailUser, hashPsswdUser, websiteUser)
            values (1,'Super', 'Admin', 'SuperAdmin', 'Mexico', 'Macho', 'email@domain', '$psswdHashSA', 'www.virtuajoint.com.mx')";

            //Usamos exec() por que no se returnan resultados:
            $conn->exec($sqlInsertInTable);
            echo "<p>Usuario admin creado correctamente en la BD</p>";
        }
        catch(PDOException $e)
        {
            echo "<p>" . $sqlInsertInTable . "<br>" . $e->getMessage() . "</p>";
        }

        //Por ultimo cerramos la conexion a la BD
        $conn =null;

        /******************************* Creación de la tabla países***********************/
        try 
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // sql to create table
            $sqlQueryCreateTable = "CREATE TABLE `Paises` (
                `idPais` INT(3) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id autoincremental del país',
                `nombrePais` VARCHAR(60) NOT NULL DEFAULT '' COMMENT 'Nombre del pais' COLLATE 'utf8mb4_general_ci',
                PRIMARY KEY (`idPais`) USING BTREE
            )
            COMMENT='Paises registrados'
            COLLATE='utf8mb4_general_ci'
            ENGINE=InnoDB
            AUTO_INCREMENT=0";

            // use exec() because no results are returned
            $conn->exec($sqlQueryCreateTable);
            echo "<p>Table Paises created successfully</p>" . "<br>";
        } 
        catch(PDOException $e) 
        {
            echo "<p>" . $sqlQueryCreateTable . "<br>" . $e->getMessage() . "</p><br>";
        }
        //Cerramos la conexión a la base:
        $conn = null;

        /******************************* Insertamos los paises en la tabla Paises***********************/
        try
        {
            //Abrimos la conexión usando PDO y le pasamos los parametros:
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // configuramos el modo de error de PDO con una excepecion:
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Metemos en una variable el código SQL a ejecutar:
            $sqlInsertInTable = "INSERT INTO Paises (nombrePais) values ('PaisTest');
            INSERT INTO Paises (nombrePais) VALUES ('t2');
            INSERT INTO Paises (nombrePais) VALUES ('t3');
            ";
            //Usamos exec() por que no se returnan resultados:
            $conn->exec($sqlInsertInTable);
            echo "<p>Paises iniciales insertados correctamente</p>";
        }
        catch(PDOException $e)
        {
            echo "<p>" . $sqlInsertInTable . "<br>" . $e->getMessage() . "</p>";
        }

        //Por ultimo cerramos la conexion a la BD
        $conn =null;
    ?>

    


</body>
</html>

