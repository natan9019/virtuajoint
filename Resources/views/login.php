<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login - VirtuaJoint</title>
</head>

<body>
    <?PHP
        include('navbarMainMenu.php');
    ?>
    <div class="main">
        <section class="mainSection loginSection">
            <h1>Inicia sesión</h1>
            <form action="./userHomePage.php" class="form-login" method="POST">
                <div id="divUserName" class="form-input">
                    <label for="lblUserName">Nombre de Usuario</label>
                    <input type="text" id="txtUserName" name="txtUserName" required>
                </div>
                <div id="divPsswd" class="form-input">
                    <label for="lblPsswd">Contraseña</label>
                    <input type="password" id="txtPsswd" name="txtPsswd" required>
                </div>
                <div id="divSubmit" class="form-input">
                    <input type="submit" value="Ingresar">
                </div>
            </form>
            <p>¿Olvidaste tu contraseña? Haz click <a href="" class="link-forgotPassword">aquí</a></p>
        </section>  
    </div>
    <?php
        include('footer.php');
    ?>

</body>

</html>