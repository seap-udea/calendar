////////////////////////////////////////////////////////////////////////
//EXTERNAL
////////////////////////////////////////////////////////////////////////

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
//GOOGLE ANALYTICS
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-89567672-1', 'auto');
ga('send', 'pageview');

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
//FACEBOOK
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

////////////////////////////////////////////////////////////////////////
//CONSTANTS
////////////////////////////////////////////////////////////////////////
var RAD=180/Math.PI;
var TIME_KEYS=[];

//INITIAL VALUES OF CONTROL VARIABLES
var FECHA=new Date();
//Timezone
var TZ=-FECHA.getTimezoneOffset()/60.0;
var UPDATE=1;
var INIDATE=0;
var TIMEOUT=0;
var LDELTAT=0;

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
//CONFIGURATION
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//TIMES
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//Time between updates
var TIMEUPDATE=30;//Seconds
//Refresh times
var DELTAT=100;//Milliseconds
//Maximum number of updates
var MAXUPDATE=6;

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//SPEED
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
var UPDATE_TIME=0;
var TIMEOUT_TIME=0;
var DELTAT_TIME=2000;
var MAXUPDATE_TIME=30;
var DV_TIME=0;
var OV_TIME=0;
var FAC_TIME=0.003;

////////////////////////////////////////////////////////////////////////
//ROUTINES
////////////////////////////////////////////////////////////////////////
function perihelionCounter(target)
{
    //Perihelion date
    var periTime=$('#perihelion-time').html()*1000;
    var futureDate=new Date(periTime);
    var currentDate = new Date();
    var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;
    if(diff<0){diff=0;}

    //Create clock
    var clock = $('.'+target).FlipClock(diff, {
	clockFace: 'DailyCounter',
	language: 'spanish',
	countdown: true
    });

    //If we have arrived show 'Happy Perihelion'
    if(diff==0)	$('.clock-end').show();

    //Change perihelion date
    $('.perihelion-date').html(futureDate.toLocaleString()+' (hora local)');

    //Manual
    //var currentDate = new Date(2016,11,31,23,59,50);
    //var futureDate=new Date(Date.UTC(2017,0,4,14,17,03));
    //var futureDate=new Date();
    //var futureDate=currentDate;
    //var futureDate=new Date(Date.UTC(2016,11,30,19,59,00));
    //var futureDate=new Date(Date.UTC(2017,0,4,14,17,03));
}

// Closure
(function() {
  /**
   * Decimal adjustment of a number.
   *
   * @param {String}  type  The type of adjustment.
   * @param {Number}  value The number.
   * @param {Integer} exp   The exponent (the 10 logarithm of the adjustment base).
   * @returns {Number} The adjusted value.
   */
  function decimalAdjust(type, value, exp) {
    // If the exp is undefined or zero...
    if (typeof exp === 'undefined' || +exp === 0) {
      return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // If the value is not a number or the exp is not an integer...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
      return NaN;
    }
    // Shift
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
  }

  // Decimal round
  if (!Math.round10) {
    Math.round10 = function(value, exp) {
      return decimalAdjust('round', value, exp);
    };
  }
  // Decimal floor
  if (!Math.floor10) {
    Math.floor10 = function(value, exp) {
      return decimalAdjust('floor', value, exp);
    };
  }
  // Decimal ceil
  if (!Math.ceil10) {
    Math.ceil10 = function(value, exp) {
      return decimalAdjust('ceil', value, exp);
    };
  }
})();

function dec2sex(dec){
    var H=Math.floor10(dec);
    var mm=(dec-H)*60
    var M=Math.floor10(mm);
    var ss=(mm-M)*60;
    var S=Math.floor10(ss);
    return H+":"+M+":"+S;
}

function floatMod(val,per){
    var ent=Math.floor10(val/per);
    var rem=val-ent*per;
    return rem;
}

function pad(num, size){
    var s = "000"+num;
    return s.substr(s.length-size);
}

