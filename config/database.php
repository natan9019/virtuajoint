<?php

    //Ambiente QA en Azure
    define('USER', 'admin5');
    define('PASSWORD', 'Fuco.truco');
    define('HOST', 'dbs-virtuajoint-dev1.mysql.database.azure.com');
    define('DATABASE', 'virtuajoint');

    // // //Ambiente DEV Local
    // define('USER', 'root');
    // define('PASSWORD', '');
    // define('HOST', 'localhost');
    // define('DATABASE', 'virtuajoint');

    try
    {
        //Definimos la cadena de conexión.
        $conn = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
        
        //seteamos el modo de error de PDO para una posible excepcion:
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        exit("Error: " . $e->getMessage());
    }

?>