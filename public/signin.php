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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Registro - VirtuaJoint</title>
</head>

<body>
    <?PHP
        include('navbarMainMenu.php');
    ?>

    <div class="mainContent">
        <section class="signinSection mainSection">
            <h1>Crea tu cuenta para usar Virtuajoint</h1>
            <form action="/userRegister.php" method="post" class="form-signin">
                <div class="formFieldDiv">
                    <label for="lblFName">Nombre:</label>
                    <input type="text" id="txtFName" name="txtFName" placeholder="Juanito" required>
                </div>
                <div class="formFieldDiv">
                    <label for="lblLName">Apellido:</label>
                    <input type="text" id="txtLName" name="txtLName" placeholder="Alimaña" required>

                </div>
                <div class="formFieldDiv">
                    <label for="lblAlias">Alias:</label>
                    <input type="text" id="txtAlias" name="txtAlias" placeholder="Alias" required>

                </div>
                <div class="formFieldDiv">
                    <label for="lblCountry">País:</label>
                    <input type="text" id="txtCountry" name="txtCountry" placeholder="De las maravillas" required>

                </div>
                <div class="formFieldDiv">
                    <label for="lblGender">Género:</label>
                    <input type="text" id="txtGender" name="txtGender" placeholder="Genero" required>

                </div>
                <div class="formFieldDiv">
                    <label for="lblEmail">Correo:</label>
                    <input type="email" id="txtEmail" name="txtEmail" placeholder="email@domain.com" required>

                </div>
                <div class="formFieldDiv">
                    <label for="lblpssword">Contraseña:</label>
                    <input type="password" id="txtPassword" name="txtPassword" placeholder="********" required>

                </div>
                <div class="formFieldDiv">
                    <label for="lblWebsite">Sitio Web:</label>
                    <input type="text" id="txtWebsite" name="txtWebsite" placeholder="www.sitio.com">
                </div>

                <p><span class="asterisk"> *</span>Campos obligatorios</p>
                <input type="submit" id="btnSubmit" value="Enviar">
            </form>
        </section>    
    </div>
    <?php
        include('footer.php');
    ?>
</body>

</html>