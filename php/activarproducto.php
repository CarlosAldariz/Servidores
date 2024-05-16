<?php 
session_start(); 
if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && $_SESSION["Cod_Rol"] == 2 ){
       
         } else { 
        header("location:mallogin.php");
       }    

       if (isset($_POST['CodProduct']) && isset($_POST['CodCat'])) { 
        $CodProduct = $_POST['CodProduct']; 
        $CodCat = $_POST['CodCat'];
    } else { 
        echo "esta vaina no va";
    }; 

    $conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");

$sql = "UPDATE productos SET Activo = 1 WHERE CodProduct = $CodProduct";

$result = mysqli_query($conn, $sql); 

header("location:productosadmin.php?CodCat=$CodCat");

?>