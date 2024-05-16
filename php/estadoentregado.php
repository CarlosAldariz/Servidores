    <?php  
      session_start(); 
    if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]) && $_SESSION["Cod_Rol"] == 2 ){
       
        } else { 
        header("location:mallogin.php");
        }   

if (isset($_POST["CodPed"])) { 
    $CodPed = $_POST["CodPed"];
}

$conn = mysqli_connect("127.0.0.1", "root", "" , "pedidos");  

$query = "UPDATE Pedidos SET Cod_Estado = 2 WHERE CodPed=$CodPed"; 
$result = $conn->query($query); 

header("location:pedidosadmin.php");

?>