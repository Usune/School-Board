<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Modelo/seguridadAdmin.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/logo.svg">
    <link rel="stylesheet" type="text/css" href="../../css/administrador/estilosAdmin.css">
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <script src="../../js/controlGeneral.js"></script>
    <title>Usuarios</title>
</head>

<body>
    
    <?php
        include("menu-include.php");
    ?>
        <main>

            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminCurso.php"> / Cursos</a>
                <a href="adminCurRegistro.php"> / Crear</a>
            </nav>
        
            <section>

                <h2>Administración de cursos</h2>
                
                <div class="formulario">
                    
                    <h3>Crear curso</h3>

                    <p class="recordatorio">Antes de crear el curso, asegurese de que todos los campos son correctos.</p>
        
                    <form action="../../../Controlador/registrarCurAdmin.php" method="post" id="formulario">
            
                        <div class="fieldset_view">
                            <label for="jornada">Jornada</label>
                            <select class="veriSelect" required name="jornada">
                                <option value="Seleccione" selected disabled>Seleccione una opción</option>
                                <option value="unica">Unica</option>
                                <option value="mañana">Mañana</option>
                                <option value="tarde">Tarde</option>
                            </select>
                        </div>

                        <div class="fieldset">
                            <fieldset>
                                <legend id="nom">Nombre</legend>
                            </fieldset>
                            <input type="text" placeholder="Nombre" required legend="#nom" name="nombre">
                        </div>
                        
                        <button type="submit" class="enviar">Registrar curso</button>
                    </form>
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