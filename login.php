<?php
//iniciar la sesion
require_once 'includes/conexion.php';

//recoger datos del formulario

if(isset($_POST)){

    //Borrar error antiguo
    if(isset($_SESSION['error_login'])){
        
        if(isset($_SESSION['usuario'])){
            $_SESSION['error_login'] = null;
            session_unset($_SESSION['error_login']);
        }
        
        header("Location: index.php");
        
    }
    //recoger datos del formulario
    $email = trim($_POST['email']);
    $password = trim($_POST['contraseña']);

    //consulta la bbdd para comprobar credenciales de usuarios

    $sql = "SELECT * FROM usuarios where email = '$email'";
    $login = mysqli_query($db, $sql);
 

    if($login && mysqli_num_rows($login) == 1){
        $usuario = mysqli_fetch_assoc($login);
        
        //comprobar contraseña
        
        $verify= password_verify($password, $usuario['password']);

        if($verify){
            //utilizar una sesión para guardar los datos del usuario logeado
            

            //$_SESSION['usuario'] = $usuario;
            
            if(isset($_SESSION['error_login'])){
                $_SESSION['error_login'] = null;
                session_unset($_SESSION['error_login']);         
                           
            }
         

        }else{
            //si algo falla enviar una sesión con el fallo
            $_SESSION['error_login'] = "Login incorrecto11";
            
    } 
    }else{
        //si algo falla enviar una sesión con el fallo
        $_SESSION['error_login'] = "Login incorrecto2";

     
    }}

   //redirigir al index.php
   header('Location: index.php');

   ?>