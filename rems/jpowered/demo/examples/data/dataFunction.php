<?php
/*
 * The graphing software will look for a function named datascript()
 * at runtime. If found the graph will call this to acquire the 
 * graph data.
 */
function datascript () {

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
	 * Convert the data into the array format required 
	 * by the graphing software
	 * 
	 * The format required is a one dimensional array 
	 * which contains a text for each line of data.
	 * 
	 */
	$dataLines = array();
	
	/*
	 * write out the data in the format required for the graphing software
	 */
	foreach ($dataArray['series1'] as $dataIndex => $dataValue)
	{
		$dataLines[] = 'data' . ($dataIndex+1) . 'series1: ' . $dataValue;
	}
	
	foreach ($dataArray['series2'] as $dataIndex => $dataValue)
	{
		$dataLines[] = 'data' . ($dataIndex+1) . 'series2: ' . $dataValue;
	}
	
	foreach ($dataArray['series3'] as $dataIndex => $dataValue)
	{
		$dataLines[] = 'data' . ($dataIndex+1) . 'series3: ' . $dataValue;
	}
	
	
	/*
	 * return the $dataLines array to the 
	 * graphing software
	 */
    return $dataLines;
}