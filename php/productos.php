<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> 
    <?php 
     if(isset($_SESSION["usuario"]) && isset($_SESSION["password"])){

       } else { 
           header("location:mallogin.php");
       } 
    if (isset($_GET['cod_ref'])) {
        $codRef = $_GET['cod_ref'];
    } 
    //bloqueo la entrada con el sesion start 
    //recibo el codref de la categoria para sacar los productos 
    
    ?>
</body>
</html>