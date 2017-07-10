var intPage = 0;
var intBookSize = 5;
var intOn = 0;
var intImgSize = 740;
var intBookEnd = 0;
var intStepSize = 74;
var intNitro = 1;

var strImg = new Array;
var imgImg = new Array;

strImg[0] = "/images/nav/company.gif";
strImg[1] = "/images/nav/services.gif";
strImg[2] = "/images/nav/packages.gif";
strImg[3] = "/images/nav/projects.gif";
strImg[4] = "/images/nav/contact.gif";
strImg[5] = "/images/nav/spacer-gb.gif";
strImg[6] = "/images/nav/spacer-bb.gif";
strImg[7] = "/images/nav/spacer-gg.gif";
strImg[8] = "/images/nav/spacer-bg.gif";


for (var w=0;w<strImg.length;w++)
{
	imgImg[w] = new Image(10,10);
	imgImg[w].src = strImg[w];
}

function mouseLeft(){if(intPage>0){intPage--;intOn = 1;rollin();}else{intOn = 1;rolltoend();}}
function mouseRight(){if(intPage<intBookSize-1){intPage++;intOn = 2;rollin();}else{intOn = 2;rolltoend();}}

function clickLeft(){intOn = 0;walkin(1);}
function clickRight(){intPage++;intOn = 0;walkin(2);}

function hop(intGo)
{
	intNitro = intPage-intGo;
	if(intNitro<0)
		intNitro = intNitro * -1;
	if(intPage>intGo)
	{
		intPage = intGo + 1;
		mouseLeft();
	}
	else if(intPage<intGo)
	{
		intPage = intGo - 1;
		mouseRight();
	}
	//else
		//alert("no move");
}



function walkin(intDir)
{
	intOn = 0;
	var intHop = 0;
	var intImg = 0;
	var obj1 = document.getElementById("content-body");
	dblImg = obj1.scrollLeft/intImgSize;
	intImg = parseInt(dblImg);
	if(intDir==1)
	{
		if(obj1.scrollLeft<intImgSize)
			intMove = 0;
		else
		{
			if(intImg==dblImg)
				intImg--;
			intMove = intImg*intImgSize;
		}
	}
	else if(intDir==2)
	{
		if(obj1.scrollLeft<intImgSize)
			intHop = intImgSize - obj1.scrollLeft;
		else
		{
			if(intImg==dblImg)
				intHop = intImgSize;
			else if(intImg<dblImg)
			{
				intImg++;
				intHop = intImg*intImgSize - obj1.scrollLeft;
			}
		}
		intMove = obj1.scrollLeft + intHop;
	}
	obj1.scrollLeft = intMove;
}

function rollin()
{
	if(intOn>0)
	{
		var obj1 = document.getElementById("content-body");
		//var obj2 = document.getElementById('a' + intPage);
		var intStep = intStepSize * intNitro;
		var intT = intPage;
		tabsOff();
		spcOff();
		tabOn(intPage);
		if(intT>0)
			document.getElementById('spc' + intT).className = "spacer-bg";
		intT++;
		if(intT<intBookSize)
			document.getElementById('spc' + intT).className = "spacer-gb";
		if(intOn==1)
		{
			intStep = intStep * -1;
			intBookEnd = intPage * intImgSize;
			
			document.getElementById("spWes").innerHTML = obj1.scrollLeft + "-->" + intBookEnd;
			if(obj1.scrollLeft<=intBookEnd)
			{
				//alert("fin");
				intOn = 0;
				intNitro = 1;
				
			}
			else
			{
				obj1.scrollLeft = obj1.scrollLeft + intStep;
				setTimeout("rollin()",10);
			}
		}
		else
		{
			intBookEnd = intPage * intImgSize;
			document.getElementById("spWes").innerHTML = obj1.scrollLeft + "-->" + intBookEnd;
			if(obj1.scrollLeft>=intBookEnd)
			{
				//alert("fin");
				intOn = 0;
				intNitro = 1;
			}
			else
			{
				obj1.scrollLeft = obj1.scrollLeft + intStep;
				setTimeout("rollin()",10);
			}
		}
	}
}

function rolltoend()
{
	if(intOn>0)
	{
		var obj1 = document.getElementById("content-body");
		var intStep = 350;
		var intT = intPage;
		if(intOn==2)
		{
			tabsOff();
			spcOff();
			tabOn(0);
			document.getElementById("spc1").className = "spacer-gb";
			intStep = intStep * -1;
			intBookEnd = 0;
			document.getElementById("spWes").innerHTML = obj1.scrollLeft + "-->" + intBookEnd;
			if(obj1.scrollLeft<=intBookEnd)
			{
				
				//alert("fin");
				intPage = 0;
				intOn = 0;
				
			}
			else
			{
				obj1.scrollLeft = obj1.scrollLeft + intStep;
				setTimeout("rolltoend()",10);
			}
		}
		else
		{
			intBookEnd = intBookSize - 1;
			tabsOff();
			spcOff();
			tabOn(intBookEnd);
			document.getElementById("spc" + intBookEnd).className = "spacer-bg";
			intBookEnd = intBookEnd * intImgSize;
			document.getElementById("spWes").innerHTML = obj1.scrollLeft + "-->" + intBookEnd;
			if(obj1.scrollLeft>=intBookEnd)
			{
				//alert("fin");
				intPage = intBookSize - 1;
				intOn = 0;
			}
			else
			{
				obj1.scrollLeft = obj1.scrollLeft + intStep;
				setTimeout("rolltoend()",10);
			}
		}
	}
}

