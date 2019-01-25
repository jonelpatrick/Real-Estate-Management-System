<?php

$dbFiles = array(
        "./dataQueries/dbConfig.php",
        "./dataQueries/dataInterfaceScript.php",
        "./dataQueries/homePagedbConfig.php",
        "./dataQueries/salesByMonthDB.php",
        "./dataQueries/salesByRegionDB.php",
        "./graphConfig/salesByRegionConfig.php",
        "./graphConfig/salesByRegionStackedConfig.php"
        );


function testConnection(&$jpDatabase) {

        $error["allOk"] = false;
        $error["messages"] = "";

        $dbLink = @mysql_connect($jpDatabase["dbServer"],
                                $jpDatabase["dbUser"],
                                $jpDatabase["dbPassword"]);
        if (!$dbLink) {
                $error["messages"] .= "Error: Unable to connect to the database server ! <br>\n";
                $error["messages"] .= "Double check the connection details and try again. <br>\n";
                $error["messages"] .= mysql_error()." <br>\n";
        }
        else {
                $error["allOk"] = true;
                mysql_close($dbLink);
        }

        return $error;
}





function performSetUp(&$jpDatabase) {


        global $dbSalesDetailData;
        global $dbSalesByMonthData;
        global $dbProductData;
        global $dbRegionData;
        global $dbTable;


        $error["allOk"] = false;
        $error["messages"] = "";

        // connect and create the database
        $dbLink = @mysql_connect($jpDatabase["dbServer"],
                                 $jpDatabase["dbUser"],
                                 $jpDatabase["dbPassword"]);
        if (!$dbLink) {
                $error["messages"] .= "Error: Unable to connect to the database server ! <br>\n";
                $error["messages"] .=  "Double check the connection details and try again. <br>\n";
                $error["messages"] .=  mysql_error()." <br>\n";
                return getPage("setUpError.html",$error);
        }

        $sql = "DROP DATABASE ".$jpDatabase["dbDatabase"]." ";
        mysql_query($sql, $dbLink);
        $sql = "CREATE DATABASE ".$jpDatabase["dbDatabase"]." ";
        if (!$result = mysql_query($sql, $dbLink)) {
                $error["messages"] .=  "Error: Unable to create database ".$jpDatabase["dbDatabase"]." ! <br>\n";
                $error["messages"] .=  mysql_error()." <br>\n";
                mysql_close($dbLink);
                return getPage("setUpError.html",$error);
        }


        // create and set up the JPSAMPLEsalesDB ready for use by the
        // sample application
        $dbObj = new Database($jpDatabase["dbServer"],
                              $jpDatabase["dbUser"],
                              $jpDatabase["dbPassword"],
                              $jpDatabase["dbDatabase"]);

        if (!$dbObj) {
                $error["messages"] .=  "Error: Unable to connect to the database server ! <br>\n";
                $error["messages"] .=  "Double check the connection details and try again. <br>\n";
                $error["messages"] .=  mysql_error()." <br>\n";
                mysql_close($dbLink);
                return getPage("setUpError.html",$error);
        }

        // create the database tables
        foreach ($dbTable as $sql) {
                $result = $dbObj->query($sql);
                if (!$result) {
                        $error["messages"] .=  "Error: Unable to create database table ! <br>\n";
                        $error["messages"] .=  $sql." <br>\n";
                        $error["messages"] .=  $dbObj->getLastError()." <br>\n";
                        $dbObj->close();
                        return getPage("setUpError.html",$error);
                }

        }



        // Populate Region Data
        foreach ($dbRegionData as $region) {
                $sql = "INSERT INTO region (region_ID,description)
                                     VALUES (0,'".$region."') ";
                $result = $dbObj->query($sql);
                if (!$result) {
                        $error["messages"] .=  "Error: Unable to Insert Region Data ! <br>\n";
                        $error["messages"] .=  $sql." <br>\n";
                        $error["messages"] .=  $dbObj->getLastError()." <br>\n";
                        $dbObj->close();
                        return getPage("setUpError.html",$error);
                }

        }


        // Populate Product Data
        foreach ($dbProductData as $product) {
                $sql = "INSERT INTO product (product_ID,description,productCode)
                                     VALUES (0,'".$product["description"]."','".$product["productCode"]."') ";
                $result = $dbObj->query($sql);
                if (!$result) {
                        $error["messages"] .=  "Error: Unable to Insert Product Data ! <br>\n";
                        $error["messages"] .=  $sql." <br>\n";
                        $error["messages"] .=  $dbObj->getLastError()." <br>\n";
                        $dbObj->close();
                        return getPage("setUpError.html",$error);
                }

        }


        // populate the sales detail table
        foreach ($dbSalesDetailData as $salesDetail) {

                $sql = "INSERT INTO salesDetail (salesDetail_ID,region_ID,product_ID,saledate,amount)
                                     VALUES (0,".$salesDetail["regionID"].",'".$salesDetail["productID"]."','".$salesDetail["saleDate"]."',".$salesDetail["amount"].") ";

                $result = $dbObj->query($sql);
                if (!$result) {
                        $error["messages"] .=  "Error: Unable to Insert Sales Detail Data ! <br>\n";
                        $error["messages"] .=  $sql." <br>\n";
                        $error["messages"] .=  $dbObj->getLastError()." <br>\n";
                        $dbObj->close();
                        return getPage("setUpError.html",$error);
                }


        }

        // Populate Sales By Month Table
        for ($productID=1;$productID<5;$productID++) {
            for ($year=2007;$year<2009;$year++) {
                for ($month=1;$month<13;$month++) {
                    for ($regionID=1;$regionID<7;$regionID++) {

                        $sql = "INSERT INTO salesByMonth (salesByMonth_ID,region_ID,product_ID,saleMonth,saleYear,amount)
                                             VALUES (0,".$regionID.",'".$productID."',".$month.",".$year.",".$dbSalesByMonthData[$regionID][$productID][$month][$year].") ";

                        $result = $dbObj->query($sql);
                        if (!$result) {
                                $error["messages"] .=  "Error: Unable to Insert Sales Detail Data ! <br>\n";
                                $error["messages"] .=  $sql." <br>\n";
                                $error["messages"] .=  $dbObj->getLastError()." <br>\n";
                                $dbObj->close();
                                return getPage("setUpError.html",$error);
                        }

                    }
                }
            }
        }



        $error["allOk"]    = true;
        $error["messages"] = "";

        $dbObj->close();


        $error = updateDBinfo($jpDatabase);
        if (!$error["allOk"]) {
                return getPage("setUpError.html",$error);
        }
        else {

                // update the flag in index.php
                $output = get_File_As_String("index.php");
                $search  = array("setupDone = false;", "setupDone = FALSE;");
                $replace = array("setupDone = TRUE;", "setupDone = TRUE;");
                $output = str_replace($search,$replace,$output);
                put_File_Content("index.php",$output);
                return getPage("setUpComplete.html",$error);
        }
}



