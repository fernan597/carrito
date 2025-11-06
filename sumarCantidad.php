<?php 
session_start();
$conexion = mysqli_connect('localhost','root','','market');
    if($conexion->connect_error){
        echo 'no se pudo conectar a la bd';
    }
    if(isset($_SESSION['carrito'])){
    $carro = $_SESSION['carrito'];}


    $id=$_GET['id'];

    foreach($carro as $v => $k){
            if($k[0]==$id){ 
                $carro[$v][3] = $k[3] +1;   
            }
        }
    $_SESSION['carrito'] = $carro;
    header('Location: homeMarket.php');
    exit();

    
?>