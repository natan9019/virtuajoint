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