<?php
/*Creamos la DB a utilizar*/

//DECLARAMOS las variables a utilizar
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "virtuajoint";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE $dbname";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Database created successfully<br>";
  } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();                          
  }
  
  $conn = null;
/*Terminamos de Crear la DB a utilizar*/


  ?>