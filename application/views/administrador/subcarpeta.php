          <div class="span9">
            <center><legend>Administrar Carpetas</legend>
            Ubicación: <strong style="font-family:Californian FB;color:#4249D6; font-size:20px;"><?php echo $direccion_real; ?></strong><br/>
            </center>
            <table id="tabla" class="display">
              <thead>
                <tr>
                  <th style="width:5%;"></th>
                  <th style="width:45%;">Nombre</th>
                  <th style="width:20%;">Fecha</th>
                  <th style="width:30%;">Acciones</th>
                </tr>
              </thead>
              <tbody>
                    <?php 
                      foreach ($carpetas->result() as $carpe) {
                        echo "<tr>";
                        echo "<td><center><img src='img/iconos/folder.png'></center></td>";
                    ?>
                    <td>
                      <form method='post' action="<?php echo site_url('administrador/versubcarpeta');?>">
                        <input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona"/>
                        <input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta" >
                        <input class="nombre-carpeta"  type="submit" value="<?php echo $carpe->nombre?>">
                      </form>
                    </td>
                    <td><?php echo $carpe->fecha_creada; ?></td>
                    <td align="center">
                      <div class="row-fluid" style="margin-top:10px;">
                        <div class="span4">
                        <form method='post' action="<?php echo site_url('administrador/versubcarpeta'); ?>">
                          <input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona">
                          <input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta">
                          <input class="btn btn-mini btn-primary"  type="submit" value="Ver Carpeta">
                        </form>
                        </div>
                        
                        <?php 
                         if ( $carpe->nombre != "Documentos de RDiaz" ) {
                        ?> 

                        <div class="span4">
                          <input type="hidden" value="<?php echo $carpe->id_carpeta.$carpe->nombre; ?>" id="id_formulario_renombra">                       
                        <form id="<?php echo $carpe->id_carpeta.$carpe->nombre; ?>" method='post' action="<?php echo site_url('administrador/renombrar_carpeta'); ?>">
                          <input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona">
                          <input type="hidden" value="<?php echo $carpe->nombre; ?>" name="nombre_carpeta">
                          <input type="hidden" name="nombre_nuevo" id="<?php echo $carpe->nombre.$carpe->id_carpeta; ?>">
                          <input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta">
                          <input type="hidden" value="<?php echo $carpe->ruta_anterior; ?>" name="ruta_anterior">
                          <input type="button" class="btn btn-mini btn-primary" onclick="abrir_modal('<?php echo $carpe->id_carpeta.$carpe->nombre; ?>', '<?php echo $carpe->nombre.$carpe->id_carpeta; ?>');" value="Renombrar">
                        </form>
                        </div>
                        <div class="span4">
                            <form id="form_eliminar_carpeta" method='post' action="<?php echo site_url('administrador/eliminar_carpeta'); ?>">
                              <input type="hidden" value="<?php echo $carpe->id_persona; ?>" id="id_persona" name="id_persona">
                              <input type="hidden" value="<?php echo $carpe->id_carpeta; ?>" id="id_carpeta" name="id_carpeta">
                              <input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" id="ruta_carpeta" name="ruta_carpeta">
                              <input type="hidden" value="<?php echo $carpe->ruta_anterior; ?>" id="ruta_carpeta" name="ruta_anterior">
                              <input class="btn btn-mini btn-primary"  type="submit"  value="Eliminar">
                            </form>
                        </div>
                      </div>
                    </td>        
                    <?php

                        }
                        echo "</tr>";
                      }
                    ?> 
                    <?php 
                      foreach ($archivo->result() as $arch) {
                        echo "<tr>";
                          $ext = explode('.', $arch->nombre);
                          $extencion = array_pop($ext);
                          if($extencion=='pdf'){
                            echo "<td><center><img src='img/iconos/pdf.png'></center></td>";
                          }elseif($extencion=='xls' || $extencion=='xlsx'){
                            echo "<td><center><img src='img/iconos/xls.png'></center></td>";
                          }elseif($extencion=='doc'|| $extencion=='docx'){
                            echo "<td><center><img src='img/iconos/doc.png'></center></td>";
                          }elseif($extencion=='jpg' || $extencion=='JPG'){
                            echo "<td><center><img src='img/iconos/jpg.png'></center></td>";
                          }elseif($extencion=='jpeg' || $extencion=='JPEG'){
                            echo "<td><center><img src='img/iconos/jpeg.png'></center></td>";
                          }elseif($extencion=='png' || $extencion=='PNG'){
                            echo "<td><center><img src='img/iconos/png.png'></center></td>";
                          }elseif($extencion=='gif'){
                            echo "<td><center><img src='img/iconos/gif.png'></center></td>";
                          }elseif($extencion=='txt'){
                            echo "<td><center><img src='img/iconos/txt.png'></center></td>";
                          } else {
                            echo "<td><center><img src='img/iconos/unk.png'></center></td>";
                          }
                        echo "<td>".$arch->nombre."</td>";
                        echo "<td>".$arch->fecha_subida."</td>";
                        $array_ruta = explode("/", $arch->ruta_archivo);
                        $id_per_arc = $array_ruta[1];
                    ?>
                      <td align="center">
                        <div class="row-fluid" style="margin-top:10px;">
                          <div class="span6">
                          <form method='post' action="<?php echo site_url('administrador/descargar'); ?>">
                            <input type="hidden" value="<?php echo $arch->nombre; ?>" name="nombre">
                            <input type="hidden" value="<?php echo $arch->ruta_archivo; ?>" name="ruta_archivo">
                            <input class="btn btn-mini btn-primary"  type="submit" value="Descargar">
                          </form>
                          </div>
                          <div class="span6">
                          <form id="form_eliminar" method='post' action="<?php echo site_url('administrador/eliminar_archivo');?>">
                            <input type="hidden" value="<?php echo $id_per_arc; ?>" name="id_persona">
                            <input type="hidden" value="<?php echo $arch->id_archivo; ?>" name="id_archivo">
                            <input type="hidden" value="<?php echo $arch->ruta_archivo; ?>" name="ruta_archivo" >
                            <input type="hidden" value="<?php echo $arch->ruta_carpeta_pertenece; ?>" name="ruta_carpeta_pertenece" >
                            <input class="btn btn-mini btn-primary"  type="submit"  value="Eliminar">
                          </form>
                          </div>
                        </div>
                      </td>
                    <?php                                         
                        echo "</tr>";
                      }
                    ?>            
              </tbody>
            </table>
            <div class="row-fluid">
               <?php if($anterior == "administrador/") { ?>
                <div class="span2" style="margin-top:20px;">
                  <form method="post" action="<?php echo site_url('administrador');?>">
                    <input type="submit" class="btn btn-primary" value="Regresar">
                  </form>
                </div>
                <?php } else if($raiz==$anterior) { ?>
                <div class="span2" style="margin-top:20px;">
                  <form method="post" action="<?php echo site_url('administrador/subir_archivo');?>">
                    <input type="submit" class="btn btn-primary" value="Regresar">
                  </form>

              </div>
              <?php } else { ?>
              <div class="span2" style="margin-top:20px;">
                <form method="post" action="<?php echo site_url('administrador/versubcarpeta');?>">
                  <input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona">
                  <input type="hidden" value="<?php echo $anterior; ?>" name="ruta_carpeta">
                  <input type="submit" class="btn btn-primary" value="Regresar">
                </form>
              </div>
              <?php } ?> 
              <div class="span3" style="margin-top:20px;">
                <button class="btn btn-primary" href="#cate" data-toggle="modal" >Agregar Nueva Carpeta</button>
              </div> 
              <div class="span3" style="margin-top:20px;">
                <button class="btn btn-primary" href="#upload" data-toggle="modal">Agregar Archivo(s)</button>
              </div>
            </div>  
          </div>
        </div>
      </div>

      <div id="cate" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <big style="font-weight:bold;">Agregar Carpeta</big>
            </div>
            <form id="form_carp" action="<?php echo site_url('administrador/crearsubcarpeta');?>" method="post">
              <div class="modal-body">
                  <input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona"/>
                  <input type="hidden" value="<?php echo $direccion; ?>" name="direccion"/>
                  Nombre de la carpeta:
                  <div class='input-prepend'>
                    <span class='add-on'>
                        <img src="img/glyphicons_144_folder_open.png" class="icon-form">
                    </span>
                    <input id="nombrecarpeta" class="txt-modal" type='text' name="nombrecarpeta">
                  </div>
              </div>
              <div class="modal-footer">
                  <input type="button" class="btn btn-primary" onclick="valida_nom_carpeta()" value="Crear Carpeta">
              </div>
            </form>
        </div>

        <div id="upload" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <big style="font-weight:bold;">Subir Archivo(s)</big>
            </div>
            <form id="form_archivo" method="post" action="<?php echo site_url('administrador/subirarchivo');?>" enctype="multipart/form-data">
              <div class="modal-body">
                  Haz click en el boton para seleccionar archivo(s)
                  <br>
                  <input type="hidden" value="<?php echo $direccion; ?>" name="direccion"/>
                  <input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona"/>
                  <input type="hidden" value="<?php echo $direccion; ?>" name="ruta_carpeta">
                  <input  id="name" class="input-file" readonly/>
                  <label for="file" class="btn btn-primary" >Seleccionar</label>
                  <input id="file" type="file" name="archivo[]" multiple="multiple">
              </div>
              <div class="modal-footer">
                   <input type="button" class="btn btn-primary" onclick="valida_archivo()" value="Guardar Archivos">
              </div>
            </form>
        </div>

        <div id="renombrar" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <big style="font-weight:bold;">Renombrar Carpeta</big>
            </div>
              <div class="modal-body">
                Nombre de la carpeta:
                  <div class='input-prepend'>
                    <span class='add-on'>
                        <img src="img/glyphicons_144_folder_open.png" class="icon-form">
                    </span>
                    <input type="text" class="txt-modal" id="nuevo_nombre">
                  </div>
              </div>
              <div class="modal-footer">
                   <input type="button" class="btn btn-primary" onclick="renombrar_carpeta();" value="Cambiar">
              </div>
        </div>
        
        <script>
          var id_formulario_renombrar;
          var id_hidden_nuevo_nombre;
          function abrir_modal(id_formulario, id_hidden)
          {
            id_formulario_renombrar = id_formulario;
            id_hidden_nuevo_nombre = id_hidden;
            $('#renombrar').modal('show');
          }
          function renombrar_carpeta()
          {
            if(document.getElementById('nuevo_nombre').value == "")
            {
              alert('EL CAMPO NOMBRE ES REQUERIDO');
              document.getElementById('nuevo_nombre').focus();
            }
            else
            {
              document.getElementById(id_hidden_nuevo_nombre).value = document.getElementById('nuevo_nombre').value;
              document.getElementById(id_formulario_renombrar).submit();
            }
          }
        </script>