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
            echo "Database: " . $dbname . " created successfully<br>";
        } 
        catch(PDOException $e) //Si no pudo, lanza un error en pantalla
        {
            echo "Error: ". $sql . "<br>" . $e->getMessage();                          
        }
        
        $conn = null;//cerramos la conexion a la bd 

        /******************************* Creación de la tabla usuarios***********************/
        try {
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
                    `emailUser` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Correo electronico del usuario' COLLATE 'utf8mb4_general_ci',
                    `psswdUser` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Contraseña del usuario' COLLATE 'utf8mb4_general_ci',
                    `regDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro de tiempo de la creación del usuario',
                    PRIMARY KEY (`idUser`) USING BTREE
                )
                COMMENT='Usuarios del sistema VirtuaJoint'
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB
                AUTO_INCREMENT=17";

                // use exec() because no results are returned
                $conn->exec($sqlQueryCreateTable);
                echo "Table Users created successfully";
            } 
            catch(PDOException $e) 
            {
                echo $sqlQueryCreateTable . "<br>" . $e->getMessage();
            }
            //Cerramos la conexión a la base:
            $conn = null;
    ?>

    


</body>
</html>

