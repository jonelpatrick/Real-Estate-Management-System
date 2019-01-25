<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<TITLE>Advanced Graphs and Charts for PHP</TITLE>
<style>

body {font-family: Arial, Helvetica, sans-serif;color: #000000;font-size: 11px;}
a, a:active, a:link, a:visited {font-weight: bold;color:#0000BB;text-decoration: none;font-size: 1.2em;}
a:hover {font-weight: bold;color:#3333FF;text-decoration: none;}

h4 {color: #f00; font-size: 1.4em;}
p {font-size: 14px;}
div {margin: 0px 0px 16px 0px; padding: 0px; font-size: 1.0em;}

</style>
</head>
<body>
<?php   
require "jputils.php"; 
ob_end_clean();

/*
 * test the environment
 */
$envInfo['phpver']        = phpversion();
$envInfo['gdv']           = gdVersion();
$envInfo['allowURLfopen'] = ini_get('allow_url_fopen')     ? TRUE : FALSE;
$envInfo['curl']          = function_exists('curl_init')   ? TRUE : FALSE;
$envInfo['log']           = TRUE;
$envInfo['json']          = function_exists('json_encode') ? TRUE : FALSE;
         
if (!fopen('../log/error.log', 'a')) 
{          
	$log = false;      
}      
else 
{
	fclose($logfilehandle);      
}

/*
 * analize the results 
 */              
$allOk = TRUE;        
if ($envInfo['phpver'] < 4) $allOk = FALSE;
if ($envInfo['gdv'] < 1)    $allOk = FALSE;
if (!$envInfo['allowURLfopen'] ||
    !$envInfo['log'])       $allOk = FALSE;
    
/*
 * if there any problems then output a report
 */
if ($allOk) exit(0);    
    
print '<h4>Environment Problems</h4>';

if ($envInfo['phpver'] < 4) 
{
	print '<div>ERROR<br />PHP Version too low <br /> <a href=\"http://www.jpowered.com/php-scripts/adv-graph-chart/documentation/helpUpgradePHP.htm\" target=\"_top\">Help Here &raquo;</a></div>';
}

if ($envInfo['gdv'] < 1) 
{
	print '<div>ERROR<br />PHP Graphics (GD) is Disabled <br /> <a href=\"http://www.jpowered.com/php-scripts/adv-graph-chart/documentation/helpUpgradeGD.htm\" target=\"_top\">Help Here &raquo;</a></div>';
}

if (!$envInfo['allowURLfopen'])
{
	print '<div>WARNING <br /> PHP allow_url_fopen is Disabled. This may cause problems when trying to load data via a URL. <br /><a href=\"http://www.jpowered.com/php-scripts/adv-graph-chart/documentation/helpAllowURLFopen.htm\" target=\"_top\">Help Here &raquo;</a></div>';
}
   
if (!$envInfo['log'])
{
	print '<div>WARNING <br />Unable to create log file, Runtime errors will not be logged. <br /><a href=\"http://www.jpowered.com/php-scripts/adv-graph-chart/documentation/helpLogfile.htm\" target=\"_top\">Help Here &raquo;</a></div>';
}     

exit(0);  
?>
</body>
</html>