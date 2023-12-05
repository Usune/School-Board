<?php

    // SE RECIBEN TODAS LAS CONSULTAS PARA MOSTRAR USUARIOS

    // ESTA FUNCIÓN ES LA QUE SE LLAMA EN LA VISTA
    function cargarUsuarios(){
        
        $objConsultas = new Consultas();
        $consultas = $objConsultas->mostrarEstudiantesDoc();

        if (!isset($consultas)) {
            echo '<h3> No hay usuarios registrados </h3>';
        } else {

            foreach($consultas as $f) {

                echo '
                <tr>
                    <td>'.$f['tipoDoc'].'</td>
                    <td>'.$f['documento'].'</td>
                    <td>'.$f['apellidos'].'</td>
                    <td>'.$f['nombres'].'</td>
                    <td>'.$f['estado'].'</td>
                    <td>'.$f['rol'].'</td>

                    <td class="ultimo"><a href="docEstuModificar.php?id='.$f['documento'].'" alt="Modificar">Modificar<img src="../../img/edit.svg" alt="Modificar"></a></td>

                    <!-- <td><a href="../../../Controlador/eliminarUsuAdmin.php?id='.$f['documento'].'">Eliminar<img src="../../img/eliminar.svg" alt="Eliminar"></a></td> -->
                </tr>
                ';

            }

        }

    } 

?>