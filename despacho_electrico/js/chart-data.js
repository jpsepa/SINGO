var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};
	
	var lineChartData = {
			labels : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(48, 164, 255, 0.2)",
					strokeColor : "rgba(48, 164, 255, 1)",
					pointColor : "rgba(48, 164, 255, 1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(48, 164, 255, 1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				}
			]

		}
		
	var barChartData = {
			labels : ["Julio 2014","Agosto 2014","Septiembre 2014","Octubre 2014","Noviembre 2014","Diciembre 2014","Enero 2015","Febrero 2015","Marzo 2015","Abril 2015","Mayo 2015","Junio 2015"],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,0.8)",
					highlightFill: "rgba(220,220,220,0.75)",
					highlightStroke: "rgba(220,220,220,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				}
			]
	
		}

	var barChartData2 = {
			labels : ["Julio 2014","Agosto 2014","Septiembre 2014","Octubre 2014","Noviembre 2014","Diciembre 2014","Enero 2015","Febrero 2015","Marzo 2015","Abril 2015","Mayo 2015","Junio 2015"],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,0.8)",
					highlightFill: "rgba(220,220,220,0.75)",
					highlightStroke: "rgba(220,220,220,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),0,0]
				}
			]
	
		}

	var pieData = [
				{
					value: 300,
					color:"#013781",
					highlight: "#013781",
					label: "SSEC"
				},
				{
					value: 50,
					color: "#ffb53e",
					highlight: "#fac878",
					label: "ASSIGNIA"
				},
				{
					value: 100,
					color: "#ffffff",
					highlight: "#ffffff",
					label: "BESALCO"
				}

			];

	var pieData2 = [
				{
					value: 100,
					color:"#013781",
					highlight: "#013781",
					label: "SSEC"
				},
				{
					value: 50,
					color: "#ffb53e",
					highlight: "#fac878",
					label: "ASSIGNIA"
				},
				{
					value: 80,
					color: "#ffffff",
					highlight: "#ffffff",
					label: "BESALCO"
				}

			];
			
	var doughnutData = [
				{
					value: 300,
					color:"#30a5ff",
					highlight: "#62b9fb",
					label: "Blue"
				},
				{
					value: 50,
					color: "#ffb53e",
					highlight: "#fac878",
					label: "Orange"
				},
				{
					value: 100,
					color: "#1ebfae",
					highlight: "#3cdfce",
					label: "Teal"
				},
				{
					value: 120,
					color: "#f9243f",
					highlight: "#f6495f",
					label: "Red"
				}
			];
			
	var radarData = {
	    labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
	    datasets: [
	        {
	            label: "My First dataset",
	            fillColor: "rgba(220,220,220,0.2)",
	            strokeColor: "rgba(220,220,220,1)",
	            pointColor: "rgba(220,220,220,1)",
	            pointStrokeColor: "#fff",
	            pointHighlightFill: "#fff",
	            pointHighlightStroke: "rgba(220,220,220,1)",
	            data: [65, 59, 90, 81, 56, 55, 40]
	        },
	        {
	            label: "My Second dataset",
	            fillColor : "rgba(48, 164, 255, 0.2)",
	            strokeColor : "rgba(48, 164, 255, 0.8)",
	            pointColor : "rgba(48, 164, 255, 1)",
	            pointStrokeColor : "#fff",
	            pointHighlightFill : "#fff",
	            pointHighlightStroke : "rgba(48, 164, 255, 1)",
	            data: [28, 48, 40, 19, 96, 27, 100]
	        }
	    ]
	};
	var polarData = [
		    {
		    	value: 300,
		    	color:"#30a5ff",
		    	highlight: "#62b9fb",
		    	label: "Blue"
		    },
		    {
		    	value: 140,
		    	color: "#ffb53e",
		    	highlight: "#fac878",
		    	label: "Orange"
		    },
		    {
		    	value: 220,
		    	color: "#1ebfae",
		    	highlight: "#3cdfce",
		    	label: "Teal"
		    },
		    {
		    	value: 250,
		    	color: "#f9243f",
		    	highlight: "#f6495f",
		    	label: "Red"
		    }
		
	];

