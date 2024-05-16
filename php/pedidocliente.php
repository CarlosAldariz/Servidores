<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <link rel="stylesheet" href="css/pedidorealizado.css">  
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
    $nameusu = $_SESSION["usuario"];
} else {
    header("location:mallogin.php");
}

$conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");

if (!$conn) {
    echo "Error al conectar a la base de datos: " . mysqli_connect_error();
    exit;
}

$sqlcodres = "SELECT CodRes FROM Restaurantes WHERE Nombre = '$nameusu'";
$resultado = mysqli_query($conn, $sqlcodres);

if ($resultado) {
    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $CodRes = $fila['CodRes']; 
    } else {
        $CodRes = null; 
    } 
}

$sqlCarrito = "SELECT * FROM Carrito WHERE CodRes = $CodRes";
$result = $conn->query($sqlCarrito);

$contadorcantidad = 0; 
$contadorprecio = 0; 
$preciototal = 0; 
$codproduct = 0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $contadorcantidad += $row["Cantidad"];  
        $contadorprecio += $row["Precio"]; 
        $preciototal += ($contadorcantidad * $contadorprecio);   
        $codproduct = $row["CodProduct"]; 

        $sqlProducto = "SELECT Stock, Activo FROM Productos WHERE CodProduct = $codproduct"; 
        $validarStock = $conn->query($sqlProducto); 

        if ($validarStock->num_rows > 0) {
            while($row = $validarStock->fetch_assoc()) {   
                $stock = $row["Stock"];  
                $activo = $row["Activo"];
               
                if ($contadorcantidad > $stock || $activo == 0 ) { 
                    header("location:sinstock.php");
                } else {
                    $StockProducto = ($stock - $contadorcantidad);
                    $restarstock = "UPDATE Productos SET Stock=$StockProducto WHERE CodProduct = $codproduct";   
                    $quitarstock = $conn->query($restarstock);   
                }
            }  
        } 

        $contadorcantidad = 0; 
        $contadorprecio = 0;
        $codproduct = 0; 
        $stock = 0;
    }  
} else {
}

if (!isset($_GET['sinstock.php'])) {
    
    $pedir = "INSERT INTO Pedidos (Fecha, Precio_Total, Cod_Estado, CodRes) VALUES 
        (NOW(), $preciototal, 1, $CodRes)"; 
    $pedido = $conn->query($pedir);  

    $sabercodped = "SELECT CodPed FROM Pedidos ORDER BY CodPed DESC LIMIT 1"; 
    $CodPed1 = $conn->query($sabercodped);     

    $CodPed = 0;

    if ($CodPed1->num_rows > 0) {
        while($row = $CodPed1->fetch_assoc()) { 
            $CodPed = $row["CodPed"]; 
        }
    }     

    $sqlCarrito = "SELECT * FROM Carrito WHERE CodRes = $CodRes"; 
    $result = $conn->query($sqlCarrito);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { 
            $CodProduct = $row["CodProduct"]; 
            $Unidades = $row["Cantidad"];

            $PedProd = "INSERT INTO PedidosProductos (CodPed, CodProduct, Unidades) 
                VALUES ($CodPed, $CodProduct, $Unidades)";  
            $PedPro = $conn->query($PedProd);  
        } 
    }

    $borrado = "DELETE FROM Carrito WHERE CodRes = $CodRes";  
    $deleteado = $conn->query($borrado);  

    echo  "<div class='card'>";
    echo "<div class='card-inner'>";
    echo "<div class='card-front'>";
    echo "<p>Pedido Realizado con Éxito</p>";
    echo "</div>";
    echo "<div class='card-back'>";
    echo "<p>Consulta el estado de tu pedido<br> en la seccion de pedidos</p>";
    echo "</div>";
    echo "</div>";
    echo "</div>"; 

    echo "<br>";

    echo "<p><a href='menu.php'>Ver menú</a></p>"; 
    echo "<p><a href='categoriascliente.php'>Categorías</a></p>"; 
    echo "<p><a href='pedidomenucliente.php'>Pedidos</a></p>"; 
}
?>
</body>
</html>