<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/Resources/css/styles.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Inicializando</title>
    </head>
    <body>
        <?PHP
            include('navbarMainMenu.php');
            include('sideBarMenu.php');
        ?>
        <div class="main" id="main" style="margin-left: 180px;">
            <div class="w3-container" style="display: initial;">
                <span title="open Sidebar" style="display: none; color:aqua;" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">☰</span>
                <h3 class="h3" >Resultados de la inicialización:</h3>
                <p>Aqui podrás consultar los resultados del proceso de inicializacion: </p><br>
                <?PHP                    
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
                        // $sql = "CREATE DATABASE $dbname";
                        $sql = "CREATE SCHEMA IF NOT EXISTS $dbname DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci";
                        // use exec() because no results are returned
                        $conn->exec($sql);
                        echo "<p>Database " . $dbname . " created successfully</p>";
                    } 
                    catch(PDOException $e) //Si no pudo, lanza un error en pantalla
                    {
                        echo "<p>Error: ". $sql . "<br>" . $e->getMessage() . "</p><br>";                          
                    }
                    
                    $conn = null;//cerramos la conexion a la bd 

                    /******************************* Creación de la tabla Colores***********************/

                     //Intentamos abrir la conexión y crear la tabla
                     try 
                     {
                         $conn = new PDO("mysql:host=$servername", $username, $password);
                         // set the PDO error mode to exception
                         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                         $sql = "USE $dbname;
                         CREATE TABLE IF NOT EXISTS $dbname.`Colores` (
                           `idColores` INT NOT NULL AUTO_INCREMENT,
                           `nombreColor` VARCHAR(45) NOT NULL,
                           PRIMARY KEY (`idColores`),
                           UNIQUE INDEX `idColores_UNIQUE` (`idColores` ASC) VISIBLE,
                           UNIQUE INDEX `nombreColor_UNIQUE` (`nombreColor` ASC) VISIBLE)
                         ENGINE = InnoDB;";
                         // use exec() because no results are returned
                         $conn->exec($sql);
                         echo "<p>Table Colores created successfully</p>";
                         
                     } 
                     catch(PDOException $e) //Si no pudo, lanza un error en pantalla
                     {
                         echo "<p>Error: ". $sql . "<br>" . $e->getMessage() . "</p><br>";                          
                     }
                     
                     $conn = null;//cerramos la conexion a la bd 


                    /******************************* Creación de la tabla LugaresCompra***********************/

                     //Intentamos abrir la conexión y crear la tabla
                     try 
                     {
                         $conn = new PDO("mysql:host=$servername", $username, $password);
                         // set the PDO error mode to exception
                         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                         $sql = 
                            "CREATE TABLE IF NOT EXISTS $dbname.`LugaresCompra` (
                            `idlugaresCompra` INT NOT NULL AUTO_INCREMENT,
                            `nombreLugarCompra` VARCHAR(45) NULL,
                            PRIMARY KEY (`idlugaresCompra`),
                            UNIQUE INDEX `idlugaresCompra_UNIQUE` (`idlugaresCompra` ASC) VISIBLE)
                            ENGINE = InnoDB;
                         ";
                         // use exec() because no results are returned
                         $conn->exec($sql);
                         echo "<p>Table LugaresCompra created successfully</p>";
                         
                     } 
                     catch(PDOException $e) //Si no pudo, lanza un error en pantalla
                     {
                         echo "<p>Error: ". $sql . "<br>" . $e->getMessage() . "</p><br>";                          
                     }
                     
                     $conn = null;//cerramos la conexion a la bd 

                    /******************************* Creación de la tabla países***********************/
                    try 
                    {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        // sql to create table
                        $sqlQueryCreateTable = "CREATE TABLE IF NOT EXISTS $dbname.`Paises` (
                            `idPaises` INT NOT NULL AUTO_INCREMENT,
                            `nombrePaises` VARCHAR(45) NOT NULL,
                            PRIMARY KEY (`idPaises`),
                            UNIQUE INDEX `idPaises_UNIQUE` (`idPaises` ASC) VISIBLE,
                            UNIQUE INDEX `nombrePaises_UNIQUE` (`nombrePaises` ASC) VISIBLE)
                            ENGINE = InnoDB;";

                        // use exec() because no results are returned
                        $conn->exec($sqlQueryCreateTable);
                        echo "<p>Table Paises created successfully</p>";
                    } 
                    catch(PDOException $e) 
                    {
                        echo "<p>" . $sqlQueryCreateTable . "<br>" . $e->getMessage() . "</p><br>";
                    }
                    //Cerramos la conexión a la base:
                    $conn = null;

                    /******************************* Creación de la tabla Jugueteras***********************/
                    try 
                    {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        // sql to create table
                        $sqlQueryCreateTable = "CREATE TABLE IF NOT EXISTS `virtuajoint`.`Jugueteras` (
                            `idJugueteras` INT NOT NULL AUTO_INCREMENT,
                            `nombreJugueteras` VARCHAR(45) NOT NULL,
                            `idPais` INT NOT NULL,
                            `fundacionJugueteras` SMALLINT(5) NULL COMMENT 'Año de fundación de la marca',
                            PRIMARY KEY (`idJugueteras`, `idPais`),
                            UNIQUE INDEX `nombreMarca_UNIQUE` (`nombreJugueteras` ASC) VISIBLE,
                            UNIQUE INDEX `idMarca_UNIQUE` (`idJugueteras` ASC) VISIBLE,
                            INDEX `FK_Marca-Pais_idx` (`idPais` ASC) VISIBLE,
                            CONSTRAINT `FK_Marca-Pais`
                              FOREIGN KEY (`idPais`)
                              REFERENCES `virtuajoint`.`Paises` (`idPaises`)
                              ON DELETE NO ACTION
                              ON UPDATE NO ACTION)
                            ENGINE = InnoDB;";

                        // use exec() because no results are returned
                        $conn->exec($sqlQueryCreateTable);
                        echo "<p>Table Jugueteras created successfully</p>";
                    } 
                    catch(PDOException $e) 
                    {
                        echo "<p>" . $sqlQueryCreateTable . "<br>" . $e->getMessage() . "</p><br>";
                    }
                    //Cerramos la conexión a la base:
                    $conn = null;

                    /******************************* Creación de la tabla Armadoras***********************/
                    try 
                    {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        // sql to create table
                        $sqlQueryCreateTable = "CREATE TABLE IF NOT EXISTS `virtuajoint`.`Armadoras` (
                            `idArmadoras` INT NOT NULL AUTO_INCREMENT,
                            `nombreArmadoras` VARCHAR(45) NOT NULL,
                            `idPais` INT NOT NULL,
                            `fundacionArmadoras` VARCHAR(45) NULL,
                            PRIMARY KEY (`idArmadoras`, `idPais`),
                            UNIQUE INDEX `idArmadoras_UNIQUE` (`idArmadoras` ASC) VISIBLE,
                            UNIQUE INDEX `nombreArmadoras_UNIQUE` (`nombreArmadoras` ASC) VISIBLE,
                            INDEX `FK_Armadoras-Paises_idx` (`idPais` ASC) VISIBLE,
                            CONSTRAINT `FK_Armadoras-Paises`
                              FOREIGN KEY (`idPais`)
                              REFERENCES `virtuajoint`.`Paises` (`idPaises`)
                              ON DELETE NO ACTION
                              ON UPDATE NO ACTION)
                            ENGINE = InnoDB;";

                        // use exec() because no results are returned
                        $conn->exec($sqlQueryCreateTable);
                        echo "<p>Table Armadoras created successfully</p>";
                    } 
                    catch(PDOException $e) 
                    {
                        echo "<p>" . $sqlQueryCreateTable . "<br>" . $e->getMessage() . "</p><br>";
                    }
                    //Cerramos la conexión a la base:
                    $conn = null;

                   /******************************* Creación de la tabla Autos***********************/
                   try 
                   {
                       $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                       // set the PDO error mode to exception
                       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                       // sql to create table
                       $sqlQueryCreateTable = 
                        "CREATE TABLE IF NOT EXISTS `virtuajoint`.`Autos` (
                            `idAutos` INT NOT NULL AUTO_INCREMENT,
                            `fechaCompra` DATE NOT NULL DEFAULT '1990-02-19',
                            `precioCompra` DECIMAL(5,2) NOT NULL DEFAULT 0.0,
                            `idLugarCompra` INT NOT NULL,
                            `idModeloAuto` INT NOT NULL,
                            PRIMARY KEY (`idAutos`, `idLugarCompra`, `idModeloAuto`),
                            UNIQUE INDEX `idAutos_UNIQUE` (`idAutos` ASC) VISIBLE,
                            INDEX `FK_Autos-Lugar_idx` (`idLugarCompra` ASC) VISIBLE,
                            INDEX `FK_Autos-Modelo_idx` (`idModeloAuto` ASC) VISIBLE,
                            CONSTRAINT `FK_Autos-Lugar`
                              FOREIGN KEY (`idLugarCompra`)
                              REFERENCES `virtuajoint`.`LugaresCompra` (`idlugaresCompra`)
                              ON DELETE NO ACTION
                              ON UPDATE NO ACTION,
                            CONSTRAINT `FK_Autos-Modelo`
                              FOREIGN KEY (`idModeloAuto`)
                              REFERENCES `virtuajoint`.`Modelos` (`idModelos`)
                              ON DELETE NO ACTION
                              ON UPDATE NO ACTION)
                          ENGINE = InnoDB;";

                       // use exec() because no results are returned
                       $conn->exec($sqlQueryCreateTable);
                       echo "<p>Table Autos created successfully</p>";
                   } 
                   catch(PDOException $e) 
                   {
                       echo "<p>" . $sqlQueryCreateTable . "<br>" . $e->getMessage() . "</p><br>";
                   }
                   //Cerramos la conexión a la base:
                   $conn = null;                    

                                     /******************************* Creación de la tabla Modelos***********************/
                                     try 
                                     {
                                         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                         // set the PDO error mode to exception
                                         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                         // sql to create table
                                         $sqlQueryCreateTable = 
                                          "CREATE TABLE IF NOT EXISTS `virtuajoint`.`Modelos` (
                                          `idModelos` INT NOT NULL AUTO_INCREMENT,
                                          `nombreModelo` VARCHAR(45) NOT NULL,
                                          `añoModelo` VARCHAR(45) NULL COMMENT 'Todos los registros con 1901 en el año del modelo, es por que están pendientes de definirse el año real',
                                          `idMarcaJuguetera` INT NOT NULL,
                                          `idMarcaArmadora` INT NOT NULL,
                                          PRIMARY KEY (`idModelos`, `idMarcaJuguetera`, `idMarcaArmadora`),
                                          UNIQUE INDEX `idModelos_UNIQUE` (`idModelos` ASC) VISIBLE,
                                          INDEX `FK_Modelos-Armadoras_idx` (`idMarcaArmadora` ASC) VISIBLE,
                                          CONSTRAINT `FK_Modelos-Jugueteras`
                                            FOREIGN KEY (`idMarcaJuguetera`)
                                            REFERENCES `virtuajoint`.`Jugueteras` (`idJugueteras`)
                                            ON DELETE NO ACTION
                                            ON UPDATE NO ACTION,
                                          CONSTRAINT `FK_Modelos-Armadoras`
                                            FOREIGN KEY (`idMarcaArmadora`)
                                            REFERENCES `virtuajoint`.`Armadoras` (`idArmadoras`)
                                            ON DELETE NO ACTION
                                            ON UPDATE NO ACTION)
                                          ENGINE = InnoDB;";
                  
                                         // use exec() because no results are returned
                                         $conn->exec($sqlQueryCreateTable);
                                         echo "<p>Table Modelos created successfully</p>";
                                     } 
                                     catch(PDOException $e) 
                                     {
                                         echo "<p>" . $sqlQueryCreateTable . "<br>" . $e->getMessage() . "</p><br>";
                                     }
                                     //Cerramos la conexión a la base:
                                     $conn = null;                    
                  

                    /******************************* Creación de la tabla usuarios***********************/
                    try 
                    {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        // sql to create table
                        $sqlQueryCreateTable = "CREATE TABLE IF NOT EXISTS `virtuajoint`.`Usuarios` (
                            `idUsuarios` INT NOT NULL AUTO_INCREMENT COMMENT 'Id autoincremental del usuario',
                            `userFName` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Nombre del usuario',
                            `userLName` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Apellido del usuario',
                            `aliasUser` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Nickname o nombre de usuario dentro del sistema',
                            `idPaisUser` INT NOT NULL DEFAULT 1 COMMENT 'Nacionalidad del usuario',
                            `genderUser` VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Genero del usuario',
                            `emailUser` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL DEFAULT '' COMMENT 'Correo electronico del usuario',
                            `hashPsswdUser` VARCHAR(100) NOT NULL DEFAULT '' COMMENT 'Hash de la contraseña del usuario',
                            `websiteUser` VARCHAR(50) NULL COMMENT 'Sitio web del usuario (OPCIONAL)',
                            `regDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Registro de tiempo de la creación del usuario',
                            PRIMARY KEY (`idUsuarios`, `idPaisUser`),
                            UNIQUE INDEX `idUsuarios_UNIQUE` (`idUsuarios` ASC) VISIBLE,
                            INDEX `FK_Usuarios-Pais_idx` (`idPaisUser` ASC) VISIBLE,
                            CONSTRAINT `FK_Usuarios-Pais`
                              FOREIGN KEY (`idPaisUser`)
                              REFERENCES `virtuajoint`.`Paises` (`idPaises`)
                              ON DELETE NO ACTION
                              ON UPDATE NO ACTION)
                          ENGINE = InnoDB;";

                        // use exec() because no results are returned
                        $conn->exec($sqlQueryCreateTable);
                        echo "<p>Table Users created successfully</p>";
                    } 
                    catch(PDOException $e) 
                    {
                        echo "<p>" . $sqlQueryCreateTable . "<br>" . $e->getMessage() . "</p><br>";
                    }
                    //Cerramos la conexión a la base:
                    $conn = null;

                    //Generamos el hash de la contraseña del SuperAdmin
                    $psswdHashSA = password_hash($psswdSuperAdmin, PASSWORD_BCRYPT);

                    /******************************* Insertamos los paises en la tabla Paises***********************/
                    try
                    {
                        //Abrimos la conexión usando PDO y le pasamos los parametros:
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        // configuramos el modo de error de PDO con una excepecion:
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        //Metemos en una variable el código SQL a ejecutar:
                        $sqlInsertInTable = "INSERT INTO $dbname.`Paises` (`idPaises`, `nombrePaises`) VALUES (1, 'Pendiente');
                        INSERT INTO $dbname.`Paises` (`idPaises`, `nombrePaises`) VALUES (2, 'Alemania');
                        INSERT INTO $dbname.`Paises` (`idPaises`, `nombrePaises`) VALUES (3, 'Corea Sur');
                        INSERT INTO $dbname.`Paises` (`idPaises`, `nombrePaises`) VALUES (4, 'EUA');
                        INSERT INTO $dbname.`Paises` (`idPaises`, `nombrePaises`) VALUES (5, 'Francia');
                        INSERT INTO $dbname.`Paises` (`idPaises`, `nombrePaises`) VALUES (6, 'Inglaterra');
                        INSERT INTO $dbname.`Paises` (`idPaises`, `nombrePaises`) VALUES (7, 'Italia');
                        INSERT INTO $dbname.`Paises` (`idPaises`, `nombrePaises`) VALUES (8, 'Japon');
                        INSERT INTO $dbname.`Paises` (`idPaises`, `nombrePaises`) VALUES (9, 'Suecia');
                        INSERT INTO $dbname.`Paises` (`idPaises`, `nombrePaises`) VALUES (10, 'China');
                        INSERT INTO $dbname.`Paises` (`idPaises`, `nombrePaises`) VALUES (11, 'Indonesia');
                        INSERT INTO $dbname.`Paises` (`idPaises`, `nombrePaises`) VALUES (12, 'Malasia');
                        INSERT INTO $dbname.`Paises` (`idPaises`, `nombrePaises`) VALUES (13, 'Tailandia');
                        INSERT INTO $dbname.`Paises` (`idPaises`, `nombrePaises`) VALUES (14, 'Mexico');
                        ";
                        //Usamos exec() por que no se retornan resultados:
                        $conn->exec($sqlInsertInTable);
                        echo "<p>Paises iniciales insertados correctamente</p>";
                    }
                    catch(PDOException $e)
                    {
                        echo "<p>" . $sqlInsertInTable . "<br>" . $e->getMessage() . "</p>";
                    }

                    /******************************* Insertamos el usuario superadmin en la tabla usuarios***********************/
                    try
                    {
                        //Abrimos la conexión usando PDO y le pasamos los parametros:
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        // configuramos el modo de error de PDO con una excepecion:
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        //Metemos en una variable el código SQL a ejecutar:
                        $sqlInsertInTable = "INSERT INTO $dbname.`Usuarios` (`idUsuarios`, `userFName`, `userLName`, `aliasUser`, `idPaisUser`, `genderUser`, `emailUser`, `hashPsswdUser`, `websiteUser`)
                        values (1,'Super', 'Admin', 'SuperAdmin', 1, 'Macho', 'email@domain', '$psswdHashSA', 'www.virtuajoint.com.mx')";

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

                    //Incluimos el footer en la página
                    include('footer.php');
                ?>
            </div>
        </div>
    </body>
</html>

