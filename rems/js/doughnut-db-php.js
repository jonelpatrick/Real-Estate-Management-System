$(document).ready(function(){
 
 realtimeChart();
 function realtimeChart(){
	$.ajax({
		url : "http://localhost/rems-website/rems/pages/api/data.php",
		type : "GET",
		success : function(data) {

			console.log(data[1]['score']);
			
			var score = {
				TeamA : [],
				TeamB : []
			};

			var len = 2;
			value1 = data[0]['score'];
			value2 = data[1]['score'];
			for (var i = 0; i < len; i++) {
					score.TeamA.push(7);
					score.TeamB.push(93);
					
					
				
			}

			var ctx1 = $("#doughnut-chartcanvas-1");
			

			var data1 = {
				labels : ["match1", "match2"],
				datasets : [
					{
						label : "Property Tra",
						data : score.TeamA,
						backgroundColor : [
		                    "#DEB887",
		                    "#A9A9A9",
		                   
		                ],
		                borderColor : [
		                    "#CDA776",
		                    "#989898",
		                    
		                ],
		                borderWidth : [1, 1, 1, 1, 1]
					}
				]
			};

			

			var options1 = {
				title : {
					display : true,
					position : "top",
					text : "Doughnut Chart - TeamA Score",
					fontSize : 18,
					fontColor : "#111"
				},
				legend : {
					display : true,
					position : "bottom"
				}
			};

			var options2 = {
				title : {
					display : true,
					position : "top",
					text : "Doughnut Chart - TeamB Score",
					fontSize : 18,
					fontColor : "#111"
				},
				legend : {
					display : true,
					position : "bottom"
				}
			};

			var chart1 = new Chart( ctx1, {
				type : "doughnut",
				data : data1,
				options : options1
			} );

			
		}
	
	});
  }
  //setInterval(function(){realtimeChart()}, 2000);
})