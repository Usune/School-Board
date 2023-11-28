<?php
require_once ('../../../Modelo/conexion.php');
require_once ('../../../Modelo/consultas.php');
require_once('../../../Modelo/seguridadDoc.php');
require_once ('../../../Controlador/mostrarPerfil.php');
require_once ('../../../Controlador/mostrarCursosDoc.php');
require_once ('../../../Controlador/mostrarAsisDoc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/Docente/estilosDoc.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
    <style>
        .isEmpty {
            background: lightpink;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php
        include('menu-include.php');
    ?>


    <main>

        <!-- breadcrumb -->
        <nav class="nav-main">
            <a href="homeDoc.php">Clases</a>
            <a href="adminUsu.php"> / Única-PRIMERO</a>
            <a href="adminUsuConsu.php"> / Asistencia</a>
        </nav>

        <section>
            <h2>Asistencia Estudiantes</h2>

            <!-- <h3>Consultar usuarios</h3> -->

            <div class="tabla">

                <div class="opciones">

                    <?php

                        if(isset($_GET['rol']) || isset($_GET['estado']) || isset($_GET['nombres']) || isset($_GET['apellidos']) || isset($_GET['documento'])){
                                
                            echo'<a href="reportesAsis.php?rol='.$_GET['rol'].'&estado='.$_GET['estado'].'&nombres='.$_GET['nombres'].'&apellidos='.$_GET['apellidos'].'&documento='.$_GET['documento'].'" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Generar Reporte</a>';
                            
                        }else {

                            echo'<a href="reportesAsis.php" target="_blank"><img src="../../img/curso.svg" alt="Reportes">Generar Reporte</a>';

                        }
                    ?>

                    <button type="button" class="desplegar" enlace="#filtro"><img src="../../img/filtro.svg"
                            alt="filtro">Filtrar</button>
                </div>

                <div id="filtro">

                    <form method="get">

                        <div class="fila-cont">


                        </div>

                        <div class="fila-cont">

                            <div class="fieldset">
                                <fieldset>
                                    <legend id="nom">Nombre</legend>
                                </fieldset>
                                <input type="text" placeholder="Nombre" legend="#nom" name="nombres">
                            </div>

                            <div class="fieldset">
                                <fieldset>
                                    <legend id="ape">Apellido</legend>
                                </fieldset>
                                <input type="text" placeholder="Apellido" legend="#ape" name="apellidos">
                            </div>

                        </div>

                        <div class="fila-cont">

                            <div class="fieldset">
                                <fieldset>
                                    <legend id="doc">Documento</legend>
                                </fieldset>
                                <input type="number" placeholder="Documento" legend="#doc" name="documento">
                            </div>

                            <button type="submit" class="filtrar">Filtrar</button>
                            <a href="adminUsuConsu.php" class="filtrar">Limpiar</a>

                        </div>

                    </form>

                </div>
                <form action="../../../Controlador/registrarAsistDoc.php" method="POST"> 
                    <button type="submit" onclick="return CrearArray();"> registrar </button>                       
                    <div class="tablas">
                        <table id="tblAsistencia">
                            <caption>
                                Lista de usuarios registrados
                            </caption>
                            <thead>
                                <tr>
                                    <th>Tipo Documento</th>
                                    <th>Documento</th>
                                    <th>Apellidos</th>
                                    <th>Nombres</th>  
                                    <th class="ultimo">Asistencia</th>                                                                                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php cargarAsistencia(); ?>
                            </tbody>                            
                        </table>
                    </div>
                    <?php echo '<input style="display: none;" id="idClase" name="idClase" type="text" value="'.$_GET['idClase'].'">';  ?>
                    <input type="text" style="display: none;" id="txtArray" name="txtArray">
                </form>                
            </div>
        </section>



    </main>

</body>
<script>
    function CrearArray(){
        var table = document.getElementById("tblAsistencia");
        var nFilas = table.rows.length;
        var datosAsistenciaArray = "";

        for (var i = 1; i < nFilas; i++) {
            datosAsistenciaArray += table.rows[i].children[1].innerText + ",";

            var opciones = document.getElementsByName('rdblAsistencia' + i);
            var valorSeleccionado = null;
            
            for (var j = 0; j < opciones.length; j++) {
                if (opciones[j].checked) {
                    datosAsistenciaArray += opciones[j].value + "|";   
                    valorSeleccionado = opciones[j].value;                
                }
            }             
            
            if (valorSeleccionado == null) {
                alert('Debe seleccionar una opción');
                opciones[0].parentNode.parentNode.classList.add('isEmpty');
                return false;
            }
            else{
                opciones[0].parentNode.parentNode.classList.remove('isEmpty');
            }        
        }

        document.getElementById("txtArray").value = datosAsistenciaArray.slice(0, -1);        
    }
</script>

</html>