<!DOCTYPE html>
<html>
  <head>
    <title>Título de la página</title>
    <style>  
    body {
        margin: 0;
        padding: 20px;
        font-family: "Poppins", sans-serif;
        background: #f5f7fa;
    }

    h3 {
        color: #333;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .productos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .card-producto {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        transition: 0.2s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .card-producto:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.12);
    }

    .producto-nombre {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        text-align: center;
    }

    .producto-precio {
        margin-top: 5px;
        font-size: 20px;
        color: #007bff;
        font-weight: bold;
    }

    .acciones-carrito {
        margin-top: 15px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .btn-icono img {
        width: 36px;
        height: 36px;
        cursor: pointer;
        transition: transform 0.25s ease;
    }

    .btn-icono img:hover {
        transform: scale(1.18);
    }

    .cantidad-box {
        font-size: 18px;
        background: #eef2f7;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: bold;
        min-width: 40px;
        text-align: center;
    }

    .btn-sumar {
        background: #28a745;
        color: #fff;
        padding: 6px 12px;
        font-size: 20px;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .btn-sumar:hover {
        background: #1e7e34;
    }

    .barra-superior {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .btn-salir {
        background: #dc3545;
        color: #fff;
        padding: 10px 18px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 15px;
        transition: 0.2s;
    }

    .btn-salir:hover {
        background: #b52d3a;
    }

    .btn-carrito {
        background: #007bff;
        color: #fff;
        padding: 10px 18px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn-carrito:hover {
        background: #0056b3;
    }

.btn-salir {
    background: #ff3b3b;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(255, 59, 59, 0.35);
    transition: all 0.2s ease-in-out;
}

.btn-salir:hover {
    background: #d62828;
    box-shadow: 0 6px 16px rgba(255, 59, 59, 0.45);
    transform: translateY(-2px);
}
    </style>
  </head>
  <body>

<?php

include 'claseUser.php';
    $conexion = mysqli_connect('localhost','root','','market');
    if($conexion->connect_error){
        echo 'no se pudo conectar a la bd';
    }
 session_start();
 if(isset($_SESSION['carrito'])){
    $carro = $_SESSION['carrito'];
 }else{
    $carro = array();
 }
 
 $usuario = $_SESSION['user'];
 $consulta = $conexion->query("SELECT * FROM producto");
 $productos = mysqli_fetch_all($consulta);
 echo '<div class="barra-superior">
        <h3>Bienvenido '.$usuario->nombre.'</h3>
        <a class="btn-carrito" href="carrito.php">Ver Carrito</a>
      </div>';

echo '<h3>Productos</h3>';

echo '<div class="productos-grid">';

foreach($productos as $v){

    echo '<div class="card-producto">';

    echo '<div class="producto-nombre">'.$v[1].'</div>';
    echo '<div class="producto-precio">$'.$v[2].'</div>';

    echo '<div class="acciones-carrito">';

    // Si NO está en el carrito
    if(!$carro || !in_array($v[0], array_column($carro, 0))){
        echo '<a class="btn-icono" href="agregaPro.php?id='.$v[0].'">
                <img src="productonoagregado.gif" title="Agregar al carrito">
              </a>';
        echo '<div class="cantidad-box">0</div>';
    } 
    else {
        // SI está en el carrito → muestro icono y cantidad
        echo '<a class="btn-icono" href="quitarPro.php?id='.$v[0].'">
                <img src="productoagregado.gif" title="Quitar del carrito">
              </a>';

        // Buscar cantidad
        foreach($carro as $item){
            if($item[0] == $v[0]){
                echo '<div class="cantidad-box">'.$item[3].'</div>';
                break;
            }
        }

        // Botón +
        echo '<a class="btn-sumar" href="sumarCantidad.php?id='.$v[0].'">+</a>';
    }

    echo '</div>'; // acciones
    echo '</div>'; // card
}

echo '</div>'; // grid
 /*echo '<h3>Bienvendido '.$usuario->nombre.'</h3><br><br><hr>';

 echo '<h3>Productos</h3><br><br>
       
        <table border="1">
        <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Cantidad</th></tr>';
        foreach($productos as $v){
            echo '<tr><td>'.$v[0].'</td><td>'.$v[1].'</td><td>$'.$v[2].'</td><td>';
            if(!$carro ||  !in_array($v[0], array_column($carro, 0))){
                echo '<a href="agregaPro.php?id='.$v[0].'" ><img src="productonoagregado.gif" border="0" title="agregado del Carrito"></a>';
            }else{
                echo '<a href="quitarPro.php?id='.$v[0].'" ><img src="productoagregado.gif" border="0" title="quitar del Carrito"></a>';
            }
            
            echo '</td><td>';
            foreach($carro as $item){
            if($item[0] == $v[0]){
                echo $item[3]; // Mostrar la cantidad actual
                break;
            }
            }
            if($carro && in_array($v[0], array_column($carro, 0))){
                echo '<a href="sumarCantidad.php?id='.$v[0].'" style="text-decoration:none; font-weight:bold; font-size:20px;">+</a>';
            }

            echo '</td></tr>';
        }
        
        echo '</table>';

        echo '<br><br><hr><a href="carrito.php"><img src="vercarrito.gif" border="0"></a>';
*/

    
     echo '<hr>
        <form method="POST">
            <button type="submit" name="salir" class="btn-salir">Salir</button>
        </form>';

        if(isset($_POST['salir'])){
            session_destroy();
            header('Location: loginMarket.php');
        }
    
    
?>
</body>
</html>
