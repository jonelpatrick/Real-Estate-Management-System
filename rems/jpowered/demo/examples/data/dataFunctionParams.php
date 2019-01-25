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
	 * Here we demonstrate how the graphs can be used to display 
	 * data based upon the value of request parameters.
	 * 
	 * In this trivial example we use the value of a request 
	 * parameter to generate the data values.
	 * 
	 */
	$dataArray = array('series1' => array(50*$_REQUEST['customParam'],   75*$_REQUEST['customParam'], 125*$_REQUEST['customParam'], 430*$_REQUEST['customParam']),
	                   'series2' => array(200*$_REQUEST['customParam'], 210*$_REQUEST['customParam'], 260*$_REQUEST['customParam'], 240*$_REQUEST['customParam']),
	                   'series3' => array(830*$_REQUEST['customParam'], 740*$_REQUEST['customParam'], 620*$_REQUEST['customParam'], 320*$_REQUEST['customParam']));
	
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