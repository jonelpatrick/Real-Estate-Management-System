
// str = str.replace(/^\s+|\s+$/g, ''); // trim a string

// Set Netscape up to run the "captureMousePosition" function whenever
// the mouse is moved. For Internet Explorer and Netscape 6, you can capture
// the movement a little easier.
if (document.layers) { // Netscape < 6
	document.captureEvents(Event.MOUSEMOVE);
}
document.onmousemove = JPcaptureMousePosition;

function JPcaptureMousePosition(e) {
    if (document.layers) {
        // When the page scrolls in Netscape, the event's mouse position
        // reflects the absolute position on the screen. innerHight/Width
        // is the position from the top/left of the screen that the user is
        // looking at. pageX/YOffset is the amount that the user has
        // scrolled into the page. So the values will be in relation to
        // each other as the total offsets into the page, no matter if
        // the user has scrolled or not.
        JPutility.xMousePos = e.pageX;
        JPutility.yMousePos = e.pageY;
        JPutility.xMousePosMax = window.innerWidth+window.pageXOffset;
        JPutility.yMousePosMax = window.innerHeight+window.pageYOffset;
    } else if (document.all) {
        // When the page scrolls in IE, the event's mouse position
        // reflects the position from the top/left of the screen the
        // user is looking at. scrollLeft/Top is the amount the user
        // has scrolled into the page. clientWidth/Height is the height/
        // width of the current page the user is looking at. So, to be
        // consistent with Netscape (above), add the scroll offsets to
        // both so we end up with an absolute value on the page, no
        // matter if the user has scrolled or not.
        JPutility.getScrollXY();
        JPutility.xMousePos = window.event.x + JPutility.scrOfX;
        JPutility.yMousePos = window.event.y + JPutility.scrOfY;
        JPutility.xMousePosMax = document.body.clientWidth+document.body.scrollLeft;
        JPutility.yMousePosMax = document.body.clientHeight+document.body.scrollTop;
    } else if (document.getElementById) {
        // Netscape 6 behaves the same as Netscape 4 in this regard
        JPutility.xMousePos = e.pageX;
        JPutility.yMousePos = e.pageY;
        JPutility.xMousePosMax = window.innerWidth+window.pageXOffset;
        JPutility.yMousePosMax = window.innerHeight+window.pageYOffset;
    }
}





/**
 * JP Utility Object
 **/
// Constructor
function JPutils() {

	// Properties
	this.xMousePos = 0; // Horizontal position of the mouse on the screen
	this.yMousePos = 0; // Vertical position of the mouse on the screen
	this.xMousePosMax = 0; // Width of the page
	this.yMousePosMax = 0; // Height of the page
	this.scrOfY = 0;
	this.scrOfX = 0;

	this.popupBorderColor    = "#000";

	this.popupHeadBGcolor    = "#000";
	this.popupHeadTXTcolor   = "#fff";
	this.popupHeadFontWeight = "bold";
	this.popupHeadFontSize   = "12px";

	this.popupContentBGcolor    = "#fff";
	this.popupContentTXTcolor   = "#000";
	this.popupContentFontWeight = "normal";
	this.popupContentFontSize   = "10px";

	// utility methods
	this.getScrollXY          = JPutils_getScrollXY;
	this.replaceContent       = JPutils_replaceContent;
	this.popupStyle           = JPutils_popupStyle;
	this.fadeIn               = JPutils_fadeIn;
	this.fadeOut              = JPutils_fadeOut;
	this.changeOpacity        = JPutils_changeOpacity;
	this.popupContent         = JPutils_popupContent;
	this.displayPopUp         = JPutils_displayPopUp;
	this.clearPopUpDisplay    = JPutils_clearPopUpDisplay;

}

function JPutils_getScrollXY() {

	if( typeof( window.pageYOffset ) == 'number' ) {
		//Netscape compliant
		this.scrOfY = window.pageYOffset;
		this.scrOfX = window.pageXOffset;
	}
	else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
		//DOM compliant
		this.scrOfY = document.body.scrollTop;
		this.scrOfX = document.body.scrollLeft;
	}
	else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
		//IE6 standards compliant mode
		this.scrOfY = document.documentElement.scrollTop;
		this.scrOfX = document.documentElement.scrollLeft;
	}
	return true;
}

function JPutils_replaceContent(elementID, xhtmlData) {

	document.getElementById(elementID).innerHTML = xhtmlData;
	return true;

	try {
		var elem = document.getElementById(elementID);
		var children = elem.childNodes;

		for (var i = 0; i < children.length; i++) {
			elem.removeChild(children[i]);
		}

		var nodes = new DOMParser().parseFromString(xhtmlData, 'application/xhtml+xml');
		var range = document.createRange();

		range.selectNodeContents(document.getElementById(elementID));
		range.deleteContents();

		for (var i = 0; i < nodes.childNodes.length; i++) {
			document.getElementById(elementID).appendChild(nodes.childNodes[i]);
		}
		return true;
	}
	catch (e1) {
		try {
			document.getElementById(elementID).innerHTML = xhtmlData;
			return true;
		}
		catch(e2) {
			alert("Unable to change content.");
			return false;
		}
	}
}


function JPutils_popupStyle() {

	popupStyle =
	"padding: 0px; " +
	"margin: 0px; " +
	"font-size: 12px; " +
	"font-family: arial,sans-serif; " +
	"font-weight: normal; " +
	"border-color: #000; " +
	"border-style: none; " +
	"border-width: 0px; " +
	"position: absolute; " +
	"background-color: #AAA; " +
	"color: #000; ";

	return popupStyle;
}

