<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php");

    $idTarea = $_GET['idTarea'];
    $idClase = $_GET['idClase'];


    $objConsulta = new Consultas();
    $consulta = $objConsulta->eliminarTarDoc($idTarea,$idClase);
   
    

?>