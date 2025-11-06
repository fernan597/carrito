<?php
session_start();
$conexion = mysqli_connect('localhost','root','','market');
    if($conexion->connect_error){
        echo 'no se pudo conectar a la bd';
    }
    if(isset($_SESSION['carrito'])){
    $carro = $_SESSION['carrito'];}else{$carro = false;}
    
    $contador = 0;

    if($carro){
        echo '<h3>Carrito</h3><br<br>
           <table border="1">
        <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Cantidad</th></tr>'; 
        foreach($carro as $v => $k){
            echo '<tr><td>'.$k[0].'</td><td>'.$k[1].'</td><td>$'.$k[2].'</td><td>'.$k[3].'</td></tr>';
            $contador += (int)$k[2] * (int)$k[3];
        }
        echo '</table>';

        echo 'el total es: '.$contador;
    }

    
        
?>