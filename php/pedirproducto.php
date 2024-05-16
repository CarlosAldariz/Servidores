<!DOCTYPE html>
<html lang="en">
<head> 
<link rel="icon" type="image/x-icon" href="css/anadir-a-la-cesta.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <link rel="stylesheet" href="css/tablasbotonesadmion.css">  
    <style> 
    p { 
        color: blue;  
    }  
    a { 
        color:white;
    } 

    a:hover { 
        color:yellow;
    }

    input { 
    --glow-color: rgb(217, 176, 255);
    --glow-spread-color: rgba(191, 123, 255, 0.781);
    --enhanced-glow-color: rgb(231, 206, 255);
    --btn-color: rgb(100, 61, 136);
    border: .25em solid var(--glow-color);
    padding: 1em 3em;
    color: var(--glow-color);
    font-size: 15px;
    font-weight: bold;
    background-color: var(--btn-color);
    border-radius: 1em;
    outline: none;
    box-shadow: 0 0 1em .25em var(--glow-color),
           0 0 4em 1em var(--glow-spread-color),
           inset 0 0 .75em .25em var(--glow-color);
    text-shadow: 0 0 .5em var(--glow-color); 
    text-align: center;
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    } 

    .btn { 
        position: relative;
    left: 50%;
    transform: translateX(-50%); 
    }
    </style>
</head>
<body>
<?php
 session_start();  
      if(isset($_SESSION["usuario"]) && isset($_SESSION["password"])){ 
        
         } else {
             header("location:mallogin.php");
         } 
     ?> 

<?php 
    if (isset($_POST['CodProduct'])) { 
        $CodProduct = $_POST['CodProduct'];

    } else { 
        echo "esta vaina no va"; 
        header("location:categoriascliente.php");
    }; 

    $conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");

$sql = "SELECT * FROM Productos WHERE CodProduct = $CodProduct AND Activo = 1";

$result = mysqli_query($conn, $sql);   


    echo "<table class='container' >";  
 

    echo "<tr><th>Nombre</th><th>Descripcion</th><th>Precio</th><th>Stock</th></tr>";

  while ($row = $result->fetch_assoc()) { 

    
    echo "<tr>";

    echo "<td>".$row['Nombre']."</td>";

    echo "<td>".$row['Descripcion']."</td>";

    echo "<td>".$row['Precio']."</td>";

    echo "<td>".$row['Stock']."</td>";    

    $max = $row['Stock'];

    echo "</tr>"; 

    echo "</table>";

    echo "<form action='carrito.php' method='post'>"; 
                            if ($max == 0) {                           
                            
                            } else { 
                            echo "<h1><p>Selecciona cantidad</p></h1>";
                            echo "<input type='number' class='glow' name='Stock' value='1' min='0' max='$max' style='width: 50px;'>";    
                            };
                            echo "<input type='hidden' name='CodProduct' value='" . $CodProduct . "'>"; 
                            echo "<input type='hidden' name='Precio' value='" . $row['Precio'] . "'>"; 
                            echo "<input type='hidden' name='Nombre' value='" . $row['Nombre'] . "'>";
                            //conseguir y añadir un hidden con el codres usar $_SESSION['usuario']
                            echo "<input type='hidden' name='CodProduct' value='" . $row['CodProduct'] . "'><br>"; 
                            if ($max <= 0) { 
                                echo "el producto está sin Stock";
                            } else {
                            echo "<p><button type='submit' class='btn'>Añadir al carro</button></p>";  
                            };
                            echo "</form>"; 
                            echo "<p><a href='menu.php'>Ver menú</a></p>";  
                            echo "<p><a href='categoriascliente.php'>Ver categorías</a></p>"; 
} 
?>
</body>
</html>