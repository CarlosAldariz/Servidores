<?php
session_start();  

if(isset($_POST["usuario"]) && isset($_POST["password"])){
    $usuario = $_POST["usuario"]; 
    $password = $_POST["password"]; 
} else{ 
//si non vai ben msacache da aplicación
    header("mallogin.php");
} 


$sql = mysqli_connect("127.0.0.1", "root", "" , "pedidos");

//comprobar conexion
if (!$sql) {

die("Connection failed: " . mysqli_connect_error());
header("mallogin.php");
}

//sacar todos os datos da bdd do usuario mandado por post
$contr = "SELECT * FROM Restaurantes WHERE Nombre = '$usuario'";
$result = mysqli_query($sql, $contr);
$row = mysqli_fetch_array($result); 

if ($row['Nombre'] == $usuario && password_verify($password, $row['Clave'])) {
   $admintry = $row['Cod_Rol']; 
   $activo = $row['Activo'];
   $_SESSION["usuario"] = $usuario; 
   $_SESSION["password"] = $password; 
   $_SESSION["Cod_Rol"] = $adminrol; 
   $_SESSION["Activo"] = $activo;
   
   //se o estado activo é true e dependendo do rol levanos a un menu ou outro (administrador ou usuario)
   if ($activo) {
       if ($adminrol == 2) {
           header("Location: menuadmin.php");
           exit();
       } else {
           header("Location: menu.php");
           exit();
       }
   } else {
       header("Location: mallogin.php");
       exit();
   }
} else {
   header("Location: mallogin.php");
   exit();
}
?> 