<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarAulaAdmin.php');
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aulas Admin</title>
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/administrador/estilosAdmin.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
</head>

<body>
    
    <?php
        include("menu-include.php");
    ?>

            <!-- breadcrumb -->    
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminAula.php"> / Aula</a>
                <a href="" id="actual" actual="#aulas"> / Modificar</a>
            </nav>

            <section>
                
                <div class="formulario">
                    
                    <h3>Modificar Aula</h3>

                    <p class="recordatorio">Recuerde no dejar campos vacios y asegurese de que todos los campos son correctos.</p>
        
                    <?php
                        cargarAulaEditar();
                    ?>

                </div>
            </section>

        </main> 
    </div>

    <script>

        // Para que funcione se deben tener dos input, el input1 debe tener 'id="campo1"' y el input2 debe tener 'id="verify" verify="#campo1"'
        // Y los select deben tener la clase 'veriSelect'
        const formularioRegistroAdmin = (event) => {
        
            event.preventDefault();
            const form = event.target;
            const text = document.getElementById('texto');
        
            // Validamos que los campos del documento son iguales
            let idcampo1 = document.getElementById('verify').getAttribute('verify');
            let campo1 = document.querySelector(idcampo1).value;
            let campo2 = document.getElementById('verify').value;
        
            if (campo1 === campo2) {
        
                    form.submit();
                    return;
        
            }else {

                text.innerText = 'Verifique el nombre, los datos ingresados no son iguales';
                document.getElementById('texto').style.visibility = 'visible';
                return;

            }
        
        }

        document.addEventListener('DOMContentLoaded', function () {

        // Se agrega la función verificar a todos los elementos con el 'id=formulario' que y se activa al intentar hacer un submit.
        document.getElementById('formulario').addEventListener('submit', formularioRegistroAdmin);

        });        
        
    </script>

</body>

</html>