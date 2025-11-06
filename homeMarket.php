<?php include 'claseUser.php';
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
 echo '<h3>Bienvendido '.$usuario->nombre.'</h3><br><br><hr>';

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


    
        echo '<hr><form method="POST">
              <button type="submit" name="salir">Salir</button>
              </form>';

        if(isset($_POST['salir'])){
            session_destroy();
            header('Location: loginMarket.php');
        }
    
    
?>