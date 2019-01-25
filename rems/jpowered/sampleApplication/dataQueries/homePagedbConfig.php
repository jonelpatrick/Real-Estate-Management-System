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

$jpDatabase["data"][0]["query"] = "SELECT product_ID,SUM(amount) AS totalAmount
                                        FROM salesByMonth
                                        WHERE saleYear=2008
                                        GROUP BY product_ID
                                        ORDER BY product_ID ";
$jpDatabase["data"][0]["valueField"]        = "totalAmount";
$jpDatabase["data"][0]["valueXField"]       = "";
$jpDatabase["data"][0]["valueYField"]       = "";
$jpDatabase["data"][0]["valueZField"]       = "";
$jpDatabase["data"][0]["datatextField"]     = "";
$jpDatabase["data"][0]["datalinkField"]     = "";
$jpDatabase["data"][0]["targetWindowField"] = "";




?>