function getPage($pageFile,$error) {
        $output = get_File_As_String("./pageTemplates/".$pageFile);
        $search  = array("[ERRORS]");
        $replace = array($error["messages"]);
        $output = str_replace($search,$replace,$output);
        return $output;
}


function updateDBinfo(&$jpDatabase) {

        global $dbFiles;

        $error["allOk"]    = true;
        $error["messages"] = "";

        foreach ($dbFiles as $dbFile) {
                $output = get_File_As_String($dbFile);
                $search  = array("[DBSERVER]","[DBUSER]","[DBPASSWORD]","[DBDATABASE]");
                $replace = array($jpDatabase["dbServer"],$jpDatabase["dbUser"],$jpDatabase["dbPassword"],$jpDatabase["dbDatabase"]);
                $output = str_replace($search,$replace,$output);
                if (!put_File_Content($dbFile,$output)) {
                        $error["messages"] .=  "Error: Unable to update database access information in the data files ! <br>\n";
                        $error["messages"] .=  "Double check file permission on the ./dataQueries/ directory and all files in this directory. <br>\n";
                        $error["allOk"]    = false;
                }

        }

        return $error;

}


function doSetUp() {


        $jpDatabase["dbServer"]   = "localhost:3306";
        $jpDatabase["dbUser"]     = "";
        $jpDatabase["dbPassword"] = "";
        $jpDatabase["dbDatabase"] = "JPSAMPLEsalesDB";
        $valuesEntered = false;

        if (isset($_REQUEST["dbServer"]))   {$jpDatabase["dbServer"]   = $_REQUEST["dbServer"];$valuesEntered = true;}
        if (isset($_REQUEST["dbUser"]))     {$jpDatabase["dbUser"]     = $_REQUEST["dbUser"];$valuesEntered = true;}
        if (isset($_REQUEST["dbPassword"])) {$jpDatabase["dbPassword"] = $_REQUEST["dbPassword"];$valuesEntered = true;}

        // test the db connection
        $valuesOK = false;
        $error["allOk"] = false;
        $error["messages"] = "";
        if ($valuesEntered) {
                $error = testConnection($jpDatabase);
                if ($error["allOk"]) {
                        $valuesOK = true;
                }
        }


        if ($valuesOK) {
                $output = performSetUp($jpDatabase);
                print $output;
                exit(0);
        }
        else {
                // return the set up page
                $output = get_File_As_String("./pageTemplates/setup.html");
                $search  = array("[DBSERVER]","[DBUSER]","[DBPASSWORD]","[ERRORS]");
                $replace = array($jpDatabase["dbServer"],$jpDatabase["dbUser"],$jpDatabase["dbPassword"],$error["messages"]);
                $output = str_replace($search,$replace,$output);
                print $output;
                exit(0);
        }


        return true;
}


function get_File_As_String($filename) {

        $contents = "";

        $lines = file($filename);

        $contents = implode("\n",$lines);

        return $contents;
}

function put_File_Content($filename,$contents) {

        if (is_array($contents)) {
                $contents = implode("\n",$contents);
        }

        if (!$handle = fopen($filename, "w+")) {
                return false;
        }

        fwrite($handle, $contents);
        fclose($handle);

        return true;
}


?>