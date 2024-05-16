<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto del Carrito</title>
</head>
<body>
<?php
session_start();

// Verificar si el usuario está autenticado
if(!isset($_SESSION["usuario"]) || !isset($_SESSION["password"])) {
    header("location: mallogin.php");
    exit; // Detener la ejecución del script
}

// Verificar si se envió un ID de producto para eliminar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['CodCarr'])) {
    // Obtener el ID del producto a eliminar del formulario
    $CodCarr = $_POST['CodCarr'];

    // Conectar a la base de datos
    $conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");
    if (!$conn) {
        echo "Error al conectar a la base de datos: " . mysqli_connect_error();
        exit;
    }

    // Consulta para eliminar el producto del carrito
    $sql = "DELETE FROM Carrito WHERE CodCarr = '$CodCarr'";
    
    // Ejecutar la consulta
    $resultado = mysqli_query($conn, $sql);

    // Verificar si la consulta se ejecutó correctamente
    if ($resultado) {
        // Redireccionar de vuelta al menú después de eliminar el producto
        header("location: carrito.php");
        exit; // Detener la ejecución del script después de redireccionar
    } else {
        echo "Error al eliminar el producto del carrito: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no se envió un ID de producto válido, mostrar un mensaje de error
    echo "ID de producto no válido";
}
?>
</body>
</html>