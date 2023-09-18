<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarUsuAdmin.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/administrador/estilosAdmin.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
    <title>Consultar usuario</title>
</head>
<body>

    <?php
        include('menu-include.php');
    ?>
        <main>
            
            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminUsu.php"> / Usuarios</a>
                <a href="adminUsuConsu.html"> / Consultar</a>
            </nav>
        
            <section>
                <h2>Administración de usuarios</h2>

                <h3>Consultar usuarios</h3>

                <div class="tabla">

                    <div class="opciones">
                        <a href="adminUsuReportes.php"><img src="../../img/curso.svg" alt="Reportes">Generar Reporte</a>
                        
                        <button type="button" class="desplegar" enlace="#filtro"><img src="../../img/filtro.svg" alt="filtro">Filtrar</button>
                    </div>

                    <div id="filtro">

                        <form method="get">

                                <div class="radio">
                                    <p>Rol</p>
                                    <input type="radio" name="rol" value="nada" checked hidden>
                                    <input type="radio" name="rol" id="docente" value="docente">
                                    <label for="docente">Docente</label><br>
                                    <input type="radio" name="rol" id="estu" value="estudiante">
                                    <label for="estu">Estudiante</label><br>
                                </div>

                                <div class="radio">
                                    <p>Estado</p>
                                    <input type="radio" name="estado" value="nada" checked hidden>
                                    <input type="radio" name="estado" id="activo" value="activo">
                                    <label for="activo">Activo</label><br>
                                    <input type="radio" name="estado" id="inactivo" value="inactivo">
                                    <label for="inactivo">Inactivo</label><br>
                                </div>

                                <div class="fieldset"> 
                                    <fieldset>
                                        <legend id="doc">Documento</legend>
                                    </fieldset>
                                    <input type="number" placeholder="Documento" legend="#doc" name="documento">
                                </div>

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
                            
                            <button type="submit" class="filtrar">Filtrar</button>
                            <a href="adminUsuConsu.php" class="filtrar">Limpiar</a>

                        </form>
                        
                    </div>
                    
                    <table>
                        <caption>
                            Lista de usuarios registrados
                        </caption>
                        <tr>
                            <th>Tipo Documento</th>
                            <th>Documento</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>Estado</th>
                            <th>Rol</th>
                            <th>Opciones</th>
                            <!-- <th colspan="2">Opciones</th> -->
                        </tr>

                            <?php

                                if(isset($_GET['rol']) || isset($_GET['estado']) || isset($_GET['nombres']) || isset($_GET['apellidos']) || isset($_GET['documento'])){
                                        
                                    filtrarUsuarios($_GET['rol'], $_GET['estado'], $_GET['nombres'], $_GET['apellidos'], $_GET['documento']);
                                  
                                }else {

                                    cargarUsuarios();

                                }
                            ?>

                    </table>
                </div>
            </section>


            
        </main>

    </div>

    <hr>

    <footer>
        <div class="info-footer">
            <p>School Board</p>
            <p>Copyright © - 2023. Todos los Derechos Reservados</p>
            <p>Autor: Estefani Arenas, Erika Diaz, Nicole Benavides y Tatiana Arevalo.</p>
        </div>
    </footer>

</body>
</html>