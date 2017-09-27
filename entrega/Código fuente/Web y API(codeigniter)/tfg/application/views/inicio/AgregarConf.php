<center><h1>Configuración de las zonas de riego</h1></center>
<div><hr></div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
			<?php
				$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/config'));//poner base_url()
				foreach ($query as $row) {
					echo $row->IDArduino . ": ";echo $row->Zona . "<br/>";
				}
			?>
			</center>
		</div>
	</div>
</div>
<div><hr></div>
<div class="container">
	<?php echo form_open(base_url() . "inicio/agregarConf"); ?>
	<!--<form action="http://localhost/tfg/api/v0/arduino" method="post">-->
   		<div>
   			<center>
   			<label for="nID">ID:</label>
   			<select name="nID">    
       			<option value="A" selected="selected">A</option>
       			<option value="B">B</option>
       			<option value="C">C</option>
       			<option value="D">D</option>
   			</select>
   			<label for="nZona">Zona:</label>
   			<select name="nZona">    
       			<option value="Default" selected="selected">Default</option>
       			<option value="Tomates">Tomates</option>
       			<option value="Olivos">Olivos</option>
       			<option value="Viña">Viña</option>
       			<option value="Huerto">Huerto</option>
   			</select>
   			</center>
   		</div>
   		<div>
   			<center>
   				<button type="submit">Guardar</button>
   			</center>
   		</div>
	<!--</form>-->
	<?php echo form_close();?>
</div>