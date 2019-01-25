<?php 

/*
 * Create the Data Array
 * 
 * We are using a prepopulated array here for simplicity.
 * However this method would be used to first acquire data 
 * from databases, ORM, spreadsheets etc. 
 * 
 */
$dataArray = array('series1' => array(500,   750, 1250, 4300),
                   'series2' => array(2000, 2100, 2600, 2400),
                   'series3' => array(8300, 7400, 6200, 3200));

/*
 * write out the data in the format required for the graphing software
 */
foreach ($dataArray['series1'] as $dataIndex => $dataValue)
{
	echo 'data' . ($dataIndex+1) . 'series1: ' . $dataValue . PHP_EOL;
}

foreach ($dataArray['series2'] as $dataIndex => $dataValue)
{
	echo 'data' . ($dataIndex+1) . 'series2: ' . $dataValue . PHP_EOL;
}

foreach ($dataArray['series3'] as $dataIndex => $dataValue)
{
	echo 'data' . ($dataIndex+1) . 'series3: ' . $dataValue . PHP_EOL;
}

?>