<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Frontal</title> 
    <link rel="stylesheet" href="css/master.css">
</head>

<body>
    <div class="caixa">
        <h1> Login </h1>
        <form action="loginback.php" method="post">
            <label for="usuario">Nombre</label>
            <input type="text" name="usuario" placeholder="usuario">

            <label for="contrasinal">contrasinal</label>
            <input type="password" name="password" placeholder="contrasinal">

            <input type="submit" value="entrar"> 

            <a href="#"> Non recordas o contrasinal? </a> 
            <!-- INSERTAR EN ESTE HREF UN ENLACE --> 
            <!-- SEGUN TEMPO, ENLACE QUE ENVIE CORREAO VIA E MAIL(NOS EXERCICIOS) --> 
            <!--  PAXINA GRACIOSA -->

        </form>
    </div>
</body>

</html> 
