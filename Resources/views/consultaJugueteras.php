<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Resources/css/styles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Consultar Países</title>
</head>
<body>
    <?PHP
        include('navbarMainMenu.php');
        include('sideBarMenu.php');
        
    ?>
    <div class="main" id="main" style="margin-left: 180px;">
        <div class="w3-container" style="display: initial;">
            <span title="open Sidebar" style="display: none; color:aqua;" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">☰</span>
            <h3 class="h3" >Consultar Marcas Jugueteras</h3>
            <?PHP
                // include('C:\laragon\www\virtuajoint\config\database.php');
                //Así me explicó Fidelmar y funcionó
                include('../../config/database.php');
                //Cuando se invoca esta clase renderiza la tabla en pantalla con los registros encontrados en la BD

                echo "<table style='border: solid 2px black;'>";
                echo "<tr><th>Id</th><th>Marca</th><th>Pais</th><th>Fundación</th></tr>";
                class TableRows extends RecursiveIteratorIterator
                {
                    function __construct($it) {
                        parent::__construct($it, self::LEAVES_ONLY);
                    }

                    function current() {
                        return "<td style='width:75px;border:1px solid black;'>" . parent::current(). "</td>";
                    }

                    function beginChildren() {
                        echo "<tr>";
                    }

                    function endChildren() {
                        echo "</tr>" . "\n";
                    }
                }

                try {
                    
                    $stmt = $conn->prepare("SELECT idJugueteras, nombreJugueteras, idPais, fundacionJugueteras FROM Jugueteras");
                    $stmt->execute();
                
                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                
                    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                        echo $v;
                    }
                }
                catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                $conn = null;
                echo "</table>";
                
                include('footer.php');
            ?>
        </div>
    </div>
</body>
</html>