function fillTime(stime,field,type){

    stime=parseFloat(stime);
    //console.log("Filling "+field+" with: "+stime);
    //$("#"+field+"_plain").html(stime);
    if(0){
    }else if(type=="time"){
	//console.log(field+"="+stime);
	FECHA=new Date(stime);
	var H=pad(FECHA.getUTCHours(),2);
	var M=pad(FECHA.getMinutes(),2);
	var S=pad(FECHA.getSeconds(),2);
	var m=pad(FECHA.getMilliseconds(),3);
	if(field=="LMT" || field=="MST" || field=="LAST" || field=="TST") var H=pad(FECHA.getHours(),2);
	var text=
	    H+'<span class="blink_me">:</span>'+
	    M+'<span class="blink_me">:</span>'+
	    S+'.<span class="w3-small">'+
	    m+'</span>';
	$("#"+field).html(text);
    }else if(type=="JD"){
	var pint=Math.floor10(stime);
	var pfra=Math.floor10(1e9*(stime-pint));
	$("#"+field+"_int").html(pint);
	$("#"+field+"_fra").html("<span class='blink_me'>.</span>"+pfra);
    }else if(type=="UNIX"){
	stime=stime/1e3;
	var pint=Math.floor10(stime/1e6);
	var pstr=pint+"";
	var pint1=pstr.substring(0,1);
	var pint2=pstr.substring(1,4);
	var pfra=Math.round10((stime/1e6-pint)*1e6,-3);
	var pfra_int=Math.floor(pfra);
	var pfrast=pfra_int+"";
	var pfra1=pfrast.substr(0,3);
	var pfra2=pfrast.substr(3,6);
	var pfra_mil=pad(Math.floor((pfra-pfra_int)*1000),3);
	$("#"+field+"_int").html(pint1+" "+pint2+"'");
	$("#"+field+"_fra").html(pfra1+" "+pfra2+'<span class="blink_me">.</span><span class="w3-small">'+pfra_mil+'</span>');
    }else if(type=="UTAI"){
	stime=stime/1e3;
	var pint=Math.floor10(stime/1e6);
	var pstr=pint+"";
	var pint1=pstr.substring(0,3);
	var pfra=Math.round10((stime/1e6-pint)*1e6,-3);
	var pfra_int=Math.floor(pfra);
	var pfrast=pfra_int+"";
	var pfra1=pfrast.substr(0,3);
	var pfra2=pfrast.substr(3,6);
	var pfra_mil=pad(Math.floor((pfra-pfra_int)*1000),3);
	$("#"+field+"_int").html(pint1+"'");
	$("#"+field+"_fra").html(pfra1+" "+pfra2+'<span class="blink_me">.</span><span class="w3-small">'+pfra_mil+'</span>');
    }
}

function fillTimes(){

    //SET CLOCKS
    var times={};
    for(var i=0;i<TIME_KEYS.length;i++){
	var key=TIME_KEYS[i];
	var time=$("#"+key+"_plain").html();
	//console.log(key+":"+time);
	times[key]=time;
	if(0){
	}else if(key=="DT"){
	    continue;
	}else if(key=="ET"){
	    continue;
	}else if(key.indexOf("UNIX")>=0){
	    fillTime(time,key,"UNIX");
	}else if(key.indexOf("UTAI")>=0){
	    fillTime(time,key,"UTAI");
	}else if(key.indexOf("JD")>=0){
	    fillTime(time,key,"JD");
	}else{
	    fillTime(time,key,"time");
	}
    }
}

function updateTime(qrepeat=1){

    var now=new Date();
    var lon=parseFloat($("#lon").val());
    var dt=lon-TZ*15;

    var deltat=now.getTime()-INIDATE.getTime();
    for(var i=0;i<TIME_KEYS.length;i++){
	var key=TIME_KEYS[i];
	var time=parseFloat($("#"+key+"_plain").html());
	var ntime=time+deltat;
	if(0){
	}else if(key=="DT"){
	    continue;
	}else if(key=="GAST" || key=="LAST"){
	    fillTime(time+deltat*1.0027379,key,"time");
	}else if(key.indexOf("UNIX")>=0){
	    fillTime(time+deltat,key,"UNIX");
	}else if(key.indexOf("UTAI")>=0){
	    fillTime(time+deltat,key,"UTAI");
	}else if(key.indexOf("JD")>=0){
	    fillTime(time+(deltat/1e3)/86400,key,"JD");
	}else{
	    fillTime(time+deltat,key,"time");
	}
    }

    //UPDATE EVERY MINUTE OR SO
    if(qrepeat){
	if(UPDATE>MAXUPDATE){
	    $('.play').show();
	    return 0;
	}
	if((deltat-LDELTAT)>(TIMEUPDATE*1000)){
	    console.log("Actualiza "+UPDATE);
	    getTimes();
	    LDELTAT=deltat;
	    UPDATE++;
	}else{
	    TIMEOUT=setTimeout(updateTime,DELTAT);
	}
    }
    return 0;
}

