<!DOCTYPE html>
<html lang="en">
<head> 
<link rel="icon" type="image/x-icon" href="css/anadir-a-la-cesta.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <link rel="stylesheet" href="css/pedidorealizado.css">  
    <link rel="stylesheet" href="css/inputneon.css"> 
    <style> 
    p {
        color: white;
    } 
    label { 
        color:yellow;
    }
    </style>
</head>
<body> 
    <?php   
    error_reporting(0);
    session_start(); 
    if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && $_SESSION["Cod_Rol"] == 2 ){
       
         } else { 
        header("location:mallogin.php");
        }    
    if (isset($_POST["CodCat"])) { 
        $CodCat = $_POST["CodCat"];
    } else { 
        header("location:categoriasadmin.php");
    }
    ?>
<form action="editarcategoria.php" method="post">
           <p> <label for="Nombre">Nombre: </label>
            <input type="text" class="input" name="Nombre" placeholder="Nombre" required> </p>

          <p>  <label for="Descripcion">Descripcion: </label> 
            <input type="text" class="input" name="Descripcion" placeholder="Descripcion" required> </p> 
            
    <?php  

            echo "<input type='hidden' name='CodCat' value='" . $CodCat . "'>"; 

            echo "<button>Editar</button>";
            ?> 

            <?php 
    if (isset($_POST["CodCat"]) && isset($_POST["Nombre"]) && isset($_POST["Descripcion"])) { 
        $CodCat = $_POST["CodCat"]; 
        $Nombre = $_POST["Nombre"]; 
        $Descripcion = $_POST["Descripcion"];
    

    $conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");

    $sql = "UPDATE Categorias SET Nombre = '$Nombre', Descripcion = '$Descripcion' WHERE CodCat = $CodCat";
    
    $result = mysqli_query($conn, $sql); 

    if ($conn->query($sql) === TRUE) {
        echo "ou vai";
   } else {
        echo "ou non vai" . $con->error;
   } 
   
   // Cerrar la conexión
   $conn->close(); 
    
    header("location:categoriasadmin.php"); 

    }

        ?>
</body>
</html> 

