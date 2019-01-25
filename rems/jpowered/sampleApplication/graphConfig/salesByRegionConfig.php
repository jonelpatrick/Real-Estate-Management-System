width: 700
height: 400

3d: true
depth3d: 10

ndecplaces: 0



thousandseparator: ,
backgroundcolor:   #ffffff
barspacing:        5
barwidth:          19
displaybarvalues:  false
gradientfill:      true

vspace: 50

ylabelpre: $

series1: #0000CC|Blue Robots|left
series2: #44CC00|Green Robots|left
series3: #CC2800|Red Robots|left
series4: #CCA200|Yellow Robots|left

<!-- Legend Information -->
legend:            true
legendfont:        arial
legendfontsize:    11
legendfontbold:    false
legendfontitalic:  false
legendposition:    -1,40
legendtitle:
legendbgcolor:     #FFFFFF
legendbordercolor: #DDDDDD
legendtextcolor:   #202020
legendstyle:       horizontal

xlabelorientation: up angle
xlabelcolor:       #000000
xlabelfont:        arial
xlabelfontsize:    10
xlabelfontbold:    false
xlabelfontitalic:  false


<?php
// Dynamically get the X axis labels from the region table

// Database Login Info
$jpDatabase["dbServer"]   = "[DBSERVER]";
$jpDatabase["dbUser"]     = "[DBUSER]";
$jpDatabase["dbPassword"] = "[DBPASSWORD]";
$jpDatabase["dbDatabase"] = "[DBDATABASE]";

// connect to the db
$dbLink = mysql_connect($jpDatabase["dbServer"],
                        $jpDatabase["dbUser"],
                        $jpDatabase["dbPassword"]);
mysql_select_db($jpDatabase["dbDatabase"], $dbLink);

// issue the query to get the region records
$sql = "SELECT description FROM region ORDER BY region_ID ";
$result = mysql_query($sql, $dbLink);

// construct the xlabels parameter
$xlabels = "";
while ( $row = mysql_fetch_array($result,MYSQL_ASSOC) ) {
        $xlabels .=  $row["description"]."|";
}

// write out the xlabels parameter
print "xlabels: ".$xlabels."\n";

// close the db connection
mysql_close($dbLink);
?>