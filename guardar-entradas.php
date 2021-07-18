<?php

if(isset($_POST)){
    //CONEXIÓN A LA BASE DE DATOS

    require_once 'includes/conexion.php'; 

    //Ternaria 

    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false; 
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false; 
    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false; 
    $usuario = $_SESSION['usuario']['id'];


    //array de errores

   $errores = array();
  

   // validar datos antes de guardarlos en al base de datos 
   
   //Validar campo de Nombre


   if(empty($titulo)){
       $errores['titulo'] = 'El título no es válido';
   }
   
   if(empty($descripcion)){
    $errores['descripcion'] = 'La descripcion no es válida';
   }

   if(empty($categoria) && !is_numeric($categoria)){
    $errores['categoria'] = 'La categoria no es válida';
   }

   if(count($errores)== 0){
       if(isset($_GET['editar'])){
           $entrada_id = $_GET['editar'];
           $usuario_id = $_SESSION['usuario']['id'];
        $sql = "UPDATE entradas SET titulo='$titulo', descripcion='$descripcion', categorias_id=$categoria
        WHERE id= $entrada_id AND usuarios_id = $usuario_id";



       }else{
     $sql = "INSERT INTO entradas VALUES(null, $usuario, $categoria, '$titulo', '$descripcion', CURDATE());";

    }
     $guardar = mysqli_query($db, $sql);
   
     header("Location: index.php");
     }
     else{
         $_SESSION["errores_entrada"] = $errores;
         if(isset($_GET['editar'])){

         header("Location: editar-entrada.php?id".$_GET['editar']);
         }else{
            header("Location: crear-entradas.php");
         }
     }


   
   
}

