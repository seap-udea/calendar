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

function twitterLink($url,$txt,$via="AstronomiaUdeA"){
  
  $url_encoded=urlencode($url);
  $txt_encoded=urlencode($txt);

$fstr=<<<F
<a href="JavaScript:window.open('https://twitter.com/intent/tweet?text=$txt_encoded&via=$via&url=$url_encoded','Tweet','width=500,height=300')"><i class="fa fa-twitter w3-hover-text-light-blue"></i></a>
F;

  return $fstr;
}

function ilink($aname,$type)
{
  if($type=="multiple"){$symb="?type=multiple&section=";}
  else{$symb="#";}
  return $symb.$aname;
}
?>
