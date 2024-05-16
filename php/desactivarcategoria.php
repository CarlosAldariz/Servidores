<?php 
session_start(); 
    if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && $_SESSION["Cod_Rol"] == 2 ){
       
         } else { 
        header("location:mallogin.php");
        }    

       if (isset($_POST['CodCat'])) { 
        $CodCat = $_POST['CodCat'];

    } else { 
        echo "esta vaina no va";
    }; 

    $conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");

$sql = "UPDATE Categorias SET Activo = FALSE WHERE CodCat = $CodCat";

$result = mysqli_query($conn, $sql); 

header("location:categoriasadmin.php"); 
?>