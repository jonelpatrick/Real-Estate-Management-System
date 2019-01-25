<?php
$setupDone = false;

require "./includes/setUpUtils.php";
require "./includes/DBMySQL.class.php";
require "./includes/dbTableCreateStatements.php";


if (!$setupDone) {
        doSetUp();


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

}


/**
 * Begin the Sample Application Here
 **/
$output = get_File_As_String("./pageTemplates/index.html");
print $output;
exit(0);

?>