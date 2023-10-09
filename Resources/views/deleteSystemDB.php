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
                <br>
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

                    /******************************* Creación de la tabla ColoresPorAuto***********************/
                    try 
                    {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        // sql to create table
                        $sqlQueryCreateTable = 
                        "CREATE TABLE IF NOT EXISTS `virtuajoint`.`ColoresPorAuto` (
                            `idColoresPorAuto` INT NOT NULL AUTO_INCREMENT,
                            `colorCarroceriaPrincipal` INT NOT NULL,
                            `colorCarroceriaSecundario` INT NULL,
                            `colorCarroceriaTerciario` INT NULL,
                            `colorBase` INT NULL,
                            `colorInteriores` INT NULL,
                            `colorVidrios` INT NULL,
                            `idAuto` INT NOT NULL,
                            UNIQUE INDEX `idColoresPorAuto_UNIQUE` (`idColoresPorAuto` ASC) VISIBLE,
                            PRIMARY KEY (`idColoresPorAuto`, `colorCarroceriaPrincipal`, `idAuto`),
                            INDEX `FK_Colores_idx` (`colorCarroceriaPrincipal` ASC) VISIBLE,
                            UNIQUE INDEX `idAuto_UNIQUE` (`idAuto` ASC) VISIBLE,
                            INDEX `FK_ColoresXA-Color2_idx` (`colorCarroceriaSecundario` ASC) VISIBLE,
                            INDEX `FK_ColoresXA-Color3_idx` (`colorCarroceriaTerciario` ASC) VISIBLE,
                            INDEX `FK_ColoresXA-Color4_idx` (`colorBase` ASC) VISIBLE,
                            INDEX `FK_ColoresXA-Color5_idx` (`colorInteriores` ASC) VISIBLE,
                            INDEX `FK_ColoresXA-Color6_idx` (`colorVidrios` ASC) VISIBLE,
                            CONSTRAINT `FK_ColoresXA-Color1`
                            FOREIGN KEY (`colorCarroceriaPrincipal`)
                            REFERENCES `virtuajoint`.`Colores` (`idColores`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION,
                            CONSTRAINT `FK_ColoresXAuto-Autos`
                            FOREIGN KEY (`idAuto`)
                            REFERENCES `virtuajoint`.`Autos` (`idAutos`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION,
                            CONSTRAINT `FK_ColoresXA-Color2`
                            FOREIGN KEY (`colorCarroceriaSecundario`)
                            REFERENCES `virtuajoint`.`Colores` (`idColores`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION,
                            CONSTRAINT `FK_ColoresXA-Color3`
                            FOREIGN KEY (`colorCarroceriaTerciario`)
                            REFERENCES `virtuajoint`.`Colores` (`idColores`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION,
                            CONSTRAINT `FK_ColoresXA-Color4`
                            FOREIGN KEY (`colorBase`)
                            REFERENCES `virtuajoint`.`Colores` (`idColores`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION,
                            CONSTRAINT `FK_ColoresXA-Color5`
                            FOREIGN KEY (`colorInteriores`)
                            REFERENCES `virtuajoint`.`Colores` (`idColores`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION,
                            CONSTRAINT `FK_ColoresXA-Color6`
                            FOREIGN KEY (`colorVidrios`)
                            REFERENCES `virtuajoint`.`Colores` (`idColores`)
                            ON DELETE NO ACTION
                            ON UPDATE NO ACTION)
                            ENGINE = InnoDB;";

                        // use exec() because no results are returned
                        $conn->exec($sqlQueryCreateTable);
                        echo "<p>Table ColoresPorAuto created successfully</p>";
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

                    /******************************* Insertamos los valores restantes en las tablas***********************/
                    try
                    {
                        //Abrimos la conexión usando PDO y le pasamos los parametros:
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        // configuramos el modo de error de PDO con una excepecion:
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        //Metemos en una variable el código SQL a ejecutar:
                        $sqlInsertInTable = 
                        "START TRANSACTION;
                        USE `virtuajoint`;
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (1, 'Pendiente');
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (2, 'NA');
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (3, 'Amarillo');
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (4, 'Anaranjado');
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (5, 'Azul');
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (6, 'Beige');
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (7, 'Blanco');
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (8, 'Café');
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (9, 'Dorado');
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (10, 'Gris');
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (11, 'Morado');
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (12, 'Negro');
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (13, 'Plateado');
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (14, 'Rojo');
                        INSERT INTO `virtuajoint`.`Colores` (`idColores`, `nombreColor`) VALUES (15, 'Verde');
                        
                        COMMIT;
                        
                        
                        -- -----------------------------------------------------
                        -- Data for table `virtuajoint`.`LugaresCompra`
                        -- -----------------------------------------------------
                        START TRANSACTION;
                        USE `virtuajoint`;
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (1, 'Pendiente');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (2, 'Aurrera Esmeralda San Alfonso');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (3, 'Aurrera La Viga');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (4, 'Aurrera Matilde, Pachuca');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (5, 'Aurrera Viaducto');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (6, 'Beto Superwheels');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (7, 'Chedraui Universidad');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (8, 'Comercial Mexicana Chabacano');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (9, 'Coppel Viaducto');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (10, 'Desconocido');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (11, 'Jamaica');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (12, 'Juguetibici Las Antenas');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (13, 'Leobas Shop');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (14, 'Liverpool Parque Delta');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (15, 'Liverpool Santa Fe');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (16, 'Mega Soriana Asturias');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (17, 'Mega Soriana Coapa');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (18, 'Mercado Ortiz Tirado');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (19, 'Papeleria Veracruz');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (20, 'Puesto de Coyuya');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (21, 'Puesto de Francisco Daniel en Coruna');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (22, 'Puesto de Insurgentes');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (23, 'Puesto de Jamaica');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (24, 'Regalo de Jeannette');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (25, 'Soriana Asturias');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (26, 'Soriana Coapa');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (27, 'Soriana El Retono');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (28, 'Soriana Parque Delta');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (29, 'Tianguis Juguetes Alameda');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (30, 'Walmart Azcapotzalco');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (31, 'Walmart Boturini');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (32, 'Walmart miramontes');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (33, 'Walmart Miramontes');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (34, 'Walmart Nativitas');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (35, 'Walmart Periferico Sur');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (36, 'Walmart Portal Centro');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (37, 'Walmart Taxquena');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (38, 'Walmart Universidad');
                        INSERT INTO `virtuajoint`.`LugaresCompra` (`idlugaresCompra`, `nombreLugarCompra`) VALUES (39, 'Walmart Villacoapa');
                        
                        COMMIT;                  
                        
                        -- -----------------------------------------------------
                        -- Data for table `virtuajoint`.`Jugueteras`
                        -- -----------------------------------------------------
                        START TRANSACTION;
                        USE `virtuajoint`;
                        INSERT INTO `virtuajoint`.`Jugueteras` (`idJugueteras`, `nombreJugueteras`, `idPais`, `fundacionJugueteras`) VALUES (1, 'Pendiente', 1, 0000);
                        INSERT INTO `virtuajoint`.`Jugueteras` (`idJugueteras`, `nombreJugueteras`, `idPais`, `fundacionJugueteras`) VALUES (2, 'Bburago ', 1, 1976);
                        INSERT INTO `virtuajoint`.`Jugueteras` (`idJugueteras`, `nombreJugueteras`, `idPais`, `fundacionJugueteras`) VALUES (3, 'HotWheels ', 1, 1968);
                        INSERT INTO `virtuajoint`.`Jugueteras` (`idJugueteras`, `nombreJugueteras`, `idPais`, `fundacionJugueteras`) VALUES (4, 'Maisto', 1, 1967);
                        INSERT INTO `virtuajoint`.`Jugueteras` (`idJugueteras`, `nombreJugueteras`, `idPais`, `fundacionJugueteras`) VALUES (5, 'Majorette', 1, 1961);
                        INSERT INTO `virtuajoint`.`Jugueteras` (`idJugueteras`, `nombreJugueteras`, `idPais`, `fundacionJugueteras`) VALUES (6, 'MatchBox', 1, 1953);
                        INSERT INTO `virtuajoint`.`Jugueteras` (`idJugueteras`, `nombreJugueteras`, `idPais`, `fundacionJugueteras`) VALUES (7, 'Welly', 1, 1979);
                        
                        COMMIT;
                        
                        
                        -- -----------------------------------------------------
                        -- Data for table `virtuajoint`.`Armadoras`
                        -- -----------------------------------------------------
                        START TRANSACTION;
                        USE `virtuajoint`;
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (1, 'Pendiente', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (2, 'Acura', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (3, 'Alfa Romeo', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (4, 'Aston Martin', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (5, 'Audi', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (6, 'Austin', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (7, 'Bentley', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (8, 'Bugatti', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (9, 'Cadillac', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (10, 'Chevrolet', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (11, 'Citroen', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (12, 'Dodge', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (13, 'Ferrari', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (14, 'Ford', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (15, 'Honda', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (16, 'Jaguar', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (17, 'Jeep', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (18, 'Lamborghini', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (19, 'Land Rover', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (20, 'Lexus', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (21, 'Lotus', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (22, 'Man', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (23, 'Masttreta', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (24, 'Mazda', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (25, 'McLaren', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (26, 'Mercedez-Benz', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (27, 'MG', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (28, 'Mitsubishi', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (29, 'Nissan', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (30, 'Opel', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (31, 'Pagani', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (32, 'Plymouth', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (33, 'Polaris', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (34, 'Pontiac', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (35, 'Porsche', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (36, 'Renault', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (37, 'Scania', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (38, 'Shelby', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (39, 'Subaru', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (40, 'Tesla', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (41, 'Toyota', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (42, 'Volskwagen', 1, '0000');
                        INSERT INTO `virtuajoint`.`Armadoras` (`idArmadoras`, `nombreArmadoras`, `idPais`, `fundacionArmadoras`) VALUES (43, 'Volvo', 1, '0000');
                        
                        COMMIT;
                        
                        
                        -- -----------------------------------------------------
                        -- Data for table `virtuajoint`.`Modelos`
                        -- -----------------------------------------------------
                        START TRANSACTION;
                        USE `virtuajoint`;
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (1, 'Pendiente', '0000', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (2, '934.5', '2016', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (3, '2 Jet Z', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (4, '240 Drift Wagon', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (5, '356B Convertible', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (6, '370Z', '2010', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (7, '5 Alarm', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (8, '599XX', '2009', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (9, '718 Boxster', '2016', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (10, '8C Competizione', '2007', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (11, '911 GT-2', '2010', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (12, '911 Rally', '1985', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (13, '917LH', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (14, '918 Spyder', '2013', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (15, 'Acre Maker', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (16, 'Airuption', '2022', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (17, 'Alpine A110', '2017', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (18, 'AMG GT', '2014', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (19, 'Aristo Rat', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (20, 'Aventador J', '2012', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (21, 'Baja Bandit', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (22, 'Baja Bone Shaker', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (23, 'Ballistik', '2002', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (24, 'Barracuda Formula S', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (25, 'Beat All', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (26, 'Bel Air', '1957', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (27, 'Bentayga', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (28, 'Blastous Moto', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (29, 'Bogzilla', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (30, 'Bot Wheels', '2018', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (31, 'Bricking Speed', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (32, 'Bricking Trails', '2022', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (33, 'Bronco', '2021', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (34, 'Bump Around', '2017', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (35, 'C4 Cactus', '2018', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (36, 'Camaro', '1981', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (37, 'Camaro Custom', '2011', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (38, 'Camaro SS', '2016', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (39, 'Carbonator', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (40, 'Carrera GT', '2003', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (41, 'Charger', '1969', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (42, 'Charger', '1971', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (43, 'Chevelle SS 396 \'67', '1967', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (44, 'Chevy Nova \'66', '1966', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (45, 'Chiron', '2016', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (46, 'Chow Mobile', '2014', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (47, 'City Turbo II', '1985', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (48, 'Civic Custom', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (49, 'Civic EF', '1990', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (50, 'Classic 55 Nomad', '1955', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (51, 'Clear Speeder', '2021', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (52, 'Cliff Hanger', '2010', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (53, 'Cloud Cutter', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (54, 'Cobra 427 S/C', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (55, 'Colorado Xtreme', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (56, 'Continental', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (57, 'Corvette', '1955', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (58, 'Corvette C6R', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (59, 'Corvette C7 Z06', '2016', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (60, 'Corvette C7 Z06 Convertible', '2017', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (61, 'Corvette C7.R', '2014', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (62, 'Corvette Gasser', '1962', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (63, 'Corvette Racer', '1969', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (64, 'Corvette Stingray', '2014', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (65, 'Cosmic Coupe', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (66, 'Count Muscula', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (67, 'Crop Master', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (68, 'CR-X', '1985', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (69, 'CR-X', '1988', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (70, 'CTS Coupe', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (71, 'Custom \'18 Mustang GT', '2018', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (72, 'Custom Datsun 240Z', '1973', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (73, 'Custom Small Block', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (74, 'CX-5', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (75, 'Cybertruck', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (76, 'Darth Vader', '2014', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (77, 'DAVancenator', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (78, 'DB10', '2014', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (79, 'DB5', '1963', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (80, 'DBS', '2010', 3, 4);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (81, 'Deora III', '2018', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (82, 'Diaper Dragger', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (83, 'Dimachinni Veloce', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (84, 'Dino 246 GTS', '1968', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (85, 'Draggin Tail', '2009', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (86, 'Dragster', '1994', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (87, 'Dune Crusher', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (88, 'Dune-A-Soar', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (89, 'Eevil Weevil', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (90, 'El Camino 71', '1971', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (91, 'Electro Silhouette', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (92, 'Escort RS1600', '1970', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (93, 'Esprit S1', '1976', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (94, 'Express Delivery', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (95, 'F1', '1992', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (96, 'F1 GT3', '1995', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (97, 'F1 GTR', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (98, 'F-100', '1956', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (99, 'F-150 SVT Raptor', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (100, 'Firebird', '1970', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (101, 'Firebird', '1984', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (102, 'Four X Force', '2015', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (103, 'F-Type', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (104, 'Geoterra', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (105, 'GLE Coupe', '2015', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (106, 'Glory Chaser', '2022', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (107, 'GT LM', '2005', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (108, 'GTO', '2006', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (109, 'GT-R (R35) - Guaczilla', '2017', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (110, 'GTR R35', '2017', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (111, 'Haulin\' Class', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (112, 'Haul-O-Gram', '2019', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (113, 'Head Gasket', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (114, 'Honda CR-X', '1988', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (115, 'Hot Wired', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (116, 'HotWheels Transit Connect', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (117, 'Huayra', '2012', 3, 31);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (118, 'Huracan LP 610-4', '2014', 3, 18);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (119, 'Hyper Rocker', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (120, 'Indy 500 Oval', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (121, 'Iridium', '2014', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (122, 'Jay Leno Tank Car', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (123, 'Justice League Batmobile', '2017', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (124, 'Kadett', '1975', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (125, 'Kanan', '2014', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (126, 'Knight Draggin\'', '2020', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (127, 'L200 Triton', '2008', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (128, 'Land Rover Defender 110', '1997', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (129, 'Land Shark', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (130, 'LB Super Silhouette Silvia (S15)', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (131, 'LB-Silhouette WORKS GT 35GT-RR VER.2', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (132, 'Let\'s Go', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (133, 'Lightnin\' Bug', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (134, 'LM002', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (135, 'Load Lifter', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (136, 'Luke Skywalker', '2014', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (137, 'Mario Standard Kart', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (138, 'Matt and Debbie Hay\'s Pro Street Thunderbird', '1988', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (139, 'MBX 4X4', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (140, 'MBX Armored Truck', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (141, 'MBX Mini Swisher', '2018', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (142, 'Meter Made', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (143, 'MGB Coupe', '1971', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (144, 'MGB GT Coupe', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (145, 'Mini Cooper', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (146, 'Model 3', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (147, 'Model S', '2012', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (148, 'MR2', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (149, 'Mustang', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (150, 'Mustang 2+2 Fastback', '1965', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (151, 'Mustang Convertible', '2018', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (152, 'Mustang GT', '2018', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (153, 'Mustang GT Concept', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (154, 'Mustang Mach-E 1400', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (155, 'MX-5 Miata', '2015', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (156, 'MX-5 Miata', '1991', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (157, 'MXR', '2013', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (158, 'NSX Concept', '2012', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (159, 'Octane', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (160, 'Off Road Rider', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (161, 'Ollie Rocket', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (162, 'P1', '2013', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (163, 'Pajero Evolution', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (164, 'Panamera', '2013', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (165, 'Panamera Turbo S E-Hybrid Spor Turismo', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (166, 'PickUp', '1940', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (167, 'Piranha Terror', '2019', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (168, 'Power Pistons', '1994', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (169, 'Push \'N Puller', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (170, 'Quarry King', '2007', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (171, 'R390 GT1', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (172, 'R8', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (173, 'Rally Truck', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (174, 'Range Rover Classic', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (175, 'Range Rover Evoque', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (176, 'Ranger Raptor', '2019', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (177, 'Rat Rig', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (178, 'RD-03', '2014', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (179, 'Red Planet Transport', '2021', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (180, 'Reventon Roadster', '2007', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (181, 'Rising Heat', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (182, 'Road Mauler', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (183, 'Roller Toaster', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (184, 'RS 6 Avant', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (186, 'RS2 Avant', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (187, 'RX-7 \'95', '1995', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (188, 'RZR', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (189, 'S2000', '2011', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (190, 'Savanna RX-7 FC3S', '1989', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (191, 'SC400', '1990', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (192, 'Sea Hunter', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (193, 'Series III PickUp', '1971', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (194, 'Sesto Elemento', '2010', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (195, 'Shelby GT500', '2010', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (196, 'Silverado Trail Boss LT', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (197, 'Skidster', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (198, 'Skull Shaker', '2019', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (199, 'Skull Shaker', '2018', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (200, 'Skyline 2000 GT-R', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (201, 'Skyline 2000 GTX', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (202, 'Skyline GT-R (BNR32)', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (203, 'Slingshot', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (204, 'SLS', '2010', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (205, 'Snow Ripper', '2016', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (206, 'Snow Stormer', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (207, 'Sooo Fast', '2000', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (208, 'SP2', '1972', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (209, 'Spark Arrestor', '2014', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (210, 'Speed Trap', '2020', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (211, 'Sport Quattro', '1984', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (212, 'Sport RS', '2010', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (213, 'Street Wiener', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (214, 'Swamp Commander', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (215, 'Swat Truck', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (216, 'Sweet Driver', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (217, 'Sweptside Pickup', '1957', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (218, 'Symbolic', '2020', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (219, 'Terrain Trouncer', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (220, 'Terzo Millennio', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (221, 'TGS Dump truck 18.440', '2018', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (222, 'The Dark Knight Batmobile', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (223, 'Tomb Up', '2019', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (224, 'Turbine Sublime', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (225, 'V12 Speedster', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (226, 'V60', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (227, 'Valhalla Concept', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (228, 'Van', '1986', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (229, 'Vantom', '2012', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (230, 'Veloci-Racer', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (231, 'Viper RT/10', '1992', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (232, 'Vulcan', '2015', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (233, 'What-4-2', '2020', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (234, 'Wicket', '2014', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (235, 'Willys Pickup 4x4', '1962', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (236, 'Wrangler', '2017', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (237, 'WRX STI', '2015', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (238, 'XE SV Project 8', '2017', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (239, 'XJ220', '1992', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (240, 'X-Wing Fighter', '2016', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (241, 'Yoda', '2014', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (242, 'Z Proto', '1901', 1, 1);
                        INSERT INTO `virtuajoint`.`Modelos` (`idModelos`, `nombreModelo`, `añoModelo`, `idMarcaJuguetera`, `idMarcaArmadora`) VALUES (243, 'Hot Wheels High', '2013', 3, 3);
                        
                        COMMIT;
                        
                        
                        -- -----------------------------------------------------
                        -- Data for table `virtuajoint`.`Autos`
                        -- -----------------------------------------------------
                        START TRANSACTION;
                        USE `virtuajoint`;
                        INSERT INTO `virtuajoint`.`Autos` (`idAutos`, `fechaCompra`, `precioCompra`, `idLugarCompra`, `idModeloAuto`) VALUES (1, '2017-10-28', 21.6, 8, 117);
                        INSERT INTO `virtuajoint`.`Autos` (`idAutos`, `fechaCompra`, `precioCompra`, `idLugarCompra`, `idModeloAuto`) VALUES (2, '2017-10-28', 21.6, 8, 80);
                        INSERT INTO `virtuajoint`.`Autos` (`idAutos`, `fechaCompra`, `precioCompra`, `idLugarCompra`, `idModeloAuto`) VALUES (3, '2017-10-28', 21.6, 8, 118);
                        
                        COMMIT;
                        
                        
                        -- -----------------------------------------------------
                        -- Data for table `virtuajoint`.`ColoresPorAuto`
                        -- -----------------------------------------------------
                        START TRANSACTION;
                        USE `virtuajoint`;
                        INSERT INTO `virtuajoint`.`ColoresPorAuto` (`idColoresPorAuto`, `colorCarroceriaPrincipal`, `colorCarroceriaSecundario`, `colorCarroceriaTerciario`, `colorBase`, `colorInteriores`, `colorVidrios`, `idAuto`) VALUES (1, 4, 12, 1, 1, 1, 1, 1);
                        INSERT INTO `virtuajoint`.`ColoresPorAuto` (`idColoresPorAuto`, `colorCarroceriaPrincipal`, `colorCarroceriaSecundario`, `colorCarroceriaTerciario`, `colorBase`, `colorInteriores`, `colorVidrios`, `idAuto`) VALUES (2, 11, 12, 1, 1, 1, 1, 2);
                        INSERT INTO `virtuajoint`.`ColoresPorAuto` (`idColoresPorAuto`, `colorCarroceriaPrincipal`, `colorCarroceriaSecundario`, `colorCarroceriaTerciario`, `colorBase`, `colorInteriores`, `colorVidrios`, `idAuto`) VALUES (3, 14, 7, 1, 1, 1, 1, 3);
                        
                        COMMIT;";

                        //Usamos exec() por que no se returnan resultados:
                        $conn->exec($sqlInsertInTable);
                        echo "<p>Registros insertados correctamente</p>";
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

