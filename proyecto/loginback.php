<?php
//Paxina creada para filtrar o Logion e comprobar se é válido
session_start(); 
//comprobamos que se pasen parametros
if(isset($_POST["usuario"]) && isset($_POST["password"])){
    $usuario = $_POST["usuario"]; 
    $password = $_POST["password"]; 
} else{ 
//en caso de que non se manden volvemos o login
    header("mallogin.php");
} 

//conectamonos a base de datos
$sql = mysqli_connect("127.0.0.1", "root", "" , "pedidos");

//comprobamos que a conexión é correcta
if (!$sql) {

die("Connection failed: " . mysqli_connect_error());
header("mallogin.php");

}

echo "Connected successfully"; 

//comprobamos que a clave é correcta 
//mediante a busqueda e comprobacion do usuario na bdd
$contr = "SELECT Clave FROM Restaurantes WHERE Nombre = '$usuario'"; 

$result = mysqli_query($sql, $contr);

$row = mysqli_fetch_array($result);
//aqui falta un filtro que nos redirixa en caso de admin 
//teria un header con menuadmin(ainda non creado)!!!!!!!!!!!!!!
$i = 0;
do {
    //se a clave coincide, redirixenos o menu 
    //se a clave non coincide levanos a paxina de login fallido
    if ($password == $row['Clave']) { 
        header("location:menu.php"); 
    } else { 
        header("location:mallogin.php");
    }
    $i++;
} while ($i < 5);
?>