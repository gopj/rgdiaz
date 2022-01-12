<div class="span9 filemg"  >
<p><i class="fas fa-angle-right"></i> /RicardoDiaz/<b>Documentos</b></p>
  <table id="tabla" class="display">
    <tbody>
      <?php foreach ($carpetas->result() as $carpe) { ?>
        <tr>
          <td>
            <form method='post' action="<?php echo site_url('administrador/versubcarpeta');?>">
              <img src='img/iconos/folder.png' class="folder"><br>
              <input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona"/>
              <input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta" >
              <input class="nombre-carpeta"  type="submit" value="<?php echo $carpe->nombre?>">
            </form>
          </td>     
      <?php } ?>
    </tbody>
  </table>
</div>
