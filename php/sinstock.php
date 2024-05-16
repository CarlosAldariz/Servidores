<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>  
    <link rel="stylesheet" href="css/master.css">
    <style>  
    a {
        color: pink;
    }
    .card { 
    position: absolute;
  width: 190px;
  height: 254px;
  background-color: #000;
  display: flex;
  flex-direction: column;
  justify-content: end;
  padding: 12px;
  gap: 12px;
  border-radius: 8px;
  cursor: pointer;
  color: white; 
  top: 25%; 
  left: 40%;
}

.card::before {
  content: '';
  position: absolute;
  inset: 0;
  left: -5px;
  margin: auto;
  width: 200px;
  height: 264px;
  border-radius: 10px;
  background: linear-gradient(-45deg, #e81cff 0%, #40c9ff 100% );
  z-index: -10;
  pointer-events: none;
  transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.card::after {
  content: "";
  z-index: -1;
  position: absolute;
  inset: 0;
  background: linear-gradient(-45deg, #fc00ff 0%, #00dbde 100% );
  transform: translate3d(0, 0, 0) scale(0.95);
  filter: blur(20px);
}

.heading {
  font-size: 20px;
  text-transform: capitalize;
  font-weight: 700;
}

.card p:not(.heading) {
  font-size: 14px;
}

.card p:last-child {
  color: #e81cff;
  font-weight: 600;
}

.card:hover::after {
  filter: blur(30px);
}

.card:hover::before {
  transform: rotate(-90deg) scaleX(1.34) scaleY(0.77);
}

    </style>
</head> 
<body>  
    <?php 
    session_start();  
    if(isset($_SESSION["usuario"]) && isset($_SESSION["password"])){  
  
      $nameusu = $_SESSION["usuario"];
      
       } else {
           header("location:mallogin.php");
       }  
       $conn = mysqli_connect("127.0.0.1", "root", "", "pedidos");


if (!$conn) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

$sql = "SELECT MAX(CodPed) AS UltimoPedido FROM Pedidos";


$resultado = mysqli_query($conn, $sql); 


if ($resultado) {
   
    $fila = mysqli_fetch_assoc($resultado);
    $ultimoPedido = $fila['UltimoPedido']; 
 
    $queryEliminarProductosPedido = "DELETE FROM PedidosProductos WHERE CodPed=$ultimoPedido";
    $resultEliminarProductosPedido = $conn->query($queryEliminarProductosPedido);
    if (!$resultEliminarProductosPedido) {
        echo "Error al eliminar los productos asociados al pedido con CodPed $CodPed: " . mysqli_error($conn);
        exit;
    }
    
    $queryEliminarPedido = "DELETE FROM Pedidos WHERE CodPed=$ultimoPedido";
    $resultEliminarPedido = $conn->query($queryEliminarPedido);
    if (!$resultEliminarPedido) {
        echo "Error al eliminar el pedido con CodPed $CodPed: " . mysqli_error($conn);
        exit;
    }
    
  }

?>
    
<div id="carderror" class="card">
  <p class="heading">
    Pedido non realizable por falta de stock 
       ou descatalogado
  </p>
  <p>
  <a href="categoriascliente.php">Categorías</a>
  </p>
  <a href="menu.php">Menu Principal</a>
</p></div>
</body>
</html>