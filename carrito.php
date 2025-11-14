<!DOCTYPE html>
<html>
  <head>
    <title>Título de la página</title>
   <style>
.carrito-container {
    margin-top: 30px;
    padding: 25px;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
}

.table-carrito {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.table-carrito th {
    background: #007bff;
    color: white;
    padding: 12px;
    text-align: left;
    font-size: 16px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.table-carrito td {
    padding: 12px;
    border-bottom: 1px solid #e5e5e5;
    font-size: 15px;
}

.table-carrito tr:hover {
    background: #f5faff;
}

.total-box {
    margin-top: 20px;
    font-size: 22px;
    font-weight: 600;
    background: #f0f4ff;
    padding: 15px 20px;
    border-left: 5px solid #007bff;
    border-radius: 10px;
    color: #333;
    display: inline-block;
}
</style>

</head>
<body>
<?php
session_start();
$conexion = mysqli_connect('localhost','root','','market');
    if($conexion->connect_error){
        echo 'no se pudo conectar a la bd';
    }
    if(isset($_SESSION['carrito'])){
    $carro = $_SESSION['carrito'];}else{$carro = false;}
    
    $contador = 0;

    /*if($carro){
        echo '<h3>Carrito</h3><br<br>
           <table border="1">
        <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Cantidad</th></tr>'; 
        foreach($carro as $v => $k){
            echo '<tr><td>'.$k[0].'</td><td>'.$k[1].'</td><td>$'.$k[2].'</td><td>'.$k[3].'</td></tr>';
            $contador += (int)$k[2] * (int)$k[3];
        }
        echo '</table>';

        echo 'el total es: '.$contador;
    }*/
    if($carro){

    echo '<div class="carrito-container">';
    echo '<h3>Carrito</h3>';

    echo '<table class="table-carrito">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </tr>';

    foreach($carro as $v => $k){
        echo '<tr>
                <td>'.$k[0].'</td>
                <td>'.$k[1].'</td>
                <td>$'.$k[2].'</td>
                <td>'.$k[3].'</td>
              </tr>';

        $contador += (int)$k[2] * (int)$k[3];
    }

    echo '</table>';

    echo '<div class="total-box">Total: $'.$contador.'</div>';

    echo '</div>'; // carrito-container
}
        
?>
</body>
</html>