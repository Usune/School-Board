<?php
    require_once ('../../../Modelo/conexion.php');
    require_once ('../../../Modelo/consultas.php');
    require_once ('../../../Controlador/mostrarPerfil.php');
    require_once ('../../../Controlador/mostrarUsuAdmin.php');
    require_once ('../../../Controlador/mostrarInfoEstu.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estudiante</title>
  <link rel="shortcut icon" href="../../img/logo.svg">
  <!-- link bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="../../css/estilosBase.css">
  <link rel="stylesheet" href="../../css/estudiante/estilosEstu.css">
  <script src="../../js/controlGeneral.js"></script>


</head>

<body>
  <!-- Barra de navegación principal (horizontal) -->
  <?php
        include("menu-include.php");
    ?>


  <!-- breadcrumb -->
  <nav class="nav-main">
    <a href="homeEstu.php">Home</a>
    <a href="homeTareas.php" id="actual" actual="#liTareas"> / Tareas</a>
  </nav>

  <section>
    <div class="container-fluid">
      <h2>Tareas</h2>

        <!-- Filtro funcional -->
        <div class="row filtro">
          <div class="col-md-12">
            <form method="get">

              <div class="row rowFiltro">

              <!-- input - nombres -->
                <div class="col-lg-4 col-md-6 col-sm-12 filtro-inputs">
                  <div class="fieldset_view">
                    <div class="fieldset">
                      <fieldset>
                        <legend id="nom">Nombre Asignatura</legend>
                      </fieldset>
                      <input type="text" placeholder="Nombre Asignatura" legend="#nom" name="asignatura">
                    </div>
                  </div>

                </div>

                <!-- botones -->
                <div class="col-lg-4 col-md-12 col-sm-12 filtro-inputs">

                  <div class="buscador col-6">
                    <div class="col-6">
                      <button type="submit" class="filtrar">Filtrar</button>
                    </div>

                    <div class="col-6">
                      <a href="homeTareas.php" class="filtrar">Limpiar</a>
                    </div>
                  </div>

                </div>

              </div>
            </form>


          </div>
        </div>

      <!-- Contenido -->
      <div class="row">
        <div class="table-responsive col-md-12 tablas">
          <table class="table table-borderless table-hover ">
            <thead>
              <tr>
                <th scope="col">Asignatura</th>
                <th scope="col">Docente</th>
                <th scope="col">Titulo</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha de Entrega</th>
                <th scope="col">Calificación</th>
                <th scope="col" class="ultimo">Detalles</th>
              </tr>
            </thead>
            <tbody>

              <?php

                if(isset($_GET['asignatura'])){

                  mostrarTareasFiltrados($_GET['asignatura']);
                          
                }else {

                  mostrarTodasCalificaciones();

                }

              ?>

              <!-- <tr>
                  <td>Español</td>
                  <td>
                    <div class="row">
                      <div class="col-sm-12 col-md-6 col-lg-6 imgDoc">
                        <img src="../../Uploads/Usuario/fotoUsuario.jpg" alt="img perfil docente">
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6 textDoc">
                        <p>Docente Prueba</p>
                      </div>
                    </div>
                  </td>
                  <td>Ensayo sobre Tecnologia 1</td>
                  <td>
                    2023-09-13 <br>
                    13:11:05
                  </td>
                  <td>01</td>
                  <td class="pendiente">
                    <p>
                      Pendiente
                    </p>
                  </td>
                  <td>
                    <a href="">
                      <img src="../../img/flecha-arriba.svg" alt="" id="verMas">
                    </a>
                  </td>
                </tr> -->
              <!-- <tr>
                  <td>Español</td>
                  <td>
                    <div class="row">
                      <div class="col-sm-12 col-md-6 col-lg-6 imgDoc">
                        <img src="../../Uploads/Usuario/fotoUsuario.jpg" alt="img perfil docente">
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6 textDoc">
                        <p>Docente Prueba</p>
                      </div>
                    </div>
                  </td>
                  <td>Ensayo sobre Tecnologia 1</td>
                  <td>
                    2023-09-13 <br>
                    13:11:05
                  </td>
                  <td>01</td>
                  <td class="pendiente">
                    <p>
                      Pendiente
                    </p>
                  </td>
                  <td>
                    <a href="">
                      <img src="../../img/flecha-arriba.svg" alt="" id="verMas">
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>Español</td>
                  <td>
                    <div class="row">
                      <div class="col-sm-12 col-md-6 col-lg-6 imgDoc">
                        <img src="../../Uploads/Usuario/fotoUsuario.jpg" alt="img perfil docente">
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6 textDoc">
                        <p>Docente Prueba</p>
                      </div>
                    </div>
                  </td>
                  <td>Ensayo sobre Tecnologia 1</td>
                  <td>
                    2023-09-13 <br>
                    13:11:05
                  </td>
                  <td>01</td>
                  <td class="entregada">
                    <p>
                      Entregada
                    </p>
                  </td>
                  <td>
                    <a href="">
                      <img src="../../img/flecha-arriba.svg" alt="" id="verMas">
                    </a>
                  </td>
                </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  </main>


  </div>



  <!-- link bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>