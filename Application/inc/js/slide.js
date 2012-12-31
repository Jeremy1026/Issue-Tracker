function findPos(obj) {
 var obj2 = obj;
 var curtop = 0;
 var curleft = 0;
 if (document.getElementById || document.all) {
  do  {
   curleft += obj.offsetLeft-obj.scrollLeft;
   curtop += obj.offsetTop-obj.scrollTop;
   obj = obj.offsetParent;
   obj2 = obj2.parentNode;
   while (obj2!=obj) {
    curleft -= obj2.scrollLeft;
    curtop -= obj2.scrollTop;
    obj2 = obj2.parentNode;
   }
  } while (obj.offsetParent)
 } else if (document.layers) {
  curtop += obj.y;
  curleft += obj.x;
 }
 return curleft;
}

function slidex (id, x, hide){
	var pos = findPos(document.getElementById(id));
	if (((pos < 0) && (x > 0)) || ((pos > 0) && (x < 0)))  {
		var width = 0;
		if (self.innerHeight)
		{
			width = self.innerWidth;
		}
		else if (document.documentElement && document.documentElement.clientHeight)
		{
			width = document.documentElement.clientWidth;
		}
		else if (document.body)
		{
			width = document.body.clientWidth;
		}
		var w = parseInt(document.getElementById(id).style.width);
		x = width * x + (w / 2);
		
		if (hide != null) {
			if (x > 0) {
				document.getElementById(hide).style.display = 'none';
			}
			else {
				document.getElementById(hide).style.display = 'inline';
			}
		}
		
		slidex.obj=document.layers? document.layers[id] : document.all? document.all[id].style : document.getElementById? document.getElementById(id).style : null;
		if(slidex.obj&&!slidex.going){
			slidex.x=x<0? -1 : 1;
			slidex.xa=x*slidex.x;
			slidex.going=1;
			slidex.doit();
		}
	}
}

	slidex.px=document.layers? '' : 'px';
	slidex.doit=function() {
	slidex.obj.left = parseInt(slidex.obj.left) + slidex.x*slidex.speed + slidex.px;
	if(slidex.xa>0){
		slidex.xa-=slidex.speed;
		setTimeout("slidex.doit()", slidex.xa<5*slidex.speed? 30 : slidex.xa<10*slidex.speed? 20 : 15);
	}
	else
		slidex.going=0;
	}
//Configure speed here (1-5). Note: the x in calls for slidex(id, x) should be evenly divisible by the speed value:
slidex.speed=10;