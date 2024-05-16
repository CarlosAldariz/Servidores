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
    </style>
</head>
<body>
<?php 
    session_start(); 
    if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && $_SESSION["Cod_Rol"] == 2 ){
       
        } else { 
        header("location:mallogin.php");
        }    

       $conn = mysqli_connect("127.0.0.1", "root", "" , "pedidos");  

        $query = "SELECT * FROM Pedidos"; 
        $result = $conn->query($query);

// Verificar si se encontraron registros
if ($result->num_rows > 0) {
    // Crear la tabla HTML para mostrar los resultados
    echo "<table class='container'> 
    <br>
            <tr>
                <th><h1>CodPed</h1></th>
                <th><h1>Fecha</h1></th>
                <th><h1>Precio Total</h1></th>
                <th><h1>Estado Pedido</h1></th>
                <th><h1>Usuario</h1></th> 
                <th><h1>Cambiar Estado </h1></th>
            </tr>";
    //hacer una consulta para sacar el res mediante el CodRes
    // Recorrer los resultados y mostrarlos en la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["CodPed"] . "</td>
                <td>" . $row["Fecha"] . "</td>
                <td>" . $row["Precio_Total"] . "</td>";
                if ($row["Cod_Estado"] == 1) { 
                    echo "<td> Enviado </td>";
                } else if ($row["Cod_Estado"] == 2) { 
                    echo "<td> Entregado </td>"; 
                } else if ($row["Cod_Estado"] == 3) { 
                    echo "<td> Cancelado </td>";
                }   
                    echo "<td>".$row["CodRes"] . "</td>";
                // echo "<td>" . $row["CodRes"] . "</td>";

            //      $consultaNome = "SELECT Nombre From Restaurantes WHERE CodRes=$CodRes"; 
            //      $result1 = $conn->query($consultaNome); 
            //      while ($linea = $result1->fetch_assoc()) {
            //   echo  "<td>" . $linea["Nombre"] . "</td>  
            echo "<form method='POST' action='estadoenviado.php'><input type='hidden' name='CodPed' value='" . ($row["CodPed"]) . "'><td><button type='submit'>Enviado</button></td></form>"; 
            echo "<form method='POST' action='estadoentregado.php'><input type='hidden' name='CodPed' value='" . ($row["CodPed"]) . "'><td><button type='submit'>Entregado</button></td></form>"; 
            echo "<form method='POST' action='estadocancelado.php'><input type='hidden' name='CodPed' value='" . ($row["CodPed"]) . "'><td><button type='submit'>Cancelado</button></td></form>"; 
            echo "<form method='POST' action='estadoborrado.php'><input type='hidden' name='CodPed' value='" . ($row["CodPed"]) . "'><td><button type='submit'>Borrar</button></td></form>"; 
            echo "<form method='POST' action='estadodetalles.php'><input type='hidden' name='CodPed' value='" . ($row["CodPed"]) . "'><td><button type='submit'>Detalles</button></td></form>";  
            echo "</tr>"; 
                } } 


    echo "</table>"; 

    echo "<a href='menuadmin.php'>Volver al menu</a>";

?>
</body>
</html>