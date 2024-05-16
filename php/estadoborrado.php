<?php
 session_start();
 if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && $_SESSION["Cod_Rol"] == 2 ){
     } else {
     header("location:mallogin.php");
 }

if (isset($_POST["CodPed"])) { 
    $CodPed = $_POST["CodPed"];
} else {
    header("location:pedidosadmin.php");
}

$conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");

// Verificar la conexión
if (!$conn) {
    echo "Error al conectar a la base de datos: " . mysqli_connect_error();
    exit;
}


$queryProductosPedido = "SELECT CodProduct, Unidades FROM PedidosProductos WHERE CodPed=$CodPed";
$resultProductosPedido = $conn->query($queryProductosPedido);

if ($resultProductosPedido->num_rows > 0) {
    while ($row = $resultProductosPedido->fetch_assoc()) {
        $CodProduct = $row['CodProduct'];
        $Unidades = $row['Unidades'];

        
        $queryActualizarStock = "UPDATE Productos SET Stock = Stock + $Unidades WHERE CodProduct = $CodProduct";
        $resultActualizarStock = $conn->query($queryActualizarStock);
        if (!$resultActualizarStock) {
            echo "Error al actualizar el stock del producto con CodProduct $CodProduct: " . mysqli_error($conn);
            exit;
        }
    }
}


$queryEliminarProductosPedido = "DELETE FROM PedidosProductos WHERE CodPed=$CodPed";
$resultEliminarProductosPedido = $conn->query($queryEliminarProductosPedido);
if (!$resultEliminarProductosPedido) {
    echo "Error al eliminar los productos asociados al pedido con CodPed $CodPed: " . mysqli_error($conn);
    exit;
}

$queryEliminarPedido = "DELETE FROM Pedidos WHERE CodPed=$CodPed";
$resultEliminarPedido = $conn->query($queryEliminarPedido);
if (!$resultEliminarPedido) {
    echo "Error al eliminar el pedido con CodPed $CodPed: " . mysqli_error($conn);
    exit;
}

header("location:pedidosadmin.php");


?>
