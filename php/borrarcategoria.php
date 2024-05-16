<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <link rel="stylesheet" href="css/pedidorealizado.css"> 
    <style>
    h2 { 
        color: yellow;
    }
    </style>
</head>
<body>
<?php  

session_start(); 
    if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && $_SESSION["Cod_Rol"] == 2 ){
       
         } else { 
        header("location:mallogin.php");
        }    

if (isset($_POST['CodCat'])) { 
    $CodCat = ($_POST['CodCat']);
} else { 
    echo "non tes ningunha categoría seleccionada";  
    header("location:menuadmin.php");
}
    $conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");

    if (mysqli_connect_errno()) {
        echo "Error al conectar con la base de datos: " . mysqli_connect_error();
        exit(); 
        header("location:categoriasadmin.php");
    }

    // Verificar si la categoría tiene productos asociados
    $sqlProductos = "SELECT COUNT(*) AS TotalProductos FROM Productos WHERE CodCat = $CodCat";
    $resultProductos = mysqli_query($conn, $sqlProductos);
    $rowProductos = mysqli_fetch_assoc($resultProductos);
    $totalProductos = $rowProductos["TotalProductos"];

    if ($totalProductos > 0) {
        echo "<h2>No se puede borrar la categoría porque tiene productos asociados.</h2>"; 
       echo "<a href='categoriasadmin.php'>Mostrar Categorías</a><br>";
    } else {
        // Borrar la categoría si no tiene productos asociados
        $sqlBorrar = "DELETE FROM Categorias WHERE CodCat = $CodCat";
        $resultBorrar = mysqli_query($conn, $sqlBorrar);

        if ($resultBorrar) {
            echo "Categoría borrada correctamente."; 
            header("location:categoriasadmin.php");
        } else {
            echo "Error al borrar la categoría: " . mysqli_error($conn);  
            echo "<a href='categoriasadmin.php'>Mostrar Categorías</a><br>";
        }
    }

    mysqli_close($conn);
?> 

    
</body>
</html>