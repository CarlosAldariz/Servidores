<!DOCTYPE html>
<html lang="en">
<head> 
<link rel="icon" type="image/x-icon" href="css/anadir-a-la-cesta.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    <link rel="stylesheet" href="css/tablasbotonesadmion.css">  
    <style> 
        a {
    color:white; 
        } 
        a:hover { 
  color:yellow;
 } 

 label { 
  color:yellow;
 }
 </style>
</head> 
<body> 
 <form action="crearcategoriaback.php" method="post">
 <p> <label for="usuario">Nombre</label>
  <input type="text" name="Nombre" placeholder="Nombre"> </p>

 <p> <label for="Descripcion">Descripcion</label>
  <input type="text" name="Descripcion" placeholder="Descripcion"> </p> 

  <p>  <button type="submit" value="crear categoria" placeholder="crear">Crear Categoría</button>  </p> 

    </form>

  <a href="categoriasadmin.php">Mostrar Categorias</a> <br> <br>   

  <a href="menuadmin.php">Volver ao Menu</a>   

</body> 
</html>