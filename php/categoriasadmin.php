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
            position: relative;
    left: 50%;
    transform: translateX(-50%);  
    color:white; 
        } 
        a:hover { 
  color:yellow;
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
    ?> 

<table class='container'>

<thead>

    <tr>

        <th><h1>Nombre</h1></th>

        <th><h1>Descripción</h1></th>

        <th><h1>Activo</h1></th>

    </tr>

</thead>

<tbody>

    <?php

    $con = mysqli_connect("127.0.0.1", "root", "", "pedidos");


    //comprobamos que a conexión é correcta

    if (!$con) {

        die("Connection failed: " . mysqli_connect_error());

    }

    $query = "SELECT * FROM Categorias";

    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {  

        echo "<tr>";

        echo "<td>" . htmlspecialchars($row["Nombre"]) . "</td>";

        echo "<td>" . htmlspecialchars($row["Descripcion"]) . "</td>";  


        if (htmlspecialchars($row["Activo"]) == 1) { 
            echo "<td> Activo </td>"; 
        } else { 
            echo "<td> Desactivado </td>"; 
        }

        echo "<td><form method='post' action='productosadmin.php'><input type='hidden' name='CodCat' value='" . htmlspecialchars($row["CodCat"]) . "'><button type='submit'>Entrar</button></form></td>"; 

        echo "<td><form method='post' action='activarcategoria.php'><input type='hidden' name='CodCat' value='" . htmlspecialchars($row["CodCat"]) . "'><button type='submit'>Activar</button></form></td>"; 

        echo "<td><form method='post' action='desactivarcategoria.php'><input type='hidden' name='CodCat' value='" . htmlspecialchars($row["CodCat"]) . "'><button type='submit'>Desactivar</button></form></td>"; 

        echo "<td><form method='post' action='editarcategoria.php'><input type='hidden' name='CodCat' value='" . htmlspecialchars($row["CodCat"]) . "'><button type='submit'>Editar</button></form></td>";

        echo "<td><form method='post' action='borrarcategoria.php'><input type='hidden' name='CodCat' value='" . htmlspecialchars($row["CodCat"]) . "'><button type='submit'>Borrar</button></form></td>";

        echo "</tr>";

    }  

    echo "</table>";
    
    mysqli_close($con);

    ?> 

</tbody>

</table> 

<p><a href='menuadmin.php'>Ver menú</a></p>

<p><a href='crearcategoria.php'><button>Crear Categoria</button></a></p>

</body>
</html>