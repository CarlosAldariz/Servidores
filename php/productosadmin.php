<!DOCTYPE html>
<html lang="en">
<head> 
<link rel="icon" type="image/x-icon" href="css/anadir-a-la-cesta.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>  
    <link rel="stylesheet" href="css/tablasbotonesadmion.css">   
    <style>
    a { 
  color:white;
 } 

 a:hover { 
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
    <?php 
    if (isset($_POST['CodCat'])) { 
        $CodCat = $_POST['CodCat'];    
    } else { 
        header("location:categoriasadmin.php");
    }; 

    $conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");

$sql = "SELECT * FROM Productos WHERE CodCat = $CodCat"; 


$result = mysqli_query($conn, $sql);

// Generas la tabla con la información de los productos

echo "<table class='container'>";

echo "<tr><th><h1>Nombre</h1></th><th><h1>Descripcion</h1></th><th><h1>Precio</h1></th><th><h1>Stock</h1></th><th><h1>Activo</h1></th></tr>";

while ($row = $result->fetch_assoc()) { 

    echo "<tr>"; 

    echo "<td>".$row['Nombre']."</td>";

    echo "<td>".$row['Descripcion']."</td>";

    echo "<td>".$row['Precio']."</td>";

    echo "<td>".$row['Stock']."</td>";  
    
    if ($row['Activo'] == 0) { 
        echo "<td> Desactivado </td>"; 
    }  else { 
        echo "<td> Activado </td>";
    }

    //echo "<td>".$row['Activo']."</td>";

    echo "<td><form method='post' action='activarproducto.php'><input type='hidden' name='CodProduct' value='" . htmlspecialchars($row["CodProduct"]) . "'><input type='hidden' name='CodCat' value='$CodCat'><button type='submit'>Activar</button></form></td>";

    echo "<td><form method='post' action='desactivarproducto.php'><input type='hidden' name='CodProduct' value='" . htmlspecialchars($row["CodProduct"]) . "'><input type='hidden' name='CodCat' value='$CodCat'><button type='submit'>Desactivar</button></form></td>";

    echo "<td><form method='post' action='borrarproducto.php'><input type='hidden' name='CodProduct' value='" . htmlspecialchars($row["CodProduct"]) . "'><input type='hidden' name='CodCat' value='$CodCat'><button type='submit'>Borrar</button></form></td>";  

    echo "<td><form method='post' action='stockproducto.php'><input type='hidden' name='CodProduct' value='" . htmlspecialchars($row["CodProduct"]) . "'><input type='hidden' name='CodCat' value='$CodCat'><button type='submit'>Cambiar Stock</button></form></td>";  

    echo "</tr>";

};   

echo "</table>";   
?>

<form method="post" action="crearproducto.php">
<input type="hidden" name="CodCat" value="<?php echo $CodCat; ?>">
<button type="submit">Crear Producto</button>
</form>  

<?php
echo "<p><a href='menuadmin.php'>Ver menú</a></p>"; 

echo "<p><a href='categoriasadmin.php'>Categorías</a></p>"; 

?> 

</body>
</html>