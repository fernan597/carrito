<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <style>
        body {
    margin: 0;
    padding: 0;
    background-color: #FFFFF0; /* marfil */
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-container {
    background: white;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    width: 350px;
    text-align: center;
}

.login-container h3 {
    color: #2F4F4F; /* pizarra */
    margin-bottom: 20px;
}

.login-container form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.login-container label {
    text-align: left;
    font-size: 14px;
    color: #2F4F4F;
}

.login-container input {
    padding: 10px;
    border: 1px solid #bbb;
    border-radius: 6px;
    font-size: 14px;
}

.login-container button {
    padding: 10px;
    border: none;
    border-radius: 6px;
    font-size: 15px;
    cursor: pointer;
    background-color: #2F4F4F;
    color: white;
    transition: 0.2s;
}

.login-container button:hover {
    background-color: #1f3636;
}

    </style>
<?php include 'claseUser.php';
$conexion = mysqli_connect('localhost','root','','market');
if($conexion->connect_error){
    echo 'error al conectar bd';
}

echo '<div class="login-container">
    <h3>Bienvenido al Market</h3>
    <form method="POST">
        <label>Usuario</label>
        <input type="text" name="name">
        <label>Password</label>
        <input type="password" name="password">
        <button type="submit" name="submit">Iniciar sesión</button>
        <button type="submit" name="agregar">Agregar</button>
    </form>
</div>
';


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