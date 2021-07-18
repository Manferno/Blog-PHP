<?php


if(isset($_POST)){

  //CONEXIÓN A LA BASE DE DATOS

  require_once 'includes/conexion.php';
  //INICIAR SESIÓN

  //session_start();

   // Recoger los valores del formulario registro

   $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
   $apellido= isset($_POST['apellido']) ? mysqli_real_escape_string($db,$_POST['apellido']) : false;
   $email = isset($_POST['email']) ? mysqli_real_escape_string($db,trim($_POST['email'])) : false;
   $password = isset($_POST['contraseña']) ? mysqli_real_escape_string($db,$_POST['contraseña']) : false;

   //array de errores

   $errores = array();
  

   // validar datos antes de guardarlos en al base de datos 
   
   //Validar campo de Nombre
   if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre) ){
       $nombre_validado = true;
   }else{
       $nombre_validado= false;
      $errores['nombre'] = "El nombre no es válido";
   }

   //Validar campo de Apellidos

   if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido) ){
    $apellido_validado = true;
        }else{
    $apellido_validado= false;
   $errores['apellido'] = "El apellido no es válido";
       }

       //Validar campo de Email 

      if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){

    $email_validado = true;
      }else{
    $email_validado= false;

   $errores['email'] = "El email no es válido";
      }

      //Validar campo de Contraseña 

      if(!empty($password)){

        $password_validado = true;
          }else{

        $password_validado= false;
    
       $errores['password'] = "La contraseña está vacía";
          }


          $guardar_usuario = false;

          if(count($errores)== 0){
            $guardar_usuario = true;

            // Cifrar contraseña
            $pw_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' =>4]);
            
            
            /*VERIFICAR LA CONTRASEÑA
            var_dump($password);
            var_dump($pw_segura);
            var_dump(password_verify($password, $pw_segura));
            die();
            */

              //INSERTAR USUARIO EN LA TABLA USUARIOS DE LA BBDD
              $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellido', '$email', '$pw_segura', CURDATE());";
              $guardar = mysqli_query($db, $sql );

            /*var_dump(mysqli_error($db));
            die();
            */
              if($guardar){
                $_SESSION['completado'] = "Registro completado con éxito";

              }else{
                $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
              }

              
          } else{

              $_SESSION['errores'] = $errores;
             
              

          }

}

header('Location: index.php');

