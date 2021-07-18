<?php


if(isset($_POST)){

  //CONEXIÓN A LA BASE DE DATOS

  require_once 'includes/conexion.php';
 
   // Recoger los valores del formulario registro

   $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
   $apellidos= isset($_POST['apellido']) ? mysqli_real_escape_string($db,$_POST['apellido']) : false;
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

   if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos) ){
    $apellido_validado = true;
        }else{
    $apellido_validado= false;
   $errores['apellidos'] = "El apellido no es válido";
       }

       //Validar campo de Email 

      if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){

    $email_validado = true;
      }else{
    $email_validado= false;

   $errores['email'] = "El email no es válido";
      }
      


          $guardar_usuario = false;

          if(count($errores)== 0){
            $usuario = $_SESSION['usuario'];
            $guardar_usuario = true;

           
            
            /*VERIFICAR LA CONTRASEÑA
            var_dump($password);
            var_dump($pw_segura);
            var_dump(password_verify($password, $pw_segura));
            die();
            */

            // Comprobar si el email ya existe
              $sql = "SELECT email FROM usuarios WHERE email = '$email'";
              $isset_email = mysqli_query($db, $sql);
              $isset_user = mysqli_fetch_assoc($isset_email);

              if($isset_user['id'] == $usuario['id'] || empty($isset_user)){

             

              //ACTUALIZAR USUARIO EN LA TABLA USUARIOS DE LA BBDD
              
              $sql = "UPDATE usuarios SET
                     nombre = '$nombre', apellidos = '$apellidos', email = '$email' 
                    WHERE id = ".$usuario['id'];

              $guardar = mysqli_query($db, $sql );

            /*var_dump(mysqli_error($db));
            die();
            */
              if($guardar){
                  $_SESSION['usuario']['nombre'] = $nombre;
                  $_SESSION['usuario']['apellidos'] = $apellidos;
                  $_SESSION['usuario']['email'] = $email;

                $_SESSION['completado'] = "Tus datos se han actualizado éxito";

              }else{
                $_SESSION['errores']['general'] = "Fallo al actualizar el usuario";
              }
            }else{
              $_SESSION['errores']['general'] = "El usuario ya existe";
            }

              
          } else{

              $_SESSION['errores'] = $errores;
             
              

          }

}

header('Location: mis-datos.php');

