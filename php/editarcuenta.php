<!DOCTYPE html>
<html lang="en">
<head> 
<link rel="icon" type="image/x-icon" href="css/anadir-a-la-cesta.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion clientes admin</title> 
    <link rel="stylesheet" href="css/pedidorealizado.css">  
    <link rel="stylesheet" href="css/inputneon.css"> 
    <style> 
    p {
        color: white;
    } 
    legend { 
        color: white;
    } 
    a { 
  color:white;
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
        
        ///OJO CON ESTE BLOQUE QUE IGUAL AQUI LA LIAS!!!!!!!!!!!!!!!!! 
     
        //filtro admin
        ?> 
<h1> Editar </h1>
        <form action="editarcuenta.php" method="post">
           <p> <label for="usuario">Nombre</label>
            <input class="input" type="text" name="Nombre" placeholder="Nombre" required> </p>

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

           <p> <label for="contrasinal">contrasinal</label>
            <input class="input" type="password" name="Clave" placeholder="Clave" required> </p> 

           <p> <label for="Pais">Pais</label>
            <input class="input" type="text" name="Pais" placeholder="Pais" required> </p>

           <p> <label for="CP">CP</label>
            <input class="input" type="text" name="CP" placeholder="CP" required> </p> 
            <!-- outro filtro aqui --> 

            <p> <label for="Ciudad">Ciudad</label>
            <input class="input" type="text" name="Ciudad" placeholder="Ciudad" required>  </p>

            <p> <label for="Direccion">Direccion</label>
            <input class="input" type="text" name="Direccion" placeholder="Direccion" required> </p>

            <?php   

            $CodRes = $_POST['CodRes'];

            echo "<input type='hidden' name='CodRes' value='" . $CodRes . "'>"; 

            echo "<p><button type='submit'>Editar</button><br></p>";
            ?> 

            <a href="activarclientes.php">Mostrar Clientes</a><br><br>   

            <a href="menuadmin.php">Volver ao Menu</a>  

                <?php 
            
            // Obtener los valores enviados por el formulario  
            if (isset($_POST['CodRes'])) {
            if (isset($_POST['Nombre'])) { 
            $nombre = $_POST['Nombre'];
            $rol = $_POST['Cod_Rol'];
            $clave = $_POST['Clave']; 
            $hashedClave = password_hash($clave, PASSWORD_DEFAULT);
            $pais = $_POST['Pais'];
            $cp = $_POST['CP'];
            $ciudad = $_POST['Ciudad'];
            $direccion = $_POST['Direccion'];
            
            // Realizar la conexión a la base de datos
            $conexion = mysqli_connect("127.0.0.1", "root", "", "pedidos");
            
            // Verificar si la conexión fue exitosa
            if (!$conexion) {
                die("Error al conectar a la base de datos: " . mysqli_connect_error());
            }
            
            // Construir la consulta de actualización
            $sql = "UPDATE Restaurantes SET 
                    Nombre = '$nombre',
                    Cod_Rol = '$rol',
                    Clave = '$hashedClave', 
                    Pais = '$pais',
                    CP = '$cp',
                    Ciudad = '$ciudad',
                    Direccion = '$direccion'
                    WHERE CodRes = '$CodRes';";
            
            // Ejecutar la consulta
            if (mysqli_query($conexion, $sql)) {
                echo "Registro actualizado correctamente."; 
                header("location:activarclientes.php");
            } else {
                echo "Error al actualizar el registro: " . mysqli_error($conexion);
            }
            
            // Cerrar la conexión a la base de datos
            mysqli_close($conexion); 
        } } else {
            header("location:activarclientes.php");
        }
            ?>
</body>
</html>