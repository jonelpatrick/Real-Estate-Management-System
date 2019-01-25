width:  700
height: 400

quality:           medium

series1:           255,80,30|Temperature

outline:           true
gradientfill:      true
backgroundcolor:   white

grid:              true
axis:              true
ndecplaces:        1
barwidth:          50
barspacing:        2

gridbgcolor:       #444444
axiscolor:         grey
floorcolor:        gray
gridcolor:         gray
gridstyle:         dotted

ylabels:           true
ylabelfont:        Arial
ylabelfontsize:    10
ylabelfontbold:    false
ylabelfontitalic:  false
ylabelcolor:       #444444
y2labelcolor:      blue
ylabelpost:        C

titletext:         Temperature
titlefont:         Arial
titlefontsize:     12
titlefontbold:     true
titlefontitalic:   false
titlecolor:        #444444
titleposition:     -1,50


xtitletext:        Date/Time
xtitlefont:        Arial
xtitlefontsize:    11
xtitlefontbold:    true
xtitlefontitalic:  false
xtitlecolor:       #444444

ytitletext:        Temperature
ytitlefont:        Arial
ytitlefontsize:    11
ytitlefontbold:    true
ytitlefontitalic:  false
ytitlecolor:       #444444

<?php
/*
 * read the csv file to get the
 * X axis date/time labels
 */

$csvdata = file('csvData.csv');

$first = TRUE;
$xlabels = array();
/*
 * process each row from the
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
         * extract the Date / Time information
         * from the row and place into the
         * xlabels array
         */
        $dataelements = explode(',',$datarow);
        if (isset($dataelements[0]))
        {
            $xlabels[] = $dataelements[0];
        }
    }
}
/*
 * write out the xlabels parameter
 */
print 'xlabels: '. implode('|',$xlabels);

?>

xlabelorientation: up angle
xlabeloffset:      0
xlabelfont:        Arial
xlabelfontsize:    10
xlabelfontbold:    false
xlabelfontitalic:  false
xlabelcolor:       #444444

legend:            false
legendstyle:       horizontal
legendbgcolor:     #FFFFFF
legendbordercolor: #FFFFFF
legendtextcolor:   #444444
legendtitle:
legendfont:        Arial
legendfontsize:    10
legendfontbold:    false
legendfontitalic:  true
