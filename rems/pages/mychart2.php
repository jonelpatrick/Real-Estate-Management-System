<?php
include '../dbconnect/connect.php';

 //initialize hidden value


	$sql = "SELECT COUNT( * ) available
      FROM  `property` 
      WHERE availability = 0 ";

   $result = mysqli_query($mysqli,$sql);
    if (mysqli_num_rows($result) > 0) { 
       
       while($row = mysqli_fetch_assoc($result)) {

        $remaining = $row['available'];
       }
   }



	 $sql = "SELECT COUNT( * ) sold
       FROM  `property` 
       WHERE availability = 1 ";

   $result = mysqli_query($mysqli,$sql);
    if (mysqli_num_rows($result) > 0) { 
       
       while($row = mysqli_fetch_assoc($result)) {

        $sold = $row['sold'];
       }
   }



?>
<!DOCTYPE HTML>
<html>
<head>
<script type="text/javascript">
window.onload = function () {
	//var value1 = Number(document.getElementById('inputSold').value);//sold
	//var value2 = Number(document.getElementById('inputRemaining').value);//remaining
	var value1 = Number(<?php echo $sold; ?>);
	var value2 = Number(<?php echo $remaining; ?>);

	var chart = new CanvasJS.Chart("chartContainer",

{
	title:{
		text: "Update y value on button click",
	},
	data: [
	{
		type: "pie",
		showInLegend: true,
		legendText: "{label}",
        indexLabel: "{label} : {y}",
        indexLabelFontColor: "black",
		dataPoints: [
 			{  y: value1,  label: "Sold"  },
            {  y: value2,  label: "Remaining"  }
            
		]
	}
	]
});
chart.render();
function dataPointChanged() {

	var value1 = Number(document.getElementById('inputSold').value);//sold
	var value2 = Number(document.getElementById('inputRemaining').value);//remaining
      
    chart.options.data[0].dataPoints[0].y = value1;   // sold
    chart.options.data[0].dataPoints[1].y = value2;  //remaining
    chart.render();

    document.getElementById('inputRemaining').value = value1;
}

//dynamic call of value
function checkNewValue(){    
          
    $('#dynamicValue').load('test.php',function(){                            
    });                    
}
/*
var button = document.getElementById( "button" );
button.addEventListener( "click",  dataPointChanged);
*/
setInterval(function(){dataPointChanged()}, 2000);
setInterval(function(){checkNewValue()}, 1000);
}



</script>
<script type="text/javascript" src="../lib/canvasjs.min.js"></script>
<script type="text/javascript" src="../vendor/jquery/jquery.min.js"></script>
</head>
<body>
<button id="button">click me</button>

<div id="dynamicValue">
	<input type="text" id="inputRemaining" value="">
	<input type="text" id="inputSold" value="">
</div>

<div id="chartContainer" style="height: 400px; width: 100%;"></div>
</body>
</html>