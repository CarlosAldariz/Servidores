<?php  

session_start(); 
    if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && $_SESSION["Cod_Rol"] == 2 ){
       
         } else { 
        header("location:mallogin.php");
        }   

$conn = mysqli_connect("127.0.0.1", "root", "", "pedidos"); 

if (isset($_POST['Nombre']) && isset($_POST['Descripcion'])) { 
    $Nombre = $_POST['Nombre']; 
    $Descripcion = $_POST['Descripcion'];
}

$sql = "INSERT INTO Categorias (Nombre, Descripcion, Activo) VALUES 
('$Nombre', '$Descripcion', 'true')"; 

$result = mysqli_query($conn, $sql); 

header("location:categoriasadmin.php");

?>                                                              