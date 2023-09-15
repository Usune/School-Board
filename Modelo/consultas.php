<?php

    class Consultas{

        public function validarInicioSesion($usuario, $claveMd) {

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql1 = 'SELECT * FROM usuario WHERE documento = :usuario';

            $consulta1 = $conexion->prepare($sql1);
            $consulta1->bindParam(':usuario', $usuario);
            $consulta1->execute();

            $f = $consulta1->fetch();

            if ($f) {

                if ($f['clave'] == $claveMd) {
                    
                    if ($f['estado'] == 'activo'){
                        // SE REALIZA EL INICIO DE SESIÓN
                        session_start();

                        // CREAMOS VARIABLES DE SESIÓN
                        $_SESSION['id'] = $f['documento'];
                        $_SESSION['correo'] = $f['correo'];
                        $_SESSION['AUTENTICADO'] = 'SI';
                        $_SESSION['rol'] = $f['rol'];
                        
                        switch ($f['rol']){

                            case "Administrador":
                                echo '<script>alert("Bienvenido rol administrador")</script>';
                                echo "<script>location.href='../Vista/html/Administrador/homeAdmin.php'</script>";
                            break;
                            case "Docente":
                                echo '<script>alert("Bienvenido rol docente")</script>';
                                echo "<script>location.href='../Vista/html/Docente/homeDoc.html'</script>";
                            break;
                            case "Estudiante":
                                echo '<script>alert("Bienvenido rol estudiante")</script>';
                                echo "<script>location.href='../Vista/html/Estudiante/homeEstu.html'</script>";
                            break;

                        }

                    }else {
                        echo '<script>alert("Su cuenta no se encuentra activa, comuniquese con el administrador de la entidad")</script>';
                        echo "<script>location.href='../Vista/html/Extras/inicioSesion.html'</script>";
                    }

                }else {
                    echo '<script>alert("Clave incorrecta, intentelo nuevamente.")</script>';
                    echo "<script>location.href='../Vista/html/Extras/inicioSesion.html'</script>";
                }

            }else {
                echo '<script>alert("El usuario ingresado no está registrado.")</script>';
                echo "<script>location.href='../Vista/html/Extras/inicioSesion.html'</script>";
            }

        }

        public function cerrarSesion(){
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            session_start();
            session_destroy();
            
            echo "<script>location.href='../Vista/html/Extras/inicioSesion.html'</script>";

        }

        public function insertarUsuAdmin($nombres, $apellidos, $rol, $tipoDoc, $documento, $claveMd, $estado){

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            // SELECT DE USUARIO REGISTRADO EN EL SISTEMA
            $sql1 = 'SELECT * FROM usuario WHERE documento = :documento';
            $consulta1 = $conexion->prepare($sql1);
            $consulta1->bindParam(':documento', $documento);
            $consulta1->execute();
            // fetch() para corvertir un texto separado por comas en un array. Este no existira si en la consulta no se obtuvo nada.
            $f1 = $consulta1->fetch();

            if ($f1) {

                echo '<script>alert("El usuario ya existe en el sistema")</script>';
                echo "<script>location.href='../Vista/html/Administrador/adminUsuRegistro.php'</script>";

            } else {
            
                // SE CREA LA VARIABLE QUE CONTENDRÁ LA CONSULTA A EJECUTAR EN LA TABLA usuario
                $sql2 = 'INSERT INTO usuario (documento, clave, rol, estado, tipoDoc, nombres, apellidos) VALUES (:documento, :claveMd, :rol, :estado, :tipoDoc, :nombres, :apellidos)';

                // PREPARAMOS TODO LO NOCESARIO PARA EJECUTAR LA FUNCION ANTERIOR
                $consulta2 = $conexion->prepare($sql2);

                // CONVERTIMOS LOS ARGUMENTOS EN PARAMETROS
                $consulta2->bindParam(':documento', $documento);
                $consulta2->bindParam(':claveMd', $claveMd);
                $consulta2->bindParam(':rol', $rol);
                $consulta2->bindParam(':estado', $estado);
                $consulta2->bindParam(':tipoDoc', $tipoDoc);
                $consulta2->bindParam(':nombres', $nombres);
                $consulta2->bindParam(':apellidos', $apellidos);

                // EJECUTAMOS EL INSERT DE LA TABLA usuario
                $consulta2->execute();


                // // SELECT PARA TRAER EL ID DEL USUARIO RECIEN REGISTRADO
                // $sql3 = 'SELECT idUsuario FROM usuario WHERE usuario = :usuario';
                // $consulta3 = $conexion->prepare($sql3);
                // $consulta3->bindParam(':usuario', $usuario);
                // $consulta3->execute();
                // // fetch() para corvertir un texto separado por comas en un array. Este no existira si en la consulta no se obtuvo nada.
                // $f2 = $consulta3->fetch();


                // // SE CREA LA VARIABLE QUE CONTENDRÁ LA CONSULTA A EJECUTAR EN LA TABLA perfilUsuario
                // $sql4 = 'INSERT INTO perfilUsuario (idPerfilUsuario, idUsuario, tipoDoc, documento, nombres, apellidos) VALUES (:idPerfilUsuario, :idUsuario, :tipoDoc, :usuario, :nombres, :apellidos)';
                // // PREPARAMOS TODO LO NOCESARIO PARA EJECUTAR LA FUNCION ANTERIOR
                // $consulta4 = $conexion->prepare($sql4);
                // // CONVERTIMOS LOS ARGUMENTOS EN PARAMETROS $f['clave']
                // $consulta4->bindParam(':idPerfilUsuario', $f2['idUsuario']);
                // $consulta4->bindParam(':idUsuario', $f2['idUsuario']);
                // $consulta4->bindParam(':tipoDoc', $tipoDoc);
                // $consulta4->bindParam(':usuario', $usuario);
                // $consulta4->bindParam(':nombres', $nombres);
                // $consulta4->bindParam(':apellidos', $apellidos);
                // // EJECUTAMOS EL INSERT DE LA TABLA perfilUsuario
                // $consulta4->execute();

                echo '<script>alert("Usuario registrado con exito")</script>';
                echo "<script>location.href='../Vista/html/Administrador/adminUsuRegistro.php'</script>";

            }

        }

        public function actualizarUsuAdmin($nombres, $apellidos, $rol, $tipoDoc, $documento, $estado){

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'UPDATE usuario SET documento=:documento, rol=:rol, estado=:estado, tipoDoc=:tipoDoc, nombres=:nombres, apellidos=:apellidos WHERE documento=:documento';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':documento', $documento);
            $consulta->bindParam(':rol', $rol);
            $consulta->bindParam(':estado', $estado);
            $consulta->bindParam(':tipoDoc', $tipoDoc);
            $consulta->bindParam(':nombres', $nombres);
            $consulta->bindParam(':apellidos', $apellidos);

            $consulta->execute();

            echo '<script>alert("Usuario actualizado con exito")</script>';
            echo "<script>location.href='../Vista/html/Administrador/adminUsuConsu.php'</script>";

        }

        public function actualizarPerfilAdmin($telefono, $direccion, $correo, $documento){

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'UPDATE usuario SET telefono=:telefono, direccion=:direccion, correo=:correo WHERE documento=:documento';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':documento', $documento);
            $consulta->bindParam(':telefono', $telefono);
            $consulta->bindParam(':direccion', $direccion);
            $consulta->bindParam(':correo', $correo);

            $consulta->execute();

            echo '<script>alert("Usuario actualizado con exito")</script>';
            echo '<script>location.href="../Vista/html/Administrador/adminPerfil.php?id='.$documento.'"</script>';

        }

        public function actualizarFotoAdmin($documento, $foto){

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'UPDATE usuario SET foto=:foto WHERE documento=:documento';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':documento', $documento);
            $consulta->bindParam(':foto', $foto);

            $consulta->execute();

            echo '<script>alert("Foto actualizada con exito")</script>';
            echo '<script>location.href="../Vista/html/Administrador/adminPerfil.php?id='.$documento.'"</script>';

        }

        public function actualizarClave($documento, $claveMD){

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'UPDATE usuario SET clave=:claveMD WHERE documento=:documento';
            $consulta = $conexion->prepare($sql);
            
            $consulta->bindParam(':documento', $documento);
            $consulta->bindParam(':claveMD', $claveMD);

            $consulta->execute();

            echo '<script>alert("Clave actualizada con exito")</script>';
            echo '<script>location.href="../Vista/html/Administrador/adminPerfil.php?id='.$documento.'"</script>';

        }

        // Trae todos los usuarios registrados
        public function mostrarUsuAdmin() {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT * FROM usuario";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;

        }

        // Trae un usuario especifico de los usuarios registrados
        public function mostrarUsuarioAdmin($id) {

           // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
           $objConexion = new Conexion();
           $conexion = $objConexion->get_conexion();

           $sql = "SELECT * FROM usuario WHERE documento=:id";
           $consulta = $conexion->prepare($sql);
           $consulta->bindParam(':id', $id);
           $consulta->execute(); 

           while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            // return para que la variable vualva a su estado inicial
            return $f;

        }

        // Trae todos los cursos registrados
        public function mostrarCurAdmin() {
            $f = null;

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT * FROM curso";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            
            while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            return $f;
        }

        public function verPerfil($id) {

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();
 
            $sql = "SELECT * FROM usuario WHERE documento=:id";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':id', $id);
            $consulta->execute(); 
 
            while ($resultado = $consulta->fetch()) {
 
                 $f[] = $resultado;
 
            }
 
            // return para que la variable vualva a su estado inicial
            return $f;
 
        }

        public function eliminarUsuAdmin($id) {
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'DELETE FROM usuario WHERE documento = :id';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            
            echo '<script>alert("El usuario a sido eliminado.")</script>';
            echo "<script>location.href='../Vista/html/administrador/adminUsuConsu.php'</script>";

        }
        
        public function insertarComunAdmin($titulo, $descripcion, $archivo) {

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'INSERT INTO comunicado (titulo, descripcion, archivo) VALUES (:titulo, :descripcion, :archivo)';
            $consulta = $conexion->prepare($sql);

            $consulta->bindParam(':titulo',$titulo);
            $consulta->bindParam(':descripcion',$descripcion);
            $consulta->bindParam(':archivo',$archivo);

            $consulta->execute();

            echo '<script>alert("Comunicado subido correcamente")</script>';
            echo "<script>location.href='../Vista/html/Administrador/adminComunRegistrar.php'</script>";         

        }

        public function insertarCurAdmin($nombre, $jornada) {
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = 'INSERT INTO curso(nombre, jornada) VALUES (:nombre, :jornada)';
            $resultado = $conexion->prepare($sql);
            $resultado->bindParam(':nombre', $nombre);
            $resultado->bindParam(':jornada', $jornada);

            $resultado->execute();

            echo '<script>alert("El curso fue registrado")</script>';
            echo '<script>location.href="../Vista/html/Administrador/adminCurRegistro.php"</script>';

        }

        // CONSULTAS PARA ESTUDIANTES 

        // Funcion para cargar las asignaturas correspondientes al estudiante
        public function cargarAsignaturas($documento){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT 
                    asignatura.nombre as asignatura
                    FROM estudiantecurso
                    INNER JOIN usuario
                    ON usuario.idUsuario = estudiantecurso.idUsuario
                    INNER JOIN curso
                    ON curso.idCurso = estudiantecurso.idCurso
                    INNER JOIN clase
                    ON clase.idCurso = curso.idCurso
                    INNER JOIN asignatura
                    ON asignatura.idAsignatura = clase.idAsignatura
                    WHERE usuario.idUsuario = :id";
            $statement = $conexion->prepare($sql);
            $statement->bindParam(':id' , $id);
            $statement->execute();

            while ($resultado = $statement->fetch()) {
                $rows[] = $resultado;
            }

            return $rows;
        }

        // Funcion para mostrar las tareas correspondientes a una Asignatura 
        public function cargarTareas($idAsignatura){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT 
            tarea.idTarea,
            asignatura.nombre as nombreAsignatura,
            asignatura.idAsignatura,
            usuario.foto,
            usuario.nombres,
            usuario.apellidos,
            tarea.fecha_vencimiento,
            tarea.titulo,
            tarea.descripcion
            FROM clase
            INNER JOIN asignatura
            ON asignatura.idAsignatura = clase.idAsignatura
            INNER JOIN tarea 
            ON tarea.idClase = clase.idClase
            INNER JOIN curso
            ON curso.idCurso = clase.idCurso
            INNER JOIN usuario
            ON usuario.documento = clase.idDocente
            WHERE asignatura.idAsignatura = :idAsignatura
            ORDER BY tarea.idTarea DESC";

            $statement = $conexion->prepare($sql);
            $statement->bindParam('idAsignatura' , $idAsignatura);
            $statement->execute();

            while($resultado = $statement->fetch()){
                $rows[] = $resultado;
            }

            return $rows;

        }

        // Funcion para mostrar las tareas correspondientes a una Asignatura 
        public function cargarTarea($idTarea){
            $rows = null;

            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "SELECT 
            tarea.idTarea,
            tarea.titulo,
            tarea.descripcion,
            tarea.fecha_creacion,
            tarea.fecha_vencimiento,
            tarea.archivos,
            asignatura.nombre as nombreAsignatura,
            asignatura.idAsignatura,
            usuario.foto,
            usuario.nombres,
            usuario.apellidos
            FROM clase
            INNER JOIN asignatura
            ON asignatura.idAsignatura = clase.idAsignatura
            INNER JOIN tarea 
            ON tarea.idClase = clase.idClase
            INNER JOIN curso
            ON curso.idCurso = clase.idCurso
            INNER JOIN usuario
            ON usuario.documento = clase.idDocente
            WHERE tarea.idTarea = :idTarea";

            $statement = $conexion->prepare($sql);
            $statement->bindParam('idTarea' , $idTarea);
            $statement->execute();

            while($resultado = $statement->fetch()){
                $rows[] = $resultado;
            }

            return $rows;

        }

        // Función para entregar actividades
        public function entregarTarea($descripcion, $archivos_str){
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql = "INSERT INTO entrega (descripcion, archivos)  VALUES (:descripcion, :archivos_str)";
            $statement = $conexion->prepare($sql);
            $statement->bindParam(':descripcion' , $descripcion);
            $statement->bindParam(':archivos_str' , $archivos_str);
            $statement->execute();

            echo '<script>alert("Entrega exitosa")</script>';
            echo '<script>location.href="../Vista/html/Estudiante/tareaAsignatura.php"</script>';

        }



        // Consulta para traer los archivos relacionados a la tarea
        // SELECT 
        //     tarea.idTarea,
        //     tarea.idArchivo,
        //     archivo.url,
        //     asignatura.nombre as nombreAsignatura,
        //     asignatura.idAsignatura,
        //     usuario.foto,
        //     usuario.nombres,
        //     usuario.apellidos,
        //     tarea.fecha_vencimiento,
        //     tarea.titulo,
        //     tarea.descripcion
        //     FROM clase
        //     INNER JOIN asignatura
        //     ON asignatura.idAsignatura = clase.idAsignatura
        //     INNER JOIN tarea 
        //     ON tarea.idClase = clase.idClase
        //     INNER JOIN curso
        //     ON curso.idCurso = clase.idCurso
        //     INNER JOIN usuario
        //     ON usuario.documento = clase.idDocente
        //     INNER JOIN archivo
        //     ON archivo.idArchivo = tarea.idArchivo
        //     WHERE tarea.idTarea = 1;





    }



    class ValidarSesion{

        public function validarInicioSesion($usuario, $claveMd) {

            // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            $sql1 = 'SELECT * FROM usuario WHERE documento = :usuario';

            $consulta1 = $conexion->prepare($sql1);
            $consulta1->bindParam(':usuario', $usuario);
            $consulta1->execute();

            $f = $consulta1->fetch();

            if ($f) {

                if ($f['clave'] == $claveMd) {
                    
                    if ($f['estado'] == 'activo'){
                        // SE REALIZA EL INICIO DE SESIÓN
                        session_start();

                        // CREAMOS VARIABLES DE SESIÓN
                        $_SESSION['id'] = $f['documento'];
                        $_SESSION['correo'] = $f['correo'];
                        $_SESSION['AUTENTICADO'] = 'SI';
                        $_SESSION['rol'] = $f['rol'];
                        
                        switch ($f['rol']){

                            case "Administrador":
                                echo '<script>alert("Bienvenido rol administrador")</script>';
                                echo "<script>location.href='../Vista/html/Administrador/homeAdmin.php'</script>";
                            break;
                            case "Docente":
                                echo '<script>alert("Bienvenido rol docente")</script>';
                                echo "<script>location.href='../Vista/html/Docente/homeDoc.html'</script>";
                            break;
                            case "Estudiante":
                                echo '<script>alert("Bienvenido rol estudiante")</script>';
                                echo "<script>location.href='../Vista/html/Estudiante/homeEstu.html'</script>";
                            break;

                        }

                    }else {
                        echo '<script>alert("Su cuenta no se encuentra activa, comuniquese con el administrador de la entidad")</script>';
                        echo "<script>location.href='../Vista/html/Extras/inicioSesion.html'</script>";
                    }

                }else {
                    echo '<script>alert("Clave incorrecta, intentelo nuevamente.")</script>';
                    echo "<script>location.href='../Vista/html/Extras/inicioSesion.html'</script>";
                }

            }else {
                echo '<script>alert("El usuario ingresado no está registrado.")</script>';
                echo "<script>location.href='../Vista/html/Extras/inicioSesion.html'</script>";
            }

        }

        public function cerrarSesion(){
            
            $objConexion = new Conexion();
            $conexion = $objConexion->get_conexion();

            session_start();
            session_destroy();
            
            echo "<script>location.href='../Vista/html/Extras/inicioSesion.html'</script>";

        }

        // Trae un usuario especifico de los usuarios registrados
        public function buscarUsuario($documento, $correo) {

           // SE CREA EL OBJETO DE LA CONEXION (Esto nunca puede faltar)
           $objConexion = new Conexion();
           $conexion = $objConexion->get_conexion();

           $sql = "SELECT * FROM usuario WHERE documento=:documento AND correo=:correo";
           $consulta = $conexion->prepare($sql);
           $consulta->bindParam(':documento', $documento);
           $consulta->bindParam(':correo', $correo);
           $consulta->execute(); 

           while ($resultado = $consulta->fetch()) {

                $f[] = $resultado;

            }

            // return para que la variable vualva a su estado inicial
            return $f;

        }

    }

?> 
