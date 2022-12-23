<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Initialize - Virtuajoint</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <?PHP
        include('navbarMainMenu.php');
    ?>

    <section id="formInitializeContainer" class="initializeSection mainSection">
        <h1>Ingresa los siguientes datos y pulsa "Inicializar" para comenzar a usar VirtuaJoint</h1><br>
        <h2>Nota: Deja los valores por default para un entorno local</h2><br>
        <form action="/createSystemDB.php" method="POST">

            <label for="lblServerName">Nombre del servidor de BD</label><br>
            <input type="text" id="txtServerName" name="txtServerName" value="localhost"><br>

            <label for="lblAdminName">Usuario administrador de la BD</label><br>
            <input type="text" id="txtAdminName" name="txtAdminName" value="root"><br>

            <label for="lblPassword">Contraseña de la cuenta administrador de BD</label><br>
            <input type="password" id="txtPassword" name="txtPassword"><br>

            <label for="lblDbName">Nombre de la base de datos del sistema</label><br>
            <input type="text" id="txtDbName" name="txtDbName" value="virtuajoint" readonly="readonly"><br>

            <label for="lblSuperAdmin">Usuario administrador del sistema</label><br>
            <input type="text" id="txtSuperadmin" name="txtSuperadmin" readonly="readonly" value="SuperAdmin"><br>

            <label for="lblPsswdSA">Contraseña del SuperAdmin del sistema</label><br>
            <input type="password" id="txtPsswdSA" name="txtPsswdSA"><br>

            <input type="submit" id="btnSubmit" value="Inicializar">
        </form>
    </section>
    <?php
        include('footer.php');
    ?>
</body>

</html>