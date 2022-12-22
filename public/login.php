<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Login - VirtuaJoint</title>
</head>

<body>
    <?PHP
        include('navbarMainMenu.php');
    ?>

    <section class="loginSection mainSection">
        <h1>Inicia sesión</h1>
        <form action="/userHomePage.php" class="form-login" method="POST">
            <div id="divUserName" class="form-login">
                <label for="lblUserName">Nombre de Usuario</label>
                <input type="text" id="txtUserName" name="txtUserName" required>
            </div>
            <div id="divPsswd" class="form-login">
                <label for="lblPsswd">Contraseña</label>
                <input type="password" id="txtPsswd" name="txtPsswd" required>
            </div>
            <div id="divSubmit" class="form-login">
                <input type="submit" value="Ingresar">
            </div>
        </form>
        <p>¿Olvidaste tu contraseña? Haz click <a href="" class="link-forgotPassword">aquí</a></p>
    </section>
    <?php
        include('footer.php');
    ?>

</body>

</html>