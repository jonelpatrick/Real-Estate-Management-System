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
$jpDatabase["data"][0]["query"] = "SELECT SUM(amount) AS monthAmount
                                        FROM salesByMonth
                                        WHERE saleYear=2008
                                          AND product_id = '1'
                                        GROUP BY saleMonth
                                        ORDER BY saleMonth ";
$jpDatabase["data"][0]["valueField"]        = "monthAmount";

// Green Robots
$jpDatabase["data"][1]["query"] = "SELECT SUM(amount) AS monthAmount
                                        FROM salesByMonth
                                        WHERE saleYear=2008
                                          AND product_id = '2'
                                        GROUP BY saleMonth
                                        ORDER BY saleMonth ";
$jpDatabase["data"][1]["valueField"]        = "monthAmount";

// Red Robots
$jpDatabase["data"][2]["query"] = "SELECT SUM(amount) AS monthAmount
                                        FROM salesByMonth
                                        WHERE saleYear=2008
                                          AND product_id = '3'
                                        GROUP BY saleMonth
                                        ORDER BY saleMonth ";
$jpDatabase["data"][2]["valueField"]        = "monthAmount";

// Yellow Robots
$jpDatabase["data"][3]["query"] = "SELECT SUM(amount) AS monthAmount
                                        FROM salesByMonth
                                        WHERE saleYear=2008
                                          AND product_id = '4'
                                        GROUP BY saleMonth
                                        ORDER BY saleMonth ";
$jpDatabase["data"][3]["valueField"]        = "monthAmount";

?>