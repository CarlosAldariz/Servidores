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
        color: white;
    } 
    a:hover { 
        color: red;
    } 
    </style>
</head>
<body> 
    <?php
 session_start();  
      if(isset($_SESSION["usuario"]) && isset($_SESSION["password"])){ 
        
         } else {
             header("location:mallogin.php");
         } 
     ?>
    <?php  
    ini_set('display_errors', 0);
    if (isset($_POST['CodCat'])) { 
        $CodCat = $_POST['CodCat'];

    } else { 
        echo "Necesitas seleccionar una categoria";
    }; 

    $conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");

$sql = "SELECT * FROM Productos WHERE CodCat = $CodCat AND Activo = 1";

$result = mysqli_query($conn, $sql);

// Generas la tabla con la información de los productos

echo "<table class='container'>";

echo "<tr><th>Nombre</th><th>Descripcion</th><th>Precio</th><th>Stock</th></tr>";

while ($row = $result->fetch_assoc()) { 

    echo "<tr>";

    echo "<td>".$row['Nombre']."</td>";

    echo "<td>".$row['Descripcion']."</td>";

    echo "<td>".$row['Precio']."</td>";

    echo "<td>".$row['Stock']."</td>"; 

    echo " <td> <form method='POST' action='pedirproducto.php'><input type='hidden' name='CodProduct' value='" . ($row["CodProduct"]) . "'><button class='glow' type='submit'>Al Carrito!</button></form> </td>"; 

    echo "</tr>";

}

echo "</table>"; 

echo "<p><a href='menu.php'>Ver menú</a></p>"; 

echo "<p><a href='categoriascliente.php'>Categorías</a></p>"; 

echo "<p><a href='carrito.php'>Carrito</a></p>";



?>
</body>
</html>