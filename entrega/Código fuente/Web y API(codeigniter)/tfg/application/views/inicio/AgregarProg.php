<center><h1>Programación de las horas de riego</h1></center>
<div><hr></div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<center>
			<?php
				$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/programacion'));//poner base_url()
				foreach ($query as $row) {
					echo $row->IDProg . ": ";echo $row->Zona . "->Inicio: ";echo $row->Hora_ini . "->Fin: ";echo $row->Hora_fin . "<br/>";
				}
			?>
			</center>
		</div>
	</div>
</div>
<div><hr></div>
<div class="container">
	<?php echo form_open(base_url() . "inicio/agregarProg"); ?>
	<!--<form action="http://localhost/tfg/api/v0/arduino" method="post">-->
   		<div>
   			<center>
   			<label for="nID">ID:</label>
   			<select name="nID">    
       			<option value="1" selected="selected">1</option>
       			<option value="2">2</option>
       			<option value="3">3</option>
       			<option value="4">4</option>
   			</select>

   			<label for="nInicio">Inicio:</label>
   			<input type="text" name="nInicio" maxlength="5"/>    

   			<label for="nFin">Fin:</label>
   			<input type="text" name="nFin" maxlength="5"/> 
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