<?php

$dbTable = array(
        "CREATE TABLE `salesDetail` (
          `salesDetail_ID`  INT(11)     NOT NULL auto_increment,
          `region_ID`       INT(11)     NOT NULL default '0',
          `product_ID`                  VARCHAR(255) NOT NULL,
          `saledate`                    timestamp    NOT NULL default '0000-00-00 00:00:00',
          `amount`                      REAL         NOT NULL default '0.0',
          PRIMARY KEY  (`salesDetail_ID`),
          KEY `region_ID`    (`region_ID`),
          KEY `product_ID`    (`product_ID`)
        ) ",

        "CREATE TABLE `salesByMonth` (
          `salesByMonth_ID` INT(11)     NOT NULL auto_increment,
          `region_ID`       INT(11)     NOT NULL default '0',
          `product_ID`                  VARCHAR(255)         NOT NULL,
          `saleMonth`                   INT      NOT NULL default '0',
          `saleYear`                    INT      NOT NULL default '0',
          `amount`                      REAL     NOT NULL default '0.0',
          PRIMARY KEY  (`salesByMonth_ID`),
          KEY `region_ID`    (`region_ID`),
          KEY `product_ID`   (`product_ID`)
        ) ",

        "CREATE TABLE `product` (
          `product_ID` INT(11)     NOT NULL auto_increment,
          `description`            VARCHAR(255)         NOT NULL,
          `productCode`            VARCHAR(255)         NOT NULL,
          PRIMARY KEY  (`product_ID`)
        ) ",

        "CREATE TABLE `region` (
          `region_ID` INT(11)      NOT NULL auto_increment,
          `description`            VARCHAR(255)         NOT NULL,
          PRIMARY KEY  (`region_ID`)
        ) "
);


// Region Data
$dbRegionData = array(
                        "Europe",
                        "North America",
                        "South America",
                        "Asia",
                        "Australasia",
                        "Africa"
                        );

// Product Data
$dbProductData = array(
                        array("description"=>"Blue Robots"   ,"productCode"=>"robo1"),
                        array("description"=>"Green Robots"  ,"productCode"=>"robo2"),
                        array("description"=>"Red Robots"    ,"productCode"=>"robo3"),
                        array("description"=>"Yellow Robots" ,"productCode"=>"robo4")
                        );


// Generate some sales data
$dbSalesDetailData  = array();
$dbSalesByMonthData = array();

for ($productID=1;$productID<5;$productID++) {
    for ($year=2007;$year<2009;$year++) {
        for ($month=1;$month<13;$month++) {
            for ($regionID=1;$regionID<7;$regionID++) {
                $dbSalesByMonthData[$regionID][$productID][$month][$year] = 0.0;
            }
        }
    }
}

for ($productID=1;$productID<5;$productID++) {

   $productPrice = 10;
   switch ($productID) {
        case 1:  $productPrice = 7; break;
        case 2:  $productPrice = 5; break;
        case 3:  $productPrice = 5; break;
        case 4:  $productPrice = 10; break;
        case 5:  $productPrice = 2; break;
        default: $productPrice = 10; break;
   }



    for ($year=2007;$year<2009;$year++) {
        for ($month=1;$month<13;$month++) {
            for ($regionID=1;$regionID<7;$regionID++) {

                $nsales = rand(1,4);

                for ($i=0;$i<$nsales;$i++) {
                        $day = rand(1,28);
                        $datetime = mktime(10,30,15,$month,$day,$year);
                        $saleDate = date("Y-m-d H:i:s",$datetime);
                        $amount = $productPrice * rand(10000,90000) / 100;

                        $dbSalesDetailData[] = array("productID"=>$productID,
                                                     "regionID"=>$regionID,
                                                     "saleDate"=>$saleDate,
                                                     "amount"=>$amount
                                                    );

                        $dbSalesByMonthData[$regionID][$productID][$month][$year] += $amount;
                }



            }
        }
    }
}



?>