<?php
session_start();
if (!isset($_SESSION["usuario"]) || !isset($_SESSION["password"]) || $_SESSION["Cod_Rol"] != 2) {
    header("location:mallogin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $CodCat = $_POST['CodCat'] ?? '';
    $Nombre = $_POST['Nombre'] ?? '';
    $Descripcion = $_POST['Descripcion'] ?? '';
    $Peso = $_POST['Peso'] ?? '';
    $Stock = $_POST['Stock'] ?? '';
    $Precio = $_POST['Precio'] ?? '';

    // Validar los datos recibidos
    if (empty($CodCat) || empty($Nombre) || empty($Descripcion) || empty($Peso) || empty($Stock) || empty($Precio)) {
        echo "Por favor, completa todos los campos.";
    } elseif (!is_numeric($Peso) || $Peso <= 0 || !is_numeric($Stock) || $Stock <= 0 || !is_numeric($Precio) || $Precio <= 0) {
        echo "Los campos de Peso, Stock y Precio deben ser numéricos y positivos.";
    } else {
        // Conexión a la base de datos
        $conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");
        if (mysqli_connect_errno()) {
            echo "Error al conectar con la base de datos: " . mysqli_connect_error();
            exit();
        }

        // Preparar la consulta SQL
        $sql = "INSERT INTO Productos (Nombre, Descripcion, Stock, CodCat, Precio, Activo) VALUES 
                ('$Nombre', '$Descripcion', '$Stock', '$CodCat', '$Precio', 'true')";

        // Ejecutar la consulta
        $result = mysqli_query($conn, $sql);

        // Comprobar si la consulta fue exitosa
        if ($result) {
            echo "Producto creado correctamente.";
            header("Location: categoriasadmin.php");
            exit();
        } else {
            echo "Error al crear el producto: " . mysqli_error($conn);
        }

        // Cerrar la conexión
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion clientes admin</title> 
    <link rel="stylesheet" href="css/pedidorealizado.css">  
    <link rel="stylesheet" href="css/inputneon.css"> 
    <style> 
    p {
        color: white;
    } 
    legend { 
        color: white;
    }
    </style>
</head>
<body>
<form action="crearproducto.php" method="post">
    <input type="hidden" name="CodCat" value="<?php echo $_POST['CodCat'] ?? ''; ?>">
    <p>
        <label for="Nombre">Nombre</label>
        <input type="text" name="Nombre" placeholder="Nombre" required>
    </p>
    <p>
        <label for="Descripcion">Descripcion</label>
        <input type="text" name="Descripcion" placeholder="Descripcion" required>
    </p>
    <p>
        <label for="Peso">Peso</label>
        <input type="number" name="Peso" placeholder="Peso" required>
    </p>
    <p>
        <label for="Stock">Stock</label>
        <input type="number" name="Stock" placeholder="Stock" required>
    </p>
    <p>
        <label for="Precio">Precio</label>
        <input type="number" name="Precio" placeholder="Precio" required>
    </p>
    
    <button type="submit">Crear Producto Nuevo</button>
</form>

</body> 
</html>