<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Resources/css/styles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Alta Jugueteras</title>
</head>
<body>
    <?PHP
        include('navbarMainMenu.php');
        include('sideBarMenu.php');
        
    ?>
    <div class="main" id="main" style="margin-left: 180px;">
        <div class="w3-container" style="display: initial;">
            <span title="open Sidebar" style="display: none; color:aqua;" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">☰</span>
            <h3 class="h3" >Alta de Marcas Jugueteras</h3>
            <?PHP
                // include('C:\laragon\www\virtuajoint\config\database.php');
                //Así me explicó Fidelmar y funcionó
                include('../../config/database.php');
                
                //Declaramos la variable donde se traerá el nombre del pais
                $nombreJugueteras = "";
                $nombrePais = "";
                $fundacionJugueteras = "";
                $idPais = "";

                //Traemos los valores de los campos del formulario de alta de  Pais y los convertimos en variables de php. Antes de convertirlos, los pasamos a la función "test_input" para eliminar caracteres innecesarios y "\" con el fin de mejorar la seguridad Validamos que los campos no vengan vacios desde el formulario
                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    //Validamos las variables que vienen del formulario:
                    $nombreJugueteras = test_input($_POST["txtNombreJuguetera"]);
                    $nombrePais = test_input($_POST["cmbPais"]);
                    $fundacionJugueteras = test_input($_POST["txtAñoFundacion"]);
                        
                }

                //Declaramos la funcion que valida el texto que traen los campos del formulario de login
                function test_input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data); 
                    $data = htmlspecialchars($data);
                    return $data;
                }

                //Esta linea permite verificar que valores traemos en las variables, debe comentarse una vez que se logre hacer los inserts exitosamente
                // echo "Valores: ".$nombreJugueteras."<br>".$nombrePais."<br>".$fundacionJugueteras."<br>";

                //Aquí traemos desde la BD el ID del pais que el usuario seleccionó en el combo box de Pais
                class TableRows extends RecursiveIteratorIterator
                {
                    function __construct($it) {
                        parent::__construct($it, self::LEAVES_ONLY);
                    }

                    //Esta linea desactivada, mostraria en pantalla el ID del pais selccionado por el usuario, solo es necesaria para pruebas
                    // function current() {
                    //     return "<p>ID Paiss: ". parent::current()."</p>";
                    // }
                }
                try 
                {
                    $stmt = $conn->prepare("SELECT idPaises FROM paises WHERE nombrePaises = '$nombrePais'");
                    $stmt->execute();
                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $column=>$register) {
                        $idPais = $register;
                    }
                    
                } 
                
                catch(PDOException $e) 
                {
                    echo $sqlInsert . "<br>" . $e->getMessage();
                }

                //Insertamos en la tabla Jugueteras los valores que vienen del formulario, junto con el id asociado al nombre de pais
                try 
                {
                    $sqlInsert = "INSERT INTO `virtuajoint`.`Jugueteras` (`nombreJugueteras`, `idPais`, `fundacionJugueteras`) VALUES ('$nombreJugueteras', $idPais, $fundacionJugueteras);";
                    // use exec() because no results are returned
                    $conn->exec($sqlInsert);
                    echo "Registro realizado con éxito: ".$sqlInsert;
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