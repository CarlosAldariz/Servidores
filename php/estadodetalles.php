
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <link rel="stylesheet" href="css/tablasbotonesadmion.css">  
</head>
<body>
<?php
 session_start();
 if(isset($_SESSION["usuario"]) && isset($_SESSION["password"])){

     } else {
     header("location:mallogin.php");
 }

if (isset($_POST["CodPed"])) {
    $CodPed = $_POST["CodPed"];
} else  { 
    header("location:pedidosadmin.php");
}

$conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");

$query1 = "SELECT PP.Unidades, P.Nombre FROM PedidosProductos PP JOIN Productos P ON PP.CodProduct = P.CodProduct WHERE PP.CodPed=$CodPed";

$result1 = $conn->query($query1);

$query = "SELECT * FROM Pedidos WHERE CodPed=$CodPed";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Fecha = $row["Fecha"];
    $Precio_Total = $row["Precio_Total"];
    $Cod_Estado = $row["Cod_Estado"];
    $CodRes = $row["CodRes"];

    echo "<table class='container'>";
    echo "<tr><th>Nombre del Producto</th><th>Unidades</th></tr>";

    while ($row1 = $result1->fetch_assoc()) {
        $Nombre = $row1["Nombre"];
        $Unidades = $row1["Unidades"]; 
        echo "<tr><td>$Nombre</td><td>$Unidades</td></tr>";
    }

    echo "</table>";
} else {
    echo "No se encontró ningún pedido con el código especificado.";
}

?> 

    
</body>
</html>