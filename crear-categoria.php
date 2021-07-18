<?php require_once './includes/redirect.php'; ?>
<?php  require_once './includes/cabecera.php'; ?>     
<?php  require_once './includes/lateral.php'; ?>


 <!--DIV PRINCIPAL -->
 <div id="principal">
    <h1>Crear categoria</h1>
    <p>
      Añade nuevas categorias para que los demas usuarios puedan usarlas 
      al crear sus entradas.
    </p>
    </br>
    <form action="guardar-categoria.php" method="POST">
       <label for="nombre">Nombre de la categoria: </label>
       <input type="text" name="nombre" />

       <input type="submit" value="Guardar" />
    
    </form>
 </div>
 <!-- FIN DIV PRINCIPAL -->


 <?php require_once 'includes/pie.php'; ?>