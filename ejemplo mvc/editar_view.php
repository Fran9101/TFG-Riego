
      <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Socios</h5>
                <ol class="breadcrumb">
                    <li><a href="<?=site_url('socios')?>">Socios</a></li>
                    <li class="active">Editando <?=$socio->nombre." ".$socio->apellidos?></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        

        <!--start container-->
        <div class="container">
          <div class="section">
            
            <div class="row">
              <!-- Form with validation -->
              <div class="col s12 m12 l12">
                <div class="card-panel">
                  <h4 class="header2">Datos del socio</h4>
                  <p><?php echo validation_errors('<div class="error">', '</div>'); ?></p>
                  <div class="row">
                  
                  <center>
					         <?php if(!file_exists('./assets/images/socios/'.$socio->idsocios.'.jpg')) { ?>
                                <img class="circle responsive-img" src="<?=site_url('assets/images/avatar_unknown.png');?>" />
                                <?php } else { ?>
                                <img class="materialboxed" width="200px" src="<?=site_url('assets/images/socios/'.$socio->idsocios.'.jpg');?>" />
                                <?php } ?>
                   </center>
                    <form class="col s12" action="<?=site_url('socios/edit/'.$socio->idsocios)?>" method="POST">
                    
                      <input id="editar" name="editar" type="hidden" value="true">
                      <input id="idsocios" name="idsocios" type="hidden" value="<?=$socio->idsocios?>">
                      <div class="row">
                      
                        <div class="input-field col s6">
                          <i class="mdi-action-account-circle prefix"></i>
                          <input id="nombre" name="nombre" class="validate" type="text" value="<?=$socio->nombre?>">
                          <label for="nombre">Nombre *</label>
                        </div>
                        <div class="input-field col s6">
                          <input id="apellidos" name="apellidos" class="validate" type="text" value="<?=$socio->apellidos?>">
                          <label for="apellidos">Apellidos *</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s6">
                          <i class="mdi-action-credit-card prefix"></i>
                          <input id="dni" name="dni" class="validate" type="text" value="<?=$socio->dni?>">
                          <label for="dni">DNI *</label>
                        </div>
                        <div class="input-field col s6">
                        <select id="idnacionalidad" name="idnacionalidad">
                          <option value="" disabled="disabled">Selecciona una nacionalidad</option>
                          <?php foreach($nacionalidades as $nacionalidad) { ?>
                            <option value="<?=$nacionalidad->id?>" <?php if($nacionalidad->id==$socio->idnacionalidad) echo 'selected="selected"';?>><?=$nacionalidad->nombre?></option>
                          <?php } ?>
                        </select>
                        <label for="idnacionalidad">Nacionalidad</label>
                      </div>
                      </div>
                      <div class="row">
                        
                        <div class="input-field col s12">
                          <i class="mdi-communication-location-on prefix"></i>
                          <input id="direccion" name="direccion" class="validate" type="text" value="<?=$socio->direccion?>">
                          <label for="direccion">Dirección *</label>
                        </div>

                      </div>
                      <div class="row">
                        <div class="input-field col s4">
                          <i class="mdi-communication-email prefix"></i>
                          <input id="email" name="email" class="validate" type="email">
                          <label for="email">Email</label>
                        </div>
                        <div class="input-field col s4">
                          <i class="mdi-communication-phone prefix"></i>
                          <input id="tlf1" name="tlf1" class="validate" type="text" value="<?=$socio->tlf1?>">
                          <label for="tlf1">Teléfono</label>
                        </div>
                        <div class="input-field col s4">
                          <i class="mdi-communication-ring-volume prefix"></i>
                          <input id="tlf2" name="tlf2" class="validate" type="text" value="<?=$socio->tlf2?>">
                          <label for="tlf2">Tfno. Urgencia</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s6"> 
                            <i class="mdi-action-event prefix"></i>                         
                            <input type="date" class="datepicker" id="fechanac" name="fechanac" value="<?=$socio->fechanac?>">
                            <label class="active" for="fechanac">Fecha nacimiento *</label>
                          </div>
                          <div class="input-field col s6">
                            <select id="sexo" name="sexo">
                            <option value="h" <?php if($socio->sexo=="h") echo 'selected="selected"';?>>Hombre</option>
                            <option value="m" <?php if($socio->sexo=="m") echo 'selected="selected"';?>>Mujer</option>
                          </select>
                          <label for="sexo">Sexo</label>
                          </div>
                      </div>
                  
                      
                      <div class="row">
                        <div class="input-field col s6">
                          <i class="mdi-maps-local-hospital  prefix"></i>
                          <input id="enfermedades" name="enfermedades" class="validate" type="text" value="<?=$socio->enfermedades?>">
                          <label for="enfermedades">Enfermedades</label>
                        </div>
                        <div class="input-field col s6">
                          <i class="prefix"></i>
                          <input id="alergias" name="alergias" class="validate" type="text" value="<?=$socio->alergias?>">
                          <label for="alergias">Alergias / intolerancias</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-question-answer prefix"></i>
                          <textarea id="observaciones" name="observaciones" class="materialize-textarea validate" length="1000"><?=$socio->observaciones?></textarea>
                          <label for="observaciones">Observaciones</label>
                        </div>
                        <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-account-circle prefix"></i>
                          <? if($socio->animador==1){
                           		echo '<input id="animador" name="animador" class="validate" type="checkbox" checked="checked">';
						  	}else{
							   	echo '<input id="animador" name="animador" class="validate" type="checkbox" >';
							  }
						  ?>
                          <label for="animador">¿Es animador?</label>
                        </div>
                      </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <button class="btn red waves-effect waves-light right" type="submit" name="submit">Guardar
                              <i class="mdi-content-send right"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /Form with validation -->
            </div>
          

          </div>
          
        </div>
      
        <!--end container-->
      </section>
      <!-- END CONTENT -->

