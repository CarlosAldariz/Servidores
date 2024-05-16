<?php 
session_start(); 
if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && $_SESSION["Cod_Rol"] == 2 ) {
} else { 
    header("location:mallogin.php");
}

if (isset($_POST["CodRes"])) { 
    $CodRes = $_POST["CodRes"];  
} else { 
    echo "No se envió ningún código de restaurante";
    exit; 
}  

$con = mysqli_connect("127.0.0.1", "root", "", "pedidos");

// Verificar si la cuenta de restaurante está asociada a algún pedido
$sqlCheck = "SELECT COUNT(*) AS total FROM Pedidos WHERE CodRes = $CodRes";
$resultCheck = mysqli_query($con, $sqlCheck);
$rowCheck = mysqli_fetch_assoc($resultCheck);
$totalPedidos = $rowCheck['total'];

if ($totalPedidos > 0) {
    echo "<h1>No es posible borrar la cuenta pues tiene asociada un pedido</h1>";
} else {
    if ($CodRes != 3) {
        $sql = "DELETE FROM Restaurantes WHERE CodRes = $CodRes";

        if ($con->query($sql) === TRUE) {
            echo "El restaurante se ha eliminado correctamente.";
        } else {
            echo "Error al eliminar el restaurante: " . $con->error;
        } 

        $sql1 = "DELETE FROM carrito WHERE CodRes = $CodRes";

        if ($con->query($sql1) === TRUE) {
            echo "El restaurante se ha eliminado correctamente.";
        } else {
            echo "Error al eliminar el restaurante: " . $con->error;
        } 

        // Cerrar la conexión
        $con->close(); 

       header("Location: activarclientes.php");
    } else {
        echo "No puedes borrar el root";
    }
}
?>
