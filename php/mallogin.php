<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="icon" type="image/x-icon" href="css/anadir-a-la-cesta.ico">
    <title>Login Fallido</title> 
    <link rel="stylesheet" href="css/master.css"> 
    <link rel="stylesheet" href="css/boton.css">  
    <link rel="stylesheet" href="css/inputneon.css">
</head>

<body>  

<?php  
     session_start();  
    session_unset();
    session_destroy(); 
    ?> 
    <div class="caixa">
        <h1> Login Fallido</h1>
        <form action="loginback.php" method="post">
            <label for="usuario">Nombre</label>
            <input class="input" type="text" name="usuario" placeholder="usuario">

            <label for="password">contrasinal</label>
            <input class="input" type="password" name="password" placeholder="password">

            <button class="btn"> Entrar </button>


        </form>
    </div>
</body>

</html> 