function getTimes(qrepeat=1){

    var lon=parseFloat($("#lon").val());
    localStorage.setItem("lon",lon);
    localStorage.setItem("TZ",TZ);
    $.ajax({
	url:'actions.php?action=time',
	success:function(result){
	    //GET TIMES
	    INIDATE=new Date();
	    var times=JSON.parse(result);
	    console.log(times);

	    //GET KEY OF TIMES
	    TIME_KEYS=Object.keys(times);

	    //SET PLAIN TIMES
	    for(var i=0;i<TIME_KEYS.length;i++){
		var key=TIME_KEYS[i];
		//CORRECT LOCAL TIMES
		if(key=="MST" || key=="LMST" || key=="TST"){
		    var dt=lon-TZ*15;
		    times[key]=parseFloat(times[key])+1000*dt/15*3600;
		}
		$("#"+key+"_plain").html(times[key]);
	    }
	    //FILE TIMES
	    fillTimes();

	    //UPDATE
	    if(qrepeat) TIMEOUT=setTimeout(updateTime,DELTAT);
	}
    });
}

function getSpeed(gauge,display,object='EARTH',center='SUN',factorv=1,qrepeat=1){

    $.ajax({
	url:'actions.php?action=speedometer&object='+object+'&center='+center,
	success:function(result){
	    var sign=0;
	    var datos=JSON.parse(result);
	    gauge.value((parseFloat(datos.speed)+DV_TIME)*factorv);
	    display.value(datos.distance);
	    $('#speed-'+object).html(Math.round10(parseFloat(datos.speed)*factorv,-8));
	    if(qrepeat){
		TIMEOUT_TIME=setTimeout(function(){getSpeed(gauge,display,object,center,factorv);},DELTAT_TIME);
		if(OV_TIME>0){
		    sign=Math.sign(parseFloat(datos.speed)-OV_TIME);
		}
		DV_TIME+=FAC_TIME*sign;
		OV_TIME=parseFloat(datos.speed);
	    }
	    if(UPDATE_TIME>MAXUPDATE_TIME)
		clearTimeout(TIMEOUT_TIME);
 	    UPDATE_TIME++;
	}
    });
}

function updateMoon(modo='now',fecha='')
{
    if(fecha){
	var dfecha=new Date(fecha)
	var mes=dfecha.getUTCMonth()+1;
	fecha=mes+'/'+dfecha.getUTCDate()+'/'+dfecha.getUTCFullYear()+' '+dfecha.getUTCHours()+':'+dfecha.getUTCMinutes()+':'+dfecha.getUTCSeconds();
    }

    url=encodeURI('actions.php?action=luna&modo='+modo+'&fecha='+fecha);
    console.log(url);
    $.ajax({
	url:url,
	success:function(result){
	    console.log(result);
	    var luna=JSON.parse(result);
	    $('.luna-image').attr("src",luna.url);
	    $('.luna-image').ready(function(){
		$('.luna-wait').hide();
		$('.luna-image').show();
		$('#luna').css("line-height","0px");
		$('#luna-phase').html(luna.phase);
		$('#luna-age').html(luna.age);
	    });
	}
    });
}

function changeDate(fecha)
{
    $('.luna-image').hide();
    $('#luna').css("line-height","400px");
    $('.luna-wait').show();
    updateMoon('manual',fecha);
}

function setDate()
{
    var fecha=new Date();
    var mes=fecha.getMonth()+1;
    var fechastr=mes+'/'+fecha.getDate()+'/'+fecha.getFullYear()+' '+fecha.getHours()+':'+fecha.getMinutes()+':'+fecha.getSeconds();
    $('#luna-fecha').val(fechastr);
}

////////////////////////////////////////////////////////////////////////
//ON DOCUMENT READY
////////////////////////////////////////////////////////////////////////
$(document).ready(function() {
    
});
