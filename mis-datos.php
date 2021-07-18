<?php require_once './includes/redirect.php'; ?>
<?php  require_once './includes/cabecera.php'; ?>     
<?php  require_once './includes/lateral.php'; ?>

<!--DIV PRINCIPAL -->
<div id="principal">
<div id="register" class="block-aside">
        

             <h3>Regístrate</h3>
             <!--Mostrar errores -->
             <?php if(isset($_SESSION['completado'])) : ?>
               <div class="alerta alerta-exito">
                   <?=$_SESSION['completado']; ?>                  
               </div> 

            <?php   elseif(isset($_SESSION['errores']['general'])): ?> 
                <div class="alerta alerta-exito">
                   <?=$_SESSION['errores']['general']; ?>                  
               </div> 
                <?php   endif; ?>  
             
             <form action="actualizar-usuario.php" method="POST">

             <label for="nombre">Nombre</label>
             <input type="text" name="nombre" value="<?=$_SESSION['usuario']['nombre'] ?>"/>
             <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre') : ''; ?>

             <label for="apellido">Apellido</label>
             <input type="text" name="apellido" value="<?=$_SESSION['usuario']['apellidos'] ?>"/>
             <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'apellido') : ''; ?>

             <label for="email">Email</label>
             <input type="email" name="email" value="<?=$_SESSION['usuario']['email'] ?>"/>
             <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'email') : ''; ?>
             
             <input type="submit" name="submit" value="Actualizar">
             </form>
             <?php borrarErrores(); ?>
</div>
<!-- FIN DIV PRINCIPAL -->


 <?php require_once 'includes/pie.php'; ?>