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
    <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
    <link rel="stylesheet" type="text/css" href="../../css/administrador/estilosAdmin.css">
    <script src="../../js/controlGeneral.js"></script>
    <title>Administrar usuarios</title>
</head>
<body>
    
    <?php
        include("menu-include.php");
    ?>
            
            <!-- breadcrumb -->  
            <nav class="nav-main">
                <a href="homeAdmin.php">Home</a>
                <a href="adminPerfil.php"> / Perfil</a>
            </nav>
        
            <section>
                
                <div class="perfil">
                    <?php
                        actualizarFoto();
                    ?>
                </div>
        
            </section>
        </main>

    </div>
    
</body>
</html>