function hoverz(intTab)
{
	if(intTab!=intPage)
	{
		var intDist = intTab - intPage;
		if(intDist==1)
		{
			tabOn(intTab);
			document.getElementById('spc' + intTab).className = "spacer-gg";
			intTab++;
			if(intTab<intBookSize)
				document.getElementById('spc' + intTab).className = "spacer-gb";
		}
		else if(intDist==-1)
		{
			tabOn(intTab);
			if(intTab>0)
				document.getElementById('spc' + intTab).className = "spacer-bg";
			intTab++;
			if(intTab<intBookSize)
				document.getElementById('spc' + intTab).className = "spacer-gg";
		}
		else if(intDist>0)
		{
			tabOn(intTab);
			document.getElementById('spc' + intTab).className = "spacer-bg";
			intTab++;
			if(intTab<intBookSize)
				document.getElementById('spc' + intTab).className = "spacer-gb";
		}
		else if(intDist<0)
		{
			tabOn(intTab);
			if(intTab>0)
				document.getElementById('spc' + intTab).className = "spacer-bg";
			intTab++;
			document.getElementById('spc' + intTab).className = "spacer-gb";
		}
	}
	
}
function hoverzout(intTab)
{
	
	if(intTab!=intPage)
	{
		var intDist = intTab - intPage;
		if(intDist==1)
		{
			tabOff(intTab);
			document.getElementById('spc' + intTab).className = "spacer-gb";
			intTab++;
			if(intTab<intBookSize)
				document.getElementById('spc' + intTab).className = "spacer-bb";
		}
		else if(intDist==-1)
		{
			tabOff(intTab);
			if(intTab>0)
				document.getElementById('spc' + intTab).className = "spacer-bb";
			intTab++;
			if(intTab<intBookSize)
				document.getElementById('spc' + intTab).className = "spacer-bg";
		}
		else if(intDist>0)
		{
			tabOff(intTab);
			document.getElementById('spc' + intTab).className = "spacer-bb";
			intTab++;
			if(intTab<intBookSize)
				document.getElementById('spc' + intTab).className = "spacer-bb";
		}
		else if(intDist<0)
		{
			tabOff(intTab);
			if(intTab>0)
				document.getElementById('spc' + intTab).className = "spacer-bb";
			intTab++;
			document.getElementById('spc' + intTab).className = "spacer-bb";
		}
	}
	
}

function tabOn(intTab)
{
	document.getElementById('a' + intTab).style.backgroundPosition = "100% 100%";
}
function tabOff(intTab)
{
	document.getElementById('a' + intTab).style.backgroundPosition = "0% 0%";
}

function tabsOff()
{
	var x = 0;
	while(x<intBookSize)
	{
		document.getElementById('a' + x).style.backgroundPosition = "0% 0%";
		x++;
	}
}

function spcOff()
{
	x = 1;
	while(x<intBookSize)
	{
		document.getElementById('spc' + x).className = "spacer-bb";
		x++;
	}

}


function wesGo()
{
	goOpaque("dvSheet");
	setTimeout("goTransparent('dvSheet')",500);
}


function goOpaque(strID)
{
	fadeToMax(strID,0,100);
}
function goTransparent(strID)
{
	fadeToMax(strID,100,0);
}
function fadeToMax(strID,intStart,intMax)
{
	var speed = 2;
	var timer = 0;
	if(intStart<intMax)
	{
		for(i=intStart;i<=intMax;i++)
		{
			setTimeout("setOpacity('" + strID + "'," + i + ")",2 * timer);
			timer++;
		}
	}
	else if(intStart>intMax)
	{
		for(i=intStart;i>=intMax;i--)
		{
			setTimeout("setOpacity('" + strID + "'," + i + ")",2 * timer);
			timer++;
		}
	}
}
function setOpacity(strID,intW)
{
	document.getElementById(strID).style.opacity = intW/100;
	document.getElementById(strID).style.filter = "alpha(opacity=" + intW + ")";
}



function servHover(strID)
{
	goOpaque("dvSheet");
	setTimeout("hideAll()",350);
	setTimeout("showObj('" + strID + "')",350);
	setTimeout("goTransparent('dvSheet')",350);
}

function servSelect(strID)
{
	
	document.getElementById('aConsult').style.backgroundPosition = "100% 100%";
	document.getElementById('aWebdev').style.backgroundPosition = "100% 100%";
	document.getElementById('aMail').style.backgroundPosition = "100% 100%";
	document.getElementById('aSeo').style.backgroundPosition = "100% 100%";
	document.getElementById('aPpc').style.backgroundPosition = "100% 100%";
	document.getElementById('aOther').style.backgroundPosition = "100% 100%";
	
	document.getElementById(strID).style.backgroundPosition = "0% 0%";
	
}


function showObj(strID)
{
	document.getElementById(strID).style.display = "block";
}

function hideObj(strID)
{
	document.getElementById(strID).style.display = "none";
}
function hideAll()
{
	hideObj('site-consultation');
	hideObj('web-development');
	hideObj('email-marketing');
	hideObj('search-engine');
	hideObj('payperclick');
	hideObj('other');
}