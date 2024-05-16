<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion clientes admin</title> 
    <link rel="stylesheet" href="css/pedidorealizado.css">  
    <link rel="stylesheet" href="css/inputneon.css">  
    <link rel="icon" type="image/x-icon" href="css/anadir-a-la-cesta.ico">
    <style> 
        p {
            color: white;
        } 
        legend { 
            color: white;
        } 
        a {
            color: white; 
        } 
        a:hover { 
            color:yellow;
        } 
        h1 { 
            color:yellow;
        }
    </style>
</head>
<body>  
    <?php 
        session_start(); 
        if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && $_SESSION["Cod_Rol"] == 2 ){
       
        } else { 
            header("location:mallogin.php");
        }    
    ?> 

    <h1>Crear Usuario</h1>
    <form action="anadir_cliente.php" method="post">
        <p><label for="usuario">Nombre</label>
        <input type="text" class="input" name="Nombre" placeholder="Nombre" required></p>

        <fieldset>
            <legend>Rol</legend>
            <p>
                <input type="radio" name="Cod_Rol" value="1" id="cliente" required>
                <label for="cliente">Cliente</label>
            </p>
            <p>
                <input type="radio" name="Cod_Rol" value="2" id="administrador" required>
                <label for="administrador">Administrador</label>
            </p>
        </fieldset>
            
        <p><label for="contrasinal">contrasinal</label>
        <input class="input" type="password" name="Clave" placeholder="Clave" required></p> 

        <p><label for="Pais">Pais</label>
        <input class="input" type="text" name="Pais" placeholder="Pais" required></p>

        <p><label for="CP">CP</label>
        <input class="input" type="text" name="CP" placeholder="CP" required></p> 

        <p><label for="Ciudad">Ciudad</label>
        <input class="input"  type="text" name="Ciudad" placeholder="Ciudad" required></p>

        <p><label for="Direccion">Direccion</label>
        <input class="input" type="text" name="Direccion" placeholder="Direccion" required></p>

        <button type="submit" name="submit" value="DAR DE ALTA">DAR DE ALTA</button>
    </form>

    <a href="activarclientes.php">Mostrar Clientes</a><br><br>   
    <a href="menuadmin.php">Volver ao Menu</a>  

</body>
</html>