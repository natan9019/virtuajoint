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
    <nav class="navbar">
        <ul class="navbar-menu">
            <li> <a href="http://virtuajoint.test/">Home</a> </li>
            <li> <a href="http://virtuajoint.test/login.html">Log In</a> </li>
            <li> <a href="http://virtuajoint.test/signin.html">Sign In</a> </li>
            <li> <a href="http://virtuajoint.test/initialize.html">Initialize</a></li>
        </ul>
    </nav>

    <section id="formInitializeContainer" class="initializeSection mainSection">
        <h1>Define los siguientes datos y pulsa "Inicializar" para comenzar a usar VirtuaJoint</h1><br>
        <h2>Nota: Deja los valores por default para un entorno local</h2><br>
        <form action="/createSystemDB.php" method="POST">

            <label for="lblServerName">Nombre del servidor</label><br>
            <input type="text" id="txtServerName" name="txtServerName" value="localhost"><br>

            <label for="lblAdminName">Usuario administrador</label><br>
            <input type="text" id="txtAdminName" name="txtAdminName" value="root"><br>

            <label for="lblDbName">Nombre de la base de datos</label><br>
            <input type="text" id="txtDbName" name="txtDbName" value="virtuajoint" readonly="readonly"><br>

            <label for="lblPassword">Contraseña de la cuenta administrador</label><br>
            <input type="password" id="txtPassword" name="txtPassword" value=""><br>


            <input type="submit" id="btnSubmit" value="Inicializar">
        </form>
    </section>
    <?php
        include('footer.php');
    ?>
</body>

</html>