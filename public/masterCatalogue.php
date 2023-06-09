<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalogo Maestro</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    @media screen and (max-width: 455px) {
        .h3 {
            font-size:16px;
        }
    }
    </style>
</head>
<body>
    <?PHP
        include('navbarMainMenu.php');
        include('sideBarMenu.php');
    ?>
    <div class="main" id="main" style="margin-left: 180px;">
        <div class="w3-container" style="display: initial;">
            <span title="open Sidebar" style="display: none; color:aqua;" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">☰</span>
            <h3 class="h3" >Catálogo Maestro</h3>
            <p>En esta sección podrás dar de alta los elementos para los combo Box en la interfaz de ABC</p>
            <?PHP
                include('footer.php');
            ?>
        </div>
    </div>
</body>
</html>