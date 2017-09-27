$(document).ready(function() {
				
				$('.grafica').highcharts({
			        title: {
			            text: 'Historial',
			            x: -20 //center
			        },
			        subtitle: {
			            text: 'pepito',
			            x: -20
			        },
			        xAxis: {
			            categories: ['Enero','Febrero', 'Marzo']
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
			        	{name: 'Temperatura',
				        data:[15,18,20]
				    },
				    {name: 'Humedad del Aire',
				        data:[60,50,40]
				    },
				    {name: 'Litros',
				        data:[20,60,50]
				    },
				    ]
				  
			    });
			
});
