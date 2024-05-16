<!DOCTYPE html>
<html lang="en">
<head> 
<link rel="icon" type="image/x-icon" href="css/anadir-a-la-cesta.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Admin</title> 
    <link rel="stylesheet" href=css/desplegables.css>
</head>
<body> 
    <?php 
    session_start(); 
    if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && $_SESSION["Cod_Rol"] == 2){
       
        } else { 
        header("location:mallogin.php");
        }    

       $con = mysqli_connect("127.0.0.1", "root", "" , "pedidos");  

        $query = "SELECT * FROM Restaurantes";

        $resultado = mysqli_query($con, $query); 
       
        $row = mysqli_fetch_array($resultado); 
        
        ?> 
        <ul class="menu">  
    <li><a href=pedidosadmin.php>Pedidos </a></li> 
        <li><a href=activarclientes.php>Gestión Clientes </a></li>  
        <li><a href="loginfrontal.php">Cerrar Sesion </a></li> 
        <li> <a href="subirarchivos.php">Subir archivos JSON o XML </a>
        <li><a href="categoriasadmin.php">Gestón Categorías</a>
            <ul>
       
</body>
</html>