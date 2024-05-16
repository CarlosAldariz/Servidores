<!DOCTYPE html>
<html lang="en">
<head> 
<link rel="icon" type="image/x-icon" href="css/anadir-a-la-cesta.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Usuario</title> 
    <link rel="stylesheet" href=css/desplegables.css>
</head> 
<body>  
 <?php
 session_start();  
 // Comprobar se a sesión do usuario e contrasinal están establecidos
      if(isset($_SESSION["usuario"]) && isset($_SESSION["password"])){ 
        // Se están establecidos, non se fai nada
        } else {
             // Se non están establecidos, redirixir a unha páxina de erro e saír
             header("location:mallogin.php");
             exit();
        } 
     ?>
     <ul class="menu">  
     <li><a href="pedidomenucliente.php">Pedidos </a></li> 
         <li><a href="carrito.php">Carrito </a></li>  
         <li><a href="destroy.php">Cerrar Sesion </a></li>
        <li><a href="categoriascliente.php">Categorías</a>
            <ul>
            <?php
    // Conectar á base de datos
    $con = mysqli_connect("127.0.0.1", "root", "" , "pedidos");
    // Comprobar a conexión
    if (!$con) {
        // Se a conexión falla, amosar unha mensaxe de erro
        die("Connection failed: " . mysqli_connect_error());
        echo '<script>alert("No se ha podido acceder a la base de datos")</script>';
    }
    // Consulta SQL para obter as categorías
    $query = "SELECT Descripcion, CodCat FROM Categorias";
    $resultado = mysqli_query($con, $query); 
    $row = mysqli_fetch_array($resultado); 
    $CodCat = $row['CodCat'];
    // Comprobar se hai resultados
    if ($resultado) {
        $descripciones = array();  
        // Recoller as descricións das categorías
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $descripciones[] = $fila['Descripcion'];
            $CodCat = $fila['CodCat']; 
        } 
    }
    // Pechar a conexión coa base de datos
    mysqli_close($con);
?>
            </ul>
        </li>
    </ul>  
    
</body>
</html>
