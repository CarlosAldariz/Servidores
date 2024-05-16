<!DOCTYPE html>
<html lang="en">
<head> 
<link rel="icon" type="image/x-icon" href="css/anadir-a-la-cesta.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <link rel="stylesheet" href="css/tablasbotonesadmion.css">  
</head> 
<style> 
a { 
    position: relative;
    left: 40%;
    transform: translateX(-50%); 
    color:greenyellow;
} 
a:hover { 
    color:yellow;
} 
button { 
    position: relative;
    left: 50%;
    transform: translateX(-50%); 
}
</style>
<body>
<?php 
    session_start();  
    if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && ($_SESSION["Cod_Rol"] == 2)){
       
        } else { 
         header("location:mallogin.php");
        }    
       $con = mysqli_connect("127.0.0.1", "root", "" , "pedidos");
        $query = "SELECT * FROM Restaurantes";

        $resultado = mysqli_query($con, $query); 
     
        $row = mysqli_fetch_array($resultado); 
        ?> 

<h1>Datos de los clientes</h1> 
<a href="gestionclientes.php">Para crear un nuevo usuario haz click aquí</a>

<?php

$conn = new mysqli("127.0.0.1", "root", "", "pedidos");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los datos de la tabla Restaurantes
$query = "SELECT * FROM Restaurantes";
$result = $conn->query($query);

$contador = 0;

if ($result->num_rows > 0) {
    // Mostrar los datos en una tabla
    echo "<table class='container'>";
    echo "<tr><th>CodRes</th><th>Cod_Rol</th><th>Nombre</th><th>Pais</th><th>CP</th><th>Ciudad</th><th>Direccion</th><th>Activo</th></tr>";
    while ($row = $result->fetch_assoc()) { 
        // Si el nombre del usuario es "root", no mostrar los datos
        if ($row["Nombre"] != "root") {
            $CodRes = $row["CodRes"];  
            echo "<tr>";
            echo "<td>" . $row["CodRes"] . "</td>";
            //echo "<td>" . $row["Cod_Rol"] . "</td>"; 
            if ($row["Cod_Rol"] == 1) { 
                echo "<td> Cliente</td>";
            } else if ($row["Cod_Rol"] == 2) { 
                echo "<td> Administrador </td>";
            }
            echo "<td>" . $row["Nombre"] . "</td>";
            echo "<td>" . $row["Pais"] . "</td>";
            echo "<td>" . $row["CP"] . "</td>";
            echo "<td>" . $row["Ciudad"] . "</td>";
            echo "<td>" . $row["Direccion"] . "</td>";
            echo "<td>" . ($row["Activo"] ? "Activo" : "Inactivo") . "</td>"; 
            echo "<td>";
            echo "<form method='POST' action='desactivarcuenta.php'><input type='hidden' name='CodRes' value='" . ($row["CodRes"]) . "'><button type='submit'>Desactivar</button></form>"; 
            echo "<form method='POST' action='activarcuenta.php'><input type='hidden' name='CodRes' value='" . ($row["CodRes"]) . "'><button type='submit'>Activar</button></form>"; 
            echo "<form method='POST' action='borrarcuenta.php'><input type='hidden' name='CodRes' value='" . ($row["CodRes"]) . "'><button type='submit'>Borrar</button></form>"; 
            echo "<form method='POST' action='editarcuenta.php'><input type='hidden' name='CodRes' value='" . ($row["CodRes"]) . "'><button type='submit'>Editar</button></form>"; 
            echo "</form>";
            echo "</td>";
            echo "</tr>";  
        }
    }
    echo "</table>"; 
} else {
    echo "No hay datos en la tabla Restaurantes.";
}

$conn->close();
?> 
<p><a href="menuadmin.php">Volver ao Menu</a></p>
        
</body>
</html> 

