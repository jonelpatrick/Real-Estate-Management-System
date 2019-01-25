<?php
/*
 * read the csv file
 */
$csvdata = file('csvData.csv');

$first = TRUE;
$dataCount = 1;
/*
 * process each row of the 
 * csv file
 */
foreach ($csvdata as $datarow)
{
    if ($first) // ignore the first header row
    {
        $first = FALSE;
    }
    else 
    {
        /*
         * extract the temperature value
         * from each row and write out
         * the data parameter
         */
        $dataelements = explode(',',$datarow);
        if (isset($dataelements[1]))
        {
            $dataelements[1] = (float)$dataelements[1];
            print 'data'. $dataCount .'series1: ' . $dataelements[1] . PHP_EOL;
            $dataCount++;
        }
    }
}

?>