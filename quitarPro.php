<?php
session_start();
    $usuario = $_SESSION['user'];
    $conexion = mysqli_connect('localhost','root','','market');
    if($conexion->connect_error){
        echo 'no se pudo conectar a la bd';
    }
    $id = $_GET['id'];

    $carro = $_SESSION['carrito'];
    
    foreach($carro as $v => $x){
        if($x[0] == $id){
            
            unset($carro[$v]); 
        }
    }

    $_SESSION['carrito'] = $carro;
    header('Location: homeMarket.php');
    exit();
?>