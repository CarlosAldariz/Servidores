<?php 

session_start(); 
    if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && $_SESSION["Cod_Rol"] == 2 ){
       
        } else { 
        header("location:mallogin.php");
        }    

$conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Productos bdd
function insertarProductos($conn, $productos) {
    foreach ($productos as $producto) {
        $nombre = $producto['Nombre'];
        $descripcion = $producto['Descripcion'];
        $peso = $producto['Peso'];
        $stock = $producto['Stock'];
        $codCat = $producto['CodCat'];
        $precio = $producto['Precio'];
        $activo = $producto['Activo'];

        $sql = "INSERT INTO Productos (Nombre, Descripcion, Peso, Stock, CodCat, Precio, Activo) 
                VALUES ('$nombre', '$descripcion', '$peso', '$stock', '$codCat', '$precio', '$activo')";
        if ($conn->query($sql) === TRUE) {
            echo "Producto '$nombre' insertado exitosamente.<br>";
        } else {
            echo "Error al insertar producto: " . $conn->error . "<br>";
        }
    }
}

// JSON
if(isset($_POST['submit_json'])) {
    $json_file = $_FILES['json_file']['tmp_name'];
    $json_data = file_get_contents($json_file);
    $decoded_data = json_decode($json_data, true);

    insertarProductos($conn, $decoded_data['productos']);
    echo "Archivo JSON cargado exitosamente.";
}

// XML
if(isset($_POST['submit_xml'])) {
    if ($_FILES['xml_file']['error'] === UPLOAD_ERR_OK) {
        $xml_file = $_FILES['xml_file']['tmp_name'];
        $xml_data = simplexml_load_file($xml_file);  

        if ($xml_data) {
            foreach ($xml_data->producto as $producto) {
                $nombre = $producto->nombre;
                $descripcion = $producto->descripcion;
                $peso = $producto->peso;
                $stock = $producto->stock;
                $codCat = $producto->codCat;
                $precio = $producto->precio;
                $activo = $producto->activo;

                // producto & bdd
                $sql = "INSERT INTO Productos (Nombre, Descripcion, Peso, Stock, CodCat, Precio, Activo) 
                        VALUES ('$nombre', '$descripcion', '$peso', '$stock', '$codCat', '$precio', '$activo')";
                if ($conn->query($sql) === TRUE) {
                    echo "Producto '$nombre' insertado exitosamente.<br>";
                } else {
                    echo "Error al insertar producto: " . $conn->error . "<br>";
                }
            }
            echo "Archivo XML cargado exitosamente.";
        } else {
            echo "Error al cargar el archivo XML.";
        }
    } else {
        echo "Error al cargar el archivo XML: " . $_FILES['xml_file']['error'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head> 
<link rel="icon" type="image/x-icon" href="css/anadir-a-la-cesta.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir archivos JSON y XML</title> 
    <link rel="stylesheet" href="css/pedidorealizado.css">  
    <link rel="stylesheet" href="css/inputneon.css">  
    <style>
    h3, h2 {
        color:yellow;
    } 
    </style>
</head>
<body>
    <h2>Subir archivo JSON Productos</h2>
    <div>
        <h3>Subir archivo JSON para Productos</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="json_file" accept=".json">
            <button type="submit" name="submit_json">Subir JSON de Productos</button>
        </form>
    </div>

    <h2>Subir archivo XML para Productos</h2>
    <div>
        <h3>Subir archivo XML para Productos</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="xml_file" accept=".xml">
            <button type="submit" name="submit_xml">Subir XML de Productos</button>
        </form>
    </div>
</body>
</html>