<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Resources/css/styles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Alta de Países</title>
</head>
<body>
    <?PHP
        include('navbarMainMenu.php');
        include('sideBarMenu.php');
        
    ?>
    <div class="main" id="main" style="margin-left: 180px;">
        <div class="w3-container" style="display: initial;">
            <span title="open Sidebar" style="display: none; color:aqua;" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">☰</span>
            <h3 class="h3" >Alta de Paises</h3>
            <?PHP
                // include('C:\laragon\www\virtuajoint\config\database.php');
                //Así me explicó Fidelmar y funcionó
                include('../../config/database.php');
                
                //Declaramos la variable donde se traerá el nombre del pais
                $nombrePais = "";

                //Traemos los valores de los campos del formulario de alta de  Pais y los convertimos en variables de php. Antes de convertirlos, los pasamos a la función "test_input" para eliminar caracteres innecesarios y "\" con el fin de mejorar la seguridad Validamos que los campos no vengan vacios desde el formulario
                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    //Validamos las variables que vienen del formulario:
                    $nombrePais = test_input($_POST["txtNombrePaisAlta"]);

                }

                //Declaramos la funcion que valida el texto que traen los campos del formulario de login
                function test_input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data); 
                    $data = htmlspecialchars($data);
                    return $data;
                }

                try 
                {
                    $sqlInsert = "INSERT INTO paises (nombrePaises)
                    VALUES ('$nombrePais')";
                    // use exec() because no results are returned
                    $conn->exec($sqlInsert);
                    echo "Registro realizado con éxito";
                } 
                
                catch(PDOException $e) 
                {
                    echo $sqlInsert . "<br>" . $e->getMessage();
                }
                  
                $conn = null;
                
                include('footer.php');
            ?>
        </div>
    </div>
</body>
</html>