<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  //error_reporting(E_ALL ^ E_WARNING);
  $con = mysqli_connect("127.0.0.1", "root", "", "pedidos");

  echo 'conexion ready';
  //comprobamos que a conexión é correcta
  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
    echo '<script>alert("No se ha podido acceder a la base de datos")<br></script>';
  }

  if (isset($_POST["Cod_Rol"]) && isset($_POST["Nombre"]) && isset($_POST["Clave"]) && isset($_POST["Pais"]) && isset($_POST["CP"]) && isset($_POST["Ciudad"]) && isset($_POST["Direccion"])) {
    $Cod_Rol = $_POST["Cod_Rol"];
    $Nombre = $_POST["Nombre"];
    $Clave = $_POST["Clave"];
    $Pais = $_POST["Pais"];
    $CP = $_POST["CP"];
    $Ciudad = $_POST["Ciudad"];
    $Direccion = $_POST["Direccion"];

    // Ciframos la contraseña
    $hashedClave = password_hash($Clave, PASSWORD_DEFAULT);
    
    // Consulta a la base de datos para insertar los datos
    $query = "INSERT INTO restaurantes (Cod_Rol, Nombre, Clave, Pais, CP, Ciudad, Direccion, Activo) VALUES ($Cod_Rol, '$Nombre', '$hashedClave', '$Pais', $CP, '$Ciudad', '$Direccion', TRUE)";

    $result = mysqli_query($con, $query);

    if ($result) {
      header("Location: activarclientes.php");
      exit();
    } else {
      header("Location: gestionclientes.php?campoFalta=true");
      exit();
    }
  }
  ?>


</body>

</html>