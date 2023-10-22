<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Resources/css/styles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>ABC Jugueteras</title>
    
</head>
<body>
    <?PHP
        include('navbarMainMenu.php');
        include('sideBarMenu.php');
    ?>
    <div class="main" id="main" style="margin-left: 180px;">
        <div class="w3-container" style="display: initial;">
            <span title="open Sidebar" style="display: none; color:aqua;" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">☰</span>
            <h3 class="h3" >Altas, bajas y cambios de marcas de juguetes</h3>
            <fieldset>
                <p>Consulta de marcas:</p>
                <form action="/Resources/views/consultaJugueteras.php" class="form-login" method="POST">
                    <div id="divSubmit" class="form-input">
                        <input type="submit" value="Consultar">
                    </div>
                </form>
            </fieldset>
            <fieldset>
                <p>Alta de marcas:</p>
                <form action="/resources/views/altaJugueteras.php" class="form-login" method="POST">
                    <div id="divNombreJuguetera" class="form-input">
                        <label for="lblNombreJuguetera">Nombre de marca</label>
                        <input type="text" id="txtNombreJuguetera" name="txtNombreJuguetera" required>
                    </div>
                    <div id="divIdPaisAlta" class="form-input">
                        <label for="lblPais">País:</label>
                        <select name="cmbPais" id="cmbPais">
                            <option value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>
                    <div id="divIdFundacionAlta" class="form-input">
                        <label for="lblFundacion">Fundación:</label>
                        <input type="number" id="txtAñoFundacion" name="txtAñoFundacion" min="1800" max="2099" required>
                    </div>
                    <div id="divSubmit" class="form-input">
                        <input type="submit" value="Guardar">
                    </div>
                </form>
            </fieldset>
            <fieldset>
                <p>Baja de marcas:</p>
                <form action="/Resources/views/bajaPaises.php" class="form-login" method="POST">
                    <div id="divNombrePais" class="form-input">
                        <label for="lblNombrePaise">Nombre de Marca</label>
                        <input type="text" id="txtNombrePais" name="txtNombrePaisBaja" required>
                    </div>
                    <div id="divSubmit" class="form-input">
                        <input type="submit" value="Eliminar">
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