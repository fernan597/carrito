<?php include 'claseUser.php';
$conexion = mysqli_connect('localhost','root','','market');
if($conexion->connect_error){
    echo 'error al conectar bd';
}

echo '<h3>Bienvendido al Market</h3>
        <form method="POST">
        <label>Usuario</usuario>
        <input type="text" name="name">
        <label>Password</label>
        <input type="password" name="password">
        <button type="submit" name="submit">Iniciar session</button>
        <button type="submit" name="agregar">Agregar</button>';


if(isset($_POST['submit'])){
    extract($_POST);
    try{
        $consulta = $conexion->query("SELECT * from usuario WHERE nombre = '$name' AND clave = '$password'");
        $resultado = mysqli_fetch_all($consulta);
       
    }catch (Exception $e) {
    echo 'Excepción recibida: ',  $e->getMessage(), "\n";
    }
    if($resultado != null){
         $user = new user($resultado[0][0], $resultado[0][1], $resultado[0][2]);
        session_start();
        $_SESSION['user']= $user;
        header('Location: homeMarket.php');
    }else{
        echo 'contraseña invalida, ingrese de nuevo';
        die();
    }

}elseif(isset($_POST['agregar'])){
    extract($_POST);
    if($consulta = $conexion->query("INSERT INTO usuario(nombre,clave) VALUES ('$name', '$password')") != null){
        echo 'agregado con exito';
        header('Location: loginMarket.php');
        die();
    }else{
        echo 'no se pudo registrar';
    }

}

?>