<?php

//*Conectar la base de datos
$host = "localhost"; /*servidor */
$user = "root"; /*usuario */
$password = ""; /*contraseña */
$database = "blog_manuel"; /*base de datos */

$db = mysqli_connect($host, $user, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'");


// INICIAR LA SESIÓN

if(!isset($_SESSION)){
    
    session_start();

}
else{
    session_destroy();
}
