<?php
////////////////////////////////////////////////////////////////////////
//CONSTANTS
////////////////////////////////////////////////////////////////////////
$MENATWORK=<<<M
<!--<img src="img/man-at-work.png" width="200px"></img>-->
<i class="fa fa-cogs w3-jumbo"></i><span class="w3-large" style="margin-left:10px">Men at work</span>
M;
foreach(array_keys($_GET) as $field){
    $$field=$_GET[$field];
}
foreach(array_keys($_POST) as $field){
    $$field=$_POST[$field];
}

$PYTHON="/usr/bin/python -W ignore";

$GANALYTICS=<<<G
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-89567672-1', 'auto');
ga('send', 'pageview');
G;

////////////////////////////////////////////////////////////////////////
//FUNCTIONS
////////////////////////////////////////////////////////////////////////
function facebookLink($url){
  
  $url_encoded=urlencode($url);
  
$fstr=<<<F
<a href="JavaScript:window.open('https://www.facebook.com/sharer/sharer.php?u=$url_encoded&src=sdkpreparse','Facebook','width=500,height=300')"><i class="fa fa-facebook-official w3-hover-text-indigo"></i></a>
F;

  return $fstr;
}

function twitterLink($url,$txt,$via="AstronomiaUdeA",$hashtags=""){
  
  $url_encoded=urlencode($url);
  $txt_encoded=urlencode($txt);

$fstr=<<<F
<a href="JavaScript:window.open('https://twitter.com/intent/tweet?text=$txt_encoded&via=$via&hashtags=$hashtags&url=$url_encoded','Tweet','width=500,height=300')"><i class="fa fa-twitter w3-hover-text-light-blue"></i></a>
F;

  return $fstr;
}

function ilink($aname,$type)
{
  if($type=="multiple"){$symb="?type=multiple&section=";}
  else{$symb="#";}
  return $symb.$aname;
}

////////////////////////////////////////////////////////////////////////
//INITIALIZE
////////////////////////////////////////////////////////////////////////
session_start();
$SESSID=session_id();
?>

