<?php
class user{
    private $nombre;
    private $contraseña;
    private $id;

    public function __construct($id, $nombre, $contraseña){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->contraseña = $contraseña;
    }

    public function __get($valor){
        return $this->$valor;
    }

    public function __set($value, $valor){
        $this->$value = $valor;
    }

}


?>