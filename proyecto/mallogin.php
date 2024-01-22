<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Fallido</title> 
    <link rel="stylesheet" href="css/master.css">
</head>

<body> 
    <!-- PAXINA CREADA PARA OS LOGINS MAL REALIZADOS -->
    <div class="caixa">
        <h1> Login Fallido</h1>
        <form action="loginback.php" method="post">
            <label for="usuario">Nombre</label>
            <input type="text" name="usuario" placeholder="usuario">

            <label for="contrasinal">contrasinal</label>
            <input type="password" name="password" placeholder="contrasinal">

            <input type="submit" value="entrar"> 

            <a href="#"> Non recordas o contrasinal? </a> 


        </form>
    </div>
</body>

</html> 
