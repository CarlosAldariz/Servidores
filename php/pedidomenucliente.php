<!DOCTYPE html>
<html lang="en">
<head> 
<link rel="icon" type="image/x-icon" href="css/anadir-a-la-cesta.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <link rel="stylesheet" href="css/tablasbotonesadmion.css">  
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
    // Verificar si se devolvió al menos un resultado
    if (mysqli_num_rows($resultado) > 0) {
        // Obtener el primer resultado como un arreglo asociativo
        $fila = mysqli_fetch_assoc($resultado);
        // Guardar el valor del campo 'CodRes' en $CodRes
        $CodRes = $fila['CodRes']; 
    } else {
        // No se encontraron resultados
        $CodRes = null; // Opcionalmente puedes asignar un valor por defecto 
    } 
}     

    $MostrarPedido = "SELECT * FROM Pedidos WHERE CodRes = $CodRes";

    $result = mysqli_query($conn, $MostrarPedido); 

    
    if (mysqli_num_rows($result) > 0) {

    // Generas la tabla con la información de los productos  

    echo "<p class='glow'> historial de pedidos </p>";
    
    echo "<table class='container'>";
    
    echo "<tr><th>Codigo</th><th>Fecha</th><th>Precio Total</th><th>Estado</th></tr>"; 
    
    while ($row = $result->fetch_assoc()) { 
    
        echo "<tr>";
    
        echo "<td>".$row['CodPed']."</td>";
    
        echo "<td>".$row['Fecha']."</td>";
    
        echo "<td>".$row['Precio_Total']."</td>";
            if ($row['Cod_Estado'] == 1) {
        echo "<td> Enviado </td>"; 
            } else if ($row['Cod_Estado'] == 2) { 
                echo "<td> Entregado </td>";         
            } else if ($row['Cod_Estado'] == 3) { 
                echo "<td> Cancelado </td>";
            }
            echo "<form method='POST' action='estadodetalles.php'><input type='hidden' name='CodPed' value='" . ($row["CodPed"]) . "'><td><button type='submit'>Detalles</button></td></form>";  
        echo "</tr>";
    
    }
    
    echo "</table>";  
} else { 
    echo "Non se realizou ningún pedido";
}
    
    echo "<p><a href='menu.php'>Ver menú</a></p>"; 
    
    echo "<p><a href='categoriascliente.php'>Categorías</a></p>"; 
    ?> 

</body>
</html>