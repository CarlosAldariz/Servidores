<?php
session_start();
if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && $_SESSION["Cod_Rol"] == 2 ){
       
} else { 
    header("location:mallogin.php");
}

if (isset($_POST['CodProduct']) && isset($_POST['CodCat'])) { 
    $CodProduct = $_POST['CodProduct'];
    $CodCat = $_POST['CodCat'];
} else { 
    echo "esta vaina no va";
    exit; 
}

$conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");


$sqlCheck = "SELECT COUNT(*) AS total FROM PedidosProductos WHERE CodProduct = $CodProduct";
$resultCheck = mysqli_query($conn, $sqlCheck);
$rowCheck = mysqli_fetch_assoc($resultCheck);
$totalPedidos = $rowCheck['total'];

if ($totalPedidos > 0) {
    echo "<h2>No puedes borrar el producto porque está asignado a $totalPedidos pedidos</h2>";
} else {
    
    $sql = "DELETE FROM productos WHERE CodProduct = $CodProduct";
    $result = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        header("location:productosadmin.php?CodCat=$CodCat");
    } else {
        echo "<h2>No se encontró el producto para borrar</h2>";
    }
}

?>
