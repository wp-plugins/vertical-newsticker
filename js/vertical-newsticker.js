/**
* 	Vertical Newsticker
*
*	@author	info@clearcrest.net
*/
var initDelay=600,scrollSpeed=40,marqueeSpeed=1,pauseIt=1,copySpeed=marqueeSpeed,pauseSpeed=0==pauseIt?copySpeed:0,actualHeight="";function scrollMarquee(){parseInt(crossMarquee.style.top)>-1*actualHeight+8?crossMarquee.style.top=parseInt(crossMarquee.style.top)-copySpeed+"px":crossMarquee.style.top=parseInt(marqueeHeight)+8+"px"}
function initMarquee(){scrollSpeed=document.getElementById("clearcrest-vertical-newsticker-wrapper").getAttribute("v");crossMarquee=document.getElementById("clearcrest-vertical-newsticker");crossMarquee.style.top=0;marqueeHeight=document.getElementById("clearcrest-vertical-newsticker-wrapper").offsetHeight;actualHeight=crossMarquee.offsetHeight;window.opera||-1!=navigator.userAgent.indexOf("Netscape/7")?(crossMarquee.style.height=marqueeHeight+"px",crossMarquee.style.overflow="scroll"):setTimeout('leftTime=setInterval("scrollMarquee()",'+
scrollSpeed+")",initDelay)}window.addEventListener?window.addEventListener("load",initMarquee,!1):window.attachEvent?window.attachEvent("onload",initMarquee):document.getElementById&&(window.onload=initMarquee);