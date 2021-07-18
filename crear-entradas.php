<?php require_once './includes/redirect.php'; ?>
<?php  require_once './includes/cabecera.php'; ?>     
<?php  require_once './includes/lateral.php'; ?>


 <!--DIV PRINCIPAL -->
 <div id="principal">
    <h1>Crear entradas</h1>
    <p>
      Añade nuevas entradas para que los demas usuarios puedan leerlas y 
      disfrutrar nuestro contenido.
          </p>
    </br>
    <form action="guardar-entradas.php" method="POST">

       <label for="nombre">Título: </label>
       <input type="text" name="titulo" />
      <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'titulo') : ' '; ?>

       <label for="nombre">Descripción: </label>
       <textarea name="descripcion"></textarea>
       <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'descripcion') : ' '; ?>

       <label for="categoria">Categoria: </label>
       <select name="categoria">
       <?php 
        $categorias = conseguirCategorias($db);
        if(!empty($categorias)) :
        while($categoria = mysqli_fetch_assoc($categorias)) :
       ?>

       <option value="<?=$categoria['id']?>">
           <?= $categoria['nombre'] ?>
       </option>

       <?php 
       endwhile;
        endif;
       ?>
                 
       </select>
       <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'categoria') : ' '; ?>

       <input type="submit" value="Guardar" />
    
    </form>
    <?php borrarErrores(); ?>
 </div>
 <!-- FIN DIV PRINCIPAL -->


 <?php require_once 'includes/pie.php'; ?>