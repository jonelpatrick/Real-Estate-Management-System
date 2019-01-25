<?php

// Abstraction Class
$jpDatabase["abstractionClass"] = "DBMySQL.class.php";

// Database Login Info
$jpDatabase["dbServer"]   = "[DBSERVER]";
$jpDatabase["dbUser"]     = "[DBUSER]";
$jpDatabase["dbPassword"] = "[DBPASSWORD]";
$jpDatabase["dbDatabase"] = "[DBDATABASE]";

// Data Queries
$jpDatabase["data"] = array();

// Blue Robots
$jpDatabase["data"][0]["query"] = "SELECT SUM(amount) AS regionAmount
                                        FROM salesByMonth
                                        WHERE saleYear=2008
                                          AND product_id = '1'
                                        GROUP BY region_ID
                                        ORDER BY region_ID ";
$jpDatabase["data"][0]["valueField"]        = "regionAmount";

// Green Robots
$jpDatabase["data"][1]["query"] = "SELECT SUM(amount) AS regionAmount
                                        FROM salesByMonth
                                        WHERE saleYear=2008
                                          AND product_id = '2'
                                        GROUP BY region_ID
                                        ORDER BY region_ID ";
$jpDatabase["data"][1]["valueField"]        = "regionAmount";

// Red Robots
$jpDatabase["data"][2]["query"] = "SELECT SUM(amount) AS regionAmount
                                        FROM salesByMonth
                                        WHERE saleYear=2008
                                          AND product_id = '3'
                                        GROUP BY region_ID
                                        ORDER BY region_ID ";
$jpDatabase["data"][2]["valueField"]        = "regionAmount";

// Yellow Robots
$jpDatabase["data"][3]["query"] = "SELECT SUM(amount) AS regionAmount
                                        FROM salesByMonth
                                        WHERE saleYear=2008
                                          AND product_id = '4'
                                        GROUP BY region_ID
                                        ORDER BY region_ID ";
$jpDatabase["data"][3]["valueField"]        = "regionAmount";

?>