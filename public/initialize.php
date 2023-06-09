<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Initialize - Virtuajoint</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?PHP
        include('navbarMainMenu.php');
    ?>
    <div class="main">
        <section id="formInitializeContainer" class="initializeSection">
            <div class="initialize-instrucciones">
                <h1>Vamos a inicializar el sistema VirtuaJoint</h1>
                <h2>Nota: Deja los valores por default para un entorno local</h2>
            </div>

            <form action="/createSystemDB.php" method="POST" class="form-initialize">
                <fieldset class="fieldset-initialize">
                    <legend>Conexión al servidor de base de datos</legend>
                    <label for="lblServerName">Selecciona un servidor:</label>
                    <!-- <input type="text" id="txtServerName" name="txtServerName" value="localhost"><br> -->
                    <select id="txtServerName" name="txtServerName" >
                        <option value="localhost">localhost</option>
                        <option value="dbs-virtuajoint-dev1.mysql.database.azure.com">Azure</option>
                    </select>
                    
                    <label for="lblAdminName">Usuario administrador del servidor: </label>
                    <!-- <input type="text" id="txtAdminName" name="txtAdminName" value="root"><br> -->
                    <select name="txtAdminName" id="txtAdminName">
                        <option value="root">root</option>
                        <option value="admin5">admin5</option>
                    </select>
                    
                    <label for="lblPassword">Contraseña de la cuenta del administrador del servidor: </label>
                    <input type="password" id="txtPassword" name="txtPassword">

                    <label for="lblDbName">Nombre de la base de datos del sistema</label>
                    <input type="text" id="txtDbName" name="txtDbName" value="virtuajoint" readonly="readonly">
                </fieldset>
                
                <fieldset class="fieldset-initialize">
                    <legend>Alta del administrador del sistema</legend>
                    
                    <label for="lblSuperAdmin">Usuario administrador del sistema</label>
                    <input type="text" id="txtSuperadmin" name="txtSuperadmin" readonly="readonly" value="SuperAdmin">
                    
                    <label for="lblPsswdSA">Contraseña del SuperAdmin del sistema</label>
                    <input type="password" id="txtPsswdSA" name="txtPsswdSA" required>
                    
                    <input type="submit" id="btnSubmit" value="Inicializar">
                </fieldset>
            
            </form>
        </section>
    </div>
    <?php
        include('footer.php');
    ?>
</body>

</html>