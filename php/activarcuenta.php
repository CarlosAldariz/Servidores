<?php
session_start(); 
    if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && $_SESSION["Cod_Rol"] == 2 ){
       
        } else { 
        header("location:mallogin.php");
        }    

       if (isset($_POST["CodRes"])) { 
        $CodRes = $_POST["CodRes"]; 
       } else { 
        echo "no mandas nada";
       } 
       print_r($CodRes);
       $con = mysqli_connect("127.0.0.1", "root", "" , "pedidos");
        $query = "SELECT * FROM Restaurantes";

        $resultado = mysqli_query($con, $query); 
     
        $row = mysqli_fetch_array($resultado); 
        
        $sql = "UPDATE Restaurantes SET Activo = TRUE WHERE CodRes = $CodRes";

if ($con->query($sql) === TRUE) {
     echo "El estado de 'Activo' se ha actualizado correctamente.";
} else {
     echo "Error al actualizar el estado de 'Activo': " . $con->error;
} 



header("Location:activarclientes.php");

        
        ?> 