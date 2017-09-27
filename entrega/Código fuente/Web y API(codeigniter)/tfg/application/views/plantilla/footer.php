<hr>
<center>&copy copyright 2017 - TFG realizado por Francisco Javier Solís Franco, todos los derechos reservados.</center>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<!--<script src="<?php  base_url(); ?>assets/js/graf.js"></script> poner echo en base-->
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<script>
$(document).ready(function() {
				
				$('.grafica').highcharts({
			        title: {
			            text: 'Historial',
			            x: -20 //center
			        },
			        subtitle: {
			            text: <?php $query = json_decode(file_get_contents('http://localhost/tfg/api/v0/config/id/A'));
			            		foreach ($query as $row) { 
			    						echo "'";echo $row->Zona . "'";
			    				}?>,//mostrar zona
			            x: -20
			        },
			        xAxis: {
			            categories: [
			            			<?php
			    					$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/A'));
			    					foreach ($query as $row) { 
			    						echo "'";echo $row->Fecha . "',";
			    					}
			    					?>
			            			]
			        },
			        yAxis: {
			            title: {
			                text: 'Temperatura (°C), Humedad (%) y Litros'
			            },
			            plotLines: [{
			                value: 0,
			                width: 1,
			                color: '#808080'
			            }]
			        },
			        /*tooltip: {
			            valueSuffix: '°C'
			        },*/
			        legend: {
			            layout: 'vertical',
			            align: 'right',
			            verticalAlign: 'middle',
			            borderWidth: 0
			        },
			        series:[
			        	{
			        	name: 'Temperatura',
				        data:[<?php
			    				//$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/A'));
			    				foreach ($query as $row) { 
			    					echo $row->Temperatura . ",";
			    				}
			    			?>]
				    	},
				    	{
			        	name: 'Humedad del Aire',
				        data:[<?php
			    				$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/A'));
			    				foreach ($query as $row) { 
			    					echo $row->Hum_Aire . ",";
			    				}
			    			?>]
				    	},
				    	{
			        	name: 'Litros',
				        data:[<?php
			    				$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/A'));
			    				foreach ($query as $row) { 
			    					echo $row->Litros . ",";
			    				}
			    			?>]
				    	}
				    ]
				  
			    });

				$('.grafica2').highcharts({
			        title: {
			            text: 'Historial',
			            x: -20 //center
			        },
			        subtitle: {
			            text: <?php $query = json_decode(file_get_contents('http://localhost/tfg/api/v0/config/id/B'));
			            		foreach ($query as $row) { 
			    						echo "'";echo $row->Zona . "'";
			    				}?>,
			            x: -20
			        },
			        xAxis: {
			            categories: [
			            			<?php
			    					$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/B'));
			    					foreach ($query as $row) { 
			    						echo "'";echo $row->Fecha . "',";
			    					}
			    					?>]
			        },
			        yAxis: {
			            title: {
			                text: 'Temperatura (°C), Humedad (%) y Litros'
			            },
			            plotLines: [{
			                value: 0,
			                width: 1,
			                color: '#808080'
			            }]
			        },
			        /*tooltip: {
			            valueSuffix: '°C'
			        },*/
			        legend: {
			            layout: 'vertical',
			            align: 'right',
			            verticalAlign: 'middle',
			            borderWidth: 0
			        },
			        series:[
			        	{
			        	name: 'Temperatura',
				        data:[<?php
			    				//$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/A'));
			    				foreach ($query as $row) { 
			    					echo $row->Temperatura . ",";
			    				}
			    			?>]
				    	},
				    	{
			        	name: 'Humedad del Aire',
				        data:[<?php
			    				//$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/A'));
			    				foreach ($query as $row) { 
			    					echo $row->Hum_Aire . ",";
			    				}
			    			?>]
				    	},
				    	{
			        	name: 'Litros',
				        data:[<?php
			    				//$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/A'));
			    				foreach ($query as $row) { 
			    					echo $row->Litros . ",";
			    				}
			    			?>]
				    	}
				    ]
				  
			    });
				
				$('.grafica3').highcharts({
			        title: {
			            text: 'Historial',
			            x: -20 //center
			        },
			        subtitle: {
			            text: <?php $query = json_decode(file_get_contents('http://localhost/tfg/api/v0/config/id/C'));
			            		foreach ($query as $row) { 
			    						echo "'";echo $row->Zona . "'";
			    				}?>,
			            x: -20
			        },
			        xAxis: {
			            categories: [<?php
			    					$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/C'));
			    					foreach ($query as $row) { 
			    						echo "'";echo $row->Fecha . "',";
			    					}
			    					?>]
			        },
			        yAxis: {
			            title: {
			                text: 'Temperatura (°C), Humedad (%) y Litros'
			            },
			            plotLines: [{
			                value: 0,
			                width: 1,
			                color: '#808080'
			            }]
			        },
			        /*tooltip: {
			            valueSuffix: '°C'
			        },*/
			        legend: {
			            layout: 'vertical',
			            align: 'right',
			            verticalAlign: 'middle',
			            borderWidth: 0
			        },
			        series:[
			        	{
			        	name: 'Temperatura',
				        data:[<?php
			    				//$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/A'));
			    				foreach ($query as $row) { 
			    					echo $row->Temperatura . ",";
			    				}
			    			?>]
				    	},
				    	{
			        	name: 'Humedad del Aire',
				        data:[<?php
			    				//$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/A'));
			    				foreach ($query as $row) { 
			    					echo $row->Hum_Aire . ",";
			    				}
			    			?>]
				    	},
				    	{
			        	name: 'Litros',
				        data:[<?php
			    				//$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/A'));
			    				foreach ($query as $row) { 
			    					echo $row->Litros . ",";
			    				}
			    			?>]
				    	}
				    ]
				  
			    });
				
				$('.grafica4').highcharts({
			        title: {
			            text: 'Historial',
			            x: -20 //center
			        },
			        subtitle: {
			            text: <?php $query = json_decode(file_get_contents('http://localhost/tfg/api/v0/config/id/D'));
			            		foreach ($query as $row) { 
			    						echo "'";echo $row->Zona . "'";
			    				}?>,
			            x: -20
			        },
			        xAxis: {
			            categories: [<?php
			    					$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/D'));
			    					foreach ($query as $row) { 
			    						echo "'";echo $row->Fecha . "',";
			    					}
			    					?>]
			        },
			        yAxis: {
			            title: {
			                text: 'Temperatura (°C), Humedad (%) y Litros'
			            },
			            plotLines: [{
			                value: 0,
			                width: 1,
			                color: '#808080'
			            }]
			        },
			        /*tooltip: {
			            valueSuffix: '°C'
			        },*/
			        legend: {
			            layout: 'vertical',
			            align: 'right',
			            verticalAlign: 'middle',
			            borderWidth: 0
			        },
			        series:[
			        	{
			        	name: 'Temperatura',
				        data:[<?php
			    				//$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/A'));
			    				foreach ($query as $row) { 
			    					echo $row->Temperatura . ",";
			    				}
			    			?>]
				    	},
				    	{
			        	name: 'Humedad del Aire',
				        data:[<?php
			    				//$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/A'));
			    				foreach ($query as $row) { 
			    					echo $row->Hum_Aire . ",";
			    				}
			    			?>]
				    	},
				    	{
			        	name: 'Litros',
				        data:[<?php
			    				//$query = json_decode(file_get_contents('http://localhost/tfg/api/v0/estadistica/id/A'));
			    				foreach ($query as $row) { 
			    					echo $row->Litros . ",";
			    				}
			    			?>]
				    	}
				    ]
				  
			    });
});
</script>
</body>
</html>