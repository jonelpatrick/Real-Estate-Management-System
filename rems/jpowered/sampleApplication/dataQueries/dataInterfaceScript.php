<?php
$dataLines = array();

/*
 * connect to the database
 */
$dbLink = mysql_connect("[DBSERVER]",
                        "[DBUSER]",
                        "[DBPASSWORD]");
if (!$dbLink) {
        print "Could not connect: ".mysql_error();
        exit(0);
}

if (!mysql_select_db("jpsamplesalesdb", $dbLink)) {
        print "Could not select database: ".mysql_error();
        exit(0);
}

/*
 * perform the query for each series of data
 */

    $dataLines = array();

	/*
	 * Blue Robots
	 */
	$sql = "SELECT SUM(amount) AS monthAmount
			  FROM salesByMonth
			 WHERE saleYear=2008
			   AND product_id = '1'
	      GROUP BY saleMonth
		  ORDER BY saleMonth ";
	$result = mysql_query($sql, $dbLink);
	$dataNum = 1;
	while ( $row = mysql_fetch_array($result,MYSQL_ASSOC) ) {
	        $dataLines[] = "data".$dataNum."series1: ".$row["monthAmount"];
	        $dataNum++;
	}
    mysql_free_result($result);

	/*
	 * Green Robots
	 */
	$sql = "SELECT SUM(amount) AS monthAmount
			  FROM salesByMonth
			 WHERE saleYear=2008
			   AND product_id = '2'
	      GROUP BY saleMonth
		  ORDER BY saleMonth ";
	$result = mysql_query($sql, $dbLink);
	$dataNum = 1;
	while ( $row = mysql_fetch_array($result,MYSQL_ASSOC) ) {
	        $dataLines[] = "data".$dataNum."series2: ".$row["monthAmount"];
	        $dataNum++;
	}
    mysql_free_result($result);

	/*
	 * Red Robots
	 */
	$sql = "SELECT SUM(amount) AS monthAmount
			  FROM salesByMonth
			 WHERE saleYear=2008
			   AND product_id = '3'
	      GROUP BY saleMonth
		  ORDER BY saleMonth ";
	$result = mysql_query($sql, $dbLink);
	$dataNum = 1;
	while ( $row = mysql_fetch_array($result,MYSQL_ASSOC) ) {
	        $dataLines[] = "data".$dataNum."series3: ".$row["monthAmount"];
	        $dataNum++;
	}
    mysql_free_result($result);

	/*
	 * Yellow Robots
	 */
	$sql = "SELECT SUM(amount) AS monthAmount
			  FROM salesByMonth
			 WHERE saleYear=2008
			   AND product_id = '4'
	      GROUP BY saleMonth
		  ORDER BY saleMonth ";
	$result = mysql_query($sql, $dbLink);
	$dataNum = 1;
	while ( $row = mysql_fetch_array($result,MYSQL_ASSOC) ) {
	        $dataLines[] = "data".$dataNum."series4: ".$row["monthAmount"];
	        $dataNum++;
	}
    mysql_free_result($result);

	/*
	 * Output the data lines
	 */
    foreach ($dataLines as $dataLine)
    {
    	print $dataLine . PHP_EOL;
    }

/*
 *  all finished so close db connection and exit
 */
mysql_close($dbLink);
exit(0);
?>