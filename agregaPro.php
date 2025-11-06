<?php 
    session_start();
    $usuario = $_SESSION['user'];
    $conexion = mysqli_connect('localhost','root','','market');
    if($conexion->connect_error){
        echo 'no se pudo conectar a la bd';
    }
    $id = $_GET['id'];
    $consulta = $conexion->query("SELECT * FROM producto WHERE idProducto = '$id'");
    $resultado = mysqli_fetch_row($consulta);
    if(isset($_SESSION['carrito'])){
    $carro = $_SESSION['carrito'];}
    
     $cantidad=1;

    $carro[] = array(0 => $resultado[0],1=> $resultado[1], 2=> $resultado[2],3=>$cantidad);

    $_SESSION['carrito'] = $carro;

    header('Location: homeMarket.php');
?>