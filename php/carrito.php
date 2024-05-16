<!DOCTYPE html>
<html lang="en">
<head> 
<link rel="icon" type="image/x-icon" href="css/anadir-a-la-cesta.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de la compra</title> 
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
error_reporting(0);
if(isset($_SESSION["usuario"]) && isset($_SESSION["password"])) {  
} else {
    header("location:mallogin.php");
} 

$nameusu = $_SESSION["usuario"]; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['CodProduct']) && isset($_POST['Stock'])) {
        $CodProduct = $_POST['CodProduct'];
        $Stock = $_POST['Stock'];
        $Nombre = $_POST['Nombre']; 
        $Precio = $_POST['Precio'];
        $conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");
    
        if (!$conn) {
            echo "Error al conectar a la base de datos: " . mysqli_connect_error();
            exit;
        }  

        $sqlcodres = "SELECT CodRes FROM Restaurantes WHERE Nombre = '$nameusu'"; 

        $resultado = mysqli_query($conn, $sqlcodres);

        if ($resultado) {
            // que devolva mas de un resultado
            if (mysqli_num_rows($resultado) > 0) {

                $fila = mysqli_fetch_assoc($resultado);
                
                $CodRes = $fila['CodRes'];
            } else {
                // No se encontraron resultados
                $CodRes = null; 
            } 
        }   

        $comprobanome = "SELECT Cantidad FROM Carrito WHERE Nombre='$Nombre' AND CodRes=$CodRes";  

        $resultado2 = mysqli_query($conn, $comprobanome); 

        if ($resultado2) {
            
            if (mysqli_num_rows($resultado2) > 0) {
                
                $linea = mysqli_fetch_assoc($resultado2);  

                $cantidad = $linea['Cantidad'];  

               
                $total = $cantidad + $Stock;
                $sql = "UPDATE Carrito SET Cantidad = $total WHERE Nombre='$Nombre' AND CodRes=$CodRes";  

            } else {
                $sql = "INSERT INTO Carrito (CodProduct, CodRes, Nombre, Precio, Cantidad)  
                VALUES ('$CodProduct', '$CodRes', '$Nombre', '$Precio', '$Stock')"; 
            } 

            mysqli_query($conn, $sql);

            $sql1 = "SELECT * FROM Carrito WHERE CodRes = '$CodRes'";

            $result1 = $conn->query($sql1);

            if ($result1->num_rows > 0) {
                // Mostrar los datos de cada fila  
                echo "<form action='borrarcarrito.php' method='post'>"; 
                echo "<table class='container'>"; 
                echo "<tr><th>Precio Unidad</th><th>Cantidad</th><th>Nombre</th><th></th></tr>";
                while ($linea = $result1->fetch_assoc()) {
                    $CodRes = $linea["CodRes"];
                    echo "<tr>"; 
                    echo "<td>" . $linea["Precio"] . "</td>";
                    echo "<td>" . $linea["Cantidad"] . "</td>";
                    echo "<td>" . $linea["Nombre"] . "</td>"; 
                    echo "<td>";
                    echo "<input type='hidden' name='CodCarr' value='" . $linea['CodCarr'] . "'>";
                    echo "<button type='submit'>Eliminar Producto</button>";    
                    echo "</td>";        
                    echo "</tr>"; 
                }
                echo "</table>";
                echo "</form>";
            }
        }
    } else {
        echo "Método de solicitud no válido.";
    }

    echo "<form action='pedidocliente.php' method='post'>";  
    echo "<p>"; 
    echo "<input type='hidden' name='Precio' value='" . $linea['CodProduct'] . "'>";   
    echo "<input type='hidden' name='Precio' value='" . $linea['Precio'] . "'>";   
    echo "<input type='hidden' name='Cantidad' value='" . $linea['Cantidad'] . "'>";  
    echo "<button type='submit' class='btn'>Realizar Pedido</button>";    
    echo " </p>";
    echo "</form>";  
    echo "</table>";
    

    echo "<p><a href='menu.php'>Ver menú</a></p>";  
    echo "<p><a href='categoriascliente.php'>Ver categorías</a></p>";  
} else { 
    $conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");  

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

    $sql1 = "SELECT * FROM Carrito WHERE CodRes = '$CodRes'";

    $result1 = $conn->query($sql1);

    if ($result1->num_rows > 0) {
        // Mostrar los datos de cada fila  
        echo "<table class='container'>"; 
        echo "<tr><th>Precio Unidad</th><th>Cantidad</th><th>Nombre</th><th></th><th></th></tr>";
    
        while ($linea = $result1->fetch_assoc()) {
            $CodRes = $linea["CodRes"];
            echo "<tr>";
            echo "<td>" . $linea["Precio"] . "</td>";
            echo "<td>" . $linea["Cantidad"] . "</td>";
            echo "<td>" . $linea["Nombre"] . "</td>"; 
            
            echo "<td>";
            echo "<form action='borrarcarrito.php' method='post'>"; 
            echo "<input type='hidden' name='CodCarr' value='" . $linea['CodCarr'] . "'>";
            echo "<button type='submit'>Eliminar Producto</button>";    
            echo "</form>"; 
            echo "</td>";
            
            echo "</tr>"; 
        }
    
      //  echo "</table>"; 

        echo "<form action='pedidocliente.php' method='post'>"; 
            echo "<input type='hidden' name='Precio' value='" . $linea['Precio'] . "'>";   
            echo "<input type='hidden' name='Cantidad' value='" . $linea['Cantidad'] . "'>";  
            echo "<button type='submit'>Realizar Pedido</button>";    
            echo "</form>";  

       // }
    }
    echo "</table>"; 
    echo "<p><a href='menu.php'>Ver menú</a></p>";  
    echo "<p><a href='categoriascliente.php'>Ver categorías</a></p>";  
} 
if ($result1->num_rows < 0) {
    echo "El carrito está vacío";
} 
?>

</body>
</html>
