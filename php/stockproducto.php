<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Stock de Producto</title>
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
// Verificar si se recibió el parámetro CodProduct
if(isset($_POST['CodProduct'])) {
    // Sanitizar y obtener el valor de CodProduct
    $CodProduct = $_POST['CodProduct'];

    // Conectar a la base de datos
    $conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");

    // Verificar la conexión
    if (!$conn) {
        echo "Error al conectar a la base de datos: " . mysqli_connect_error();
        exit;
    }

    // Obtener información del producto
    $sql = "SELECT Nombre FROM Productos WHERE CodProduct = $CodProduct";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $nombreProducto = $row['Nombre'];

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Redireccionar a categoriasadmin.php si no se recibió el parámetro CodProduct
    header("location: categoriasadmin.php");
    exit;
}

// Verificar si se recibió el parámetro Stock
if(isset($_POST['Stock'])) {
    // Sanitizar y obtener los valores
    $Stock = $_POST['Stock'];

    // Conectar a la base de datos
    $conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");

    // Verificar la conexión
    if (!$conn) {
        echo "Error al conectar a la base de datos: " . mysqli_connect_error();
        exit;
    }

    // Actualizar el campo Stock en la tabla Productos
    $sql = "UPDATE Productos SET Stock = $Stock WHERE CodProduct = $CodProduct";

    if (mysqli_query($conn, $sql)) {
        // Redireccionar a productosadmin.php si la actualización fue exitosa
        header("location: productosadmin.php");
        exit;
    } else {
        echo "Error al actualizar el stock del producto: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
?>

<h1>Actualizar Stock de Producto</h1>
<p>Producto: <?php echo $nombreProducto; ?></p>
<form method="post" action="stockproducto.php">
    <input type="hidden" name="CodProduct" value="<?php echo $CodProduct; ?>">
    <label for="nuevoStock">Nuevo Stock:</label>
    <input type="number" class="glow" id="nuevoStock" name="Stock" required>
    <button type="submit">Actualizar Stock</button>
</form>

<p><a href="productosadmin.php">Volver a Productos</a></p>

</body>
</html>