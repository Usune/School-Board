<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarClaseAdmin.php');
    require_once ('../../../Controlador/mostrarCurAdmin.php');
    require_once ('../../../Controlador/mostrarAsigAdmin.php');
    require_once ('../../../Controlador/mostrarUsuAdmin.php');
    require_once ('../../../Controlador/mostrarAulaAdmin.php');
    require_once ('../../../Controlador/mostrarClaseAdmin.php');
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <link rel="stylesheet" type="text/css" href="../../css/administrador/estilosAdmin.css">
    <script src="../../js/controlGeneral.js"></script>
    <title>Clases Admin</title>
</head>
<body>
    
    <?php
        include("menu-include.php");
    ?>
            
            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminClase.php" id="actual" actual="#clases"> / Clases</a>
            </nav>
        
            <section>
                <div class="cabecera">
                    <button type="button" class="desplegarModal btn-cabecera" modal="#modClase">
                        <img src="../../img/agregar.svg" alt="Registrar" modal="#modClase">Nueva clase
                    </button>
                </div>
                
                <div class="modal" id="modClase">

                    <div class="modal_container">
                        <button type="button" class="desplegarModal btn-cerrar" modal="#modClase"><img src="../../img/x.svg" alt="Salir" modal="#modClase"></button>
                        <div class="formulario">
                    
                            <h3>Crear Clase</h3>

                            <p class="recordatorio">Antes de crear la clase, asegurese de que todos los campos son correctos.</p>
                            <p class="recordatorio">Recuerde que ya deben estar registrados los campo curso, asignatura, docente y aula en el sistema.</p>
                
                            <form action="../../../Controlador/registrarClaseAdmin.php" method="post" enctype="multipart/form-data" id="formulario">

                                <div class="fieldset_view">
                                    <label for="rol">Curso</label>
                                    <select class="veriSelect" required name="curso">
                                        <option value="Seleccione" selected disabled>Seleccione una opción</option>
                                        
                                        <?php
                                            cargarCursosRegistro();
                                        ?>
                                
                                    </select>
                                </div>

                                <div class="fieldset_view">
                                    <label for="rol">Asignatura</label>
                                    <select class="veriSelect" required name="asignatura">
                                        <option value="Seleccione" selected disabled>Seleccione una opción</option>
                                        
                                        <?php
                                            cargarAsignaturasRegistro();
                                        ?>
                                
                                    </select>
                                </div>

                                <div class="fieldset_view">
                                    <label for="rol">Docente</label>
                                    <select class="veriSelect" required name="docente">
                                        <option value="Seleccione" selected disabled>Seleccione una opción</option>

                                        <?php
                                            cargarDocentesRegistro();
                                        ?>

                                    </select>
                                </div>

                                <div class="fieldset_view">
                                    <label for="rol">Aula</label>
                                    <select class="veriSelect" required name="aula">
                                        <option value="Seleccione" selected disabled>Seleccione una opción</option>
                                        
                                        <?php
                                            cargarAulasRegistro();
                                        ?>
                                
                                    </select>
                                </div>
                    
                                <div class="textarea">
                                    <label for="descripcion">Descripción</label>
                                    <textarea id="descripcion" cols="30" rows="10" name="descripcion" placeholder="Ingrese una descripción"></textarea>
                                </div> 
            
                                <p id="texto"></p>
                                
                                <button type="submit" class="enviar">Subir comunicado</button>
                            </form>

                        </div>
                    </div>
                </div>

                <?php

                    cargarClases();

                ?>
        
            </section>
        </main>

    </div>

    <script>

        // Función para verificar que dos campos son iguales en un formulario y en caso de serlo no se envia el formulario, también que no se envien los select si una opción.
        // Para que funcione se deben tener dos input, el input1 debe tener 'id="campo1"' y el input2 debe tener 'id="verify" verify="#campo1"'
        // Y los select deben tener la clase 'veriSelect'
        const formularioRegistroAdmin = (event) => {

            event.preventDefault();
            const form = event.target;
            const text = document.getElementById('texto');        

            // Validamos que los select estén seleccionados
            let select2 = document.getElementsByName('curso');
            select2 = select2[0].value;

            let select3 = document.getElementsByName('asignatura');
            select3 = select3[0].value;

            let select4 = document.getElementsByName('docente');
            select4 = select4[0].value;

            let select5 = document.getElementsByName('aula');
            select5 = select5[0].value;

            if (select2 !== 'Seleccione' && select3 !== 'Seleccione' && select4 !== 'Seleccione' && select5 !== 'Seleccione') {

                form.submit();
                return;

            }else{

                text.innerText = 'Seleccione una opción';
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