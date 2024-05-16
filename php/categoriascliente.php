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
      if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) ){ 
        
         } else {
             header("location:mallogin.php");
         } 
    ?> 

<table class="container">

<thead>

    <tr>

        <th>Nombre</th>

        <th>Descripción</th>

        <th>Acción</th>

    </tr>

</thead>

<tbody>

    <?php

    $con = mysqli_connect("127.0.0.1", "root", "", "pedidos");


    //comprobamos que a conexión é correcta

    if (!$con) {

        die("Connection failed: " . mysqli_connect_error());

    }

    $query = "SELECT * FROM Categorias WHERE Activo = true";

    $result = mysqli_query($con, $query);


    while ($row = mysqli_fetch_assoc($result)) { 


        echo "<tr>";

        echo "<td>" . htmlspecialchars($row["Nombre"]) . "</td>";

        echo "<td>" . htmlspecialchars($row["Descripcion"]) . "</td>";

        echo "<td><form method='post' action='productoscliente.php'><input type='hidden' name='CodCat' value='" . htmlspecialchars($row["CodCat"]) . "'><button type='submit' class='glow'>Entrar</button></form></td>";

        echo "</tr>";

    } 


    mysqli_close($con); 

    echo "<p><a href='menu.php'><button class='btn'>Ver Menu</button></a></p>"; 

    ?>

</tbody>

</table>
</body>
</html>