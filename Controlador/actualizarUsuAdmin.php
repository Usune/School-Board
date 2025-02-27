<?php

    //  require_once() para enlazar las dependencias necesarias
    require_once("../Modelo/conexion.php");
    require_once("../Modelo/consultas.php"); 
    require_once('../Modelo/seguridadAdmin.php');

    // Aterrizamos en variables los datos ingresados por el usuario, los cuales viajan a traves del metodo POST y los name de los campos
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $rol = $_POST['rol'];
    $tipoDoc = $_POST['tipoDoc'];
    $documento = $_POST['documento'];
    $estado = $_POST['estado'];
    $clave = $_POST['clave'];
    $id = $_POST['id'];
    $idCurso = '';

    if (strlen($nombres)>0 && strlen($apellidos)>0 && strlen($rol)>0 && strlen($tipoDoc)>0 && strlen($documento)>0 && strlen($estado)>0 && strlen($clave)>0 && strlen($id)>0) {

        $claveMD = MD5($clave);

        if ($rol == 'Estudiante'){
            $idCurso = $_POST['curso'];
        }

        $objConsultas = new Consultas();
        $result = $objConsultas->actualizarUsuAdmin($nombres, $apellidos, $rol, $tipoDoc, $documento, $estado, $claveMD, $id, $idCurso);

    } else{

        echo '<script>alert("Por favor complete todos los campos")</script>';
        echo '<script>location.href="../Vista/html/Administrador/adminUsuModificar.php?id='.$documento.'"</script>';

    }

?>