function JPutils_popupContent(dataNum) {

	if (null === dataObj.graphData[dataNum]) {
		return "";
	}

	tableStyle =
	"padding: 0px; " +
	"margin: 0px; " +
	"font-size: 12px; " +
	"font-family: arial,sans-serif; " +
	"font-weight: normal; " +
	"border-color: " + this.popupBorderColor + "; " +
	"border-style: solid; " +
	"border-width: 1px; " +
	"background-color: #fff; " +
	"border-collapse: collapse; " +
	"color: #333; ";

	tableHeadStyle =
	"padding: 4px; " +
	"margin: 0px; " +
	"font-size: " + this.popupHeadFontSize + "; " +
	"font-family: arial,sans-serif; " +
	"font-weight: " + this.popupHeadFontWeight + "; " +
	"background-color: " + this.popupHeadBGcolor + "; " +
	"color: " + this.popupHeadTXTcolor + "; ";

	tableContentStyle =
	"padding: 4px; " +
	"margin: 0px; " +
	"font-size: " + this.popupContentFontSize + "; " +
	"font-family: arial,sans-serif; " +
	"font-weight: " + this.popupContentFontWeight + "; " +
	"background-color: " + this.popupContentBGcolor + "; " +
	"color: " + this.popupContentTXTcolor + "; ";

	contentHTML =
	"<table style=\""+tableStyle+"\"> " +
	"<tr> " +
	"	<td style=\""+tableHeadStyle+"\">" + dataObj.graphData[dataNum].valueDisplayText + "<\/td> " +
	"<\/tr> ";
	if (!(null === dataObj.graphData[dataNum].datatext)) {
		contentHTML +=
		"<tr> " +
		"	<td style=\""+tableContentStyle+"\">"+dataObj.graphData[dataNum].datatext+"<\/td> " +
		"<\/tr> ";
	}
	contentHTML += "<\/table> ";


	return contentHTML;
}



function JPutils_displayPopUp(dataNum) {

	elementID = "popUpDisplayData"+dataNum;

	document.getElementById(elementID).style.left = this.xMousePos + "px";
	document.getElementById(elementID).style.top  = (this.yMousePos + 4) + "px";
	this.fadeIn(elementID,10,20);

	return true;
}

function JPutils_clearPopUpDisplay(dataNum) {
	elementID = "popUpDisplayData"+dataNum;
	this.fadeOut(elementID,100,20);
	return true;
}

function JPutils_fadeIn(elementID, oValue, timeoutDelay) {

	this.changeOpacity(elementID, 100);
	return true;
	
	oValue = oValue + 5;
	if (oValue>100) {
		oValue = 100;
		this.changeOpacity(elementID, oValue);
		return true;
	}
	this.changeOpacity(elementID, oValue);
	setTimeout("JPutility.fadeIn('" + elementID + "'," + oValue + ","+ timeoutDelay +")",timeoutDelay);

	return true;
}

function JPutils_fadeOut(elementID, oValue, timeoutDelay) {

	this.changeOpacity(elementID, 0);
	return true;
	
	oValue = oValue - 5;
	if (oValue<1) {
		oValue = 0;
		this.changeOpacity(elementID, oValue);
		// this.replaceContent(elementID,"");
		return true;
	}
	this.changeOpacity(elementID, oValue);
	setTimeout("JPutility.fadeOut('" + elementID + "'," + oValue + ","+ timeoutDelay +")",timeoutDelay);

	return true;
}

function JPutils_changeOpacity(elementID , oValue ) {
    object = document.getElementById(elementID);
    object.style.opacity      = oValue;
    object.style.MozOpacity   = (oValue / 100);
    object.style.filter       = "alpha(opacity=" + oValue + ")";
    return true;
}

/**********************************************
          Core AJAX Functions
 **********************************************/

// XMLHttp send GET request
function JPAJAX_xmlHttp_Get(xmlhttp, url) {
	xmlhttp.open('GET', url, true);
	xmlhttp.send(null);
}

function JPAJAX_GetXmlHttpObject(handler) {
	var objXmlHttp = null;    //Holds the local xmlHTTP object instance

	var is_ie = (navigator.userAgent.indexOf('MSIE') >= 0) ? 1 : 0;
	var is_ie5 = (navigator.appVersion.indexOf("MSIE 5.5")!=-1) ? 1 : 0;

	//Depending on the browser, try to create the xmlHttp object
	if (is_ie) {
		//The object to create depends on version of IE
		//If it isn't ie5, then default to the Msxml2.XMLHTTP object
		var strObjName = (is_ie5) ? 'Microsoft.XMLHTTP' : 'Msxml2.XMLHTTP';

		//Attempt to create the object
		try {
			objXmlHttp = new ActiveXObject(strObjName);
			objXmlHttp.onreadystatechange = handler;
		}
		catch(e) {
			//Object creation errored
			alert('AJAX initialisation failed');
			return false;
		}
	}
	else {
		// Mozilla | Netscape | Safari
		objXmlHttp = new XMLHttpRequest();
		objXmlHttp.onload = handler;
		objXmlHttp.onerror = handler;
	}

	//Return the instantiated object
	return objXmlHttp;
}



function debugContent(theText) {
	document.getElementById("debugText").innerHTML =  theText + "<br \/>\n"+ document.getElementById("debugText").innerHTML;
}
