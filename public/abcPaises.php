<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>ABC Paises</title>
</head>
<body>
    <?PHP
        include('navbarMainMenu.php');
        include('sideBarMenu.php');
        include('../config/database.php');
    ?>
    <div class="main" id="main" style="margin-left: 180px;">
        <div class="w3-container" style="display: initial;">
            <span title="open Sidebar" style="display: none; color:aqua;" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">☰</span>
            <h3 class="h3" >Altas, bajas y cambios de Países</h3>
            <fieldset>
                <p>Consulta de países:</p>
                <form action="http://virtuajoint.test/abcPaises.php" class="form-login" method="POST">
                    <div id="divSubmit" class="form-input">
                        <input type="submit" value="Consultar">
                    </div>
                </form>
            </fieldset>
            <fieldset>
                <p>Alta de países:</p>
                <form action="http://virtuajoint.test/abcPaises.php" class="form-login" method="POST">
                    <div id="divNombrePais" class="form-input">
                        <label for="lblNombrePaise">Nombre del País</label>
                        <input type="text" id="txtNombrePais" name="txtNombrePais" required>
                    </div>
                    <div id="divSubmit" class="form-input">
                        <input type="submit" value="Guardar">
                    </div>
                </form>
            </fieldset>
            <fieldset>
                <p>Baja de países:</p>
                <form action="http://virtuajoint.test/abcPaises.php" class="form-login" method="POST">
                    <div id="divNombrePais" class="form-input">
                        <label for="lblNombrePaise">Nombre del País</label>
                        <input type="text" id="txtNombrePais" name="txtNombrePais" required>
                    </div>
                    <div id="divSubmit" class="form-input">
                        <input type="submit" value="Guardar">
                    </div>
                </form>
            </fieldset>
            <?PHP
                include('footer.php');
            ?>
        </div>
    </div>
</body>
</html>