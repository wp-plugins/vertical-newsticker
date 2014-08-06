/**
* 	Vertical Newsticker
*
*	@author	info@clearcrest.net
*/
var initDelay = 600, 
	scrollSpeed = 40,
	marqueeSpeed = 1,
	pauseIt = 1, 
	copySpeed = marqueeSpeed,
	pauseSpeed = (pauseIt == 0) ? copySpeed: 0,
	actualHeight = '';
    
function scrollMarquee() {
	if ( parseInt(crossMarquee.style.top) > (actualHeight * (-1) +8) ) { 
		crossMarquee.style.top = parseInt( crossMarquee.style.top) - copySpeed + "px";
    } else {
		crossMarquee.style.top = parseInt(marqueeHeight) + 8 + "px";
    }
    console.log(scrollSpeed);
}

function initMarquee(){
	scrollSpeed = document.getElementById('clearcrest-vertical-newsticker-wrapper').getAttribute('v');
	crossMarquee = document.getElementById("clearcrest-vertical-newsticker");
	crossMarquee.style.top = 0;
	marqueeHeight = document.getElementById("clearcrest-vertical-newsticker-wrapper").offsetHeight;
	actualHeight=crossMarquee.offsetHeight;
	if (window.opera || navigator.userAgent.indexOf("Netscape/7")!=-1) { 
		crossMarquee.style.height = marqueeHeight + "px";
		crossMarquee.style.overflow = "scroll";
		return;
	}
	setTimeout('leftTime=setInterval("scrollMarquee()",' + scrollSpeed + ')', initDelay)
}

if (window.addEventListener) {
	window.addEventListener("load", initMarquee, false);
} else if (window.attachEvent) {
	window.attachEvent("onload", initMarquee);
} else if (document.getElementById) {
	window.onload = initMarquee;
}
