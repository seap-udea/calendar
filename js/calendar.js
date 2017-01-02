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
//Time between updates
var TIMEUPDATE=30;//Seconds
//Refresh times
var DELTAT=100;//Milliseconds
//Maximum number of updates
var MAXUPDATE=6;

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
	if(field.indexOf("L")>=0) var H=pad(FECHA.getHours(),2);
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
	var pfra_mil=pad(Math.floor((pfra-pfra_int)*1000),3);
	$("#"+field+"_int").html(pint1+" "+pint2+"'");
	$("#"+field+"_fra").html(pfra_int+'<span class="blink_me">.</span><span class="w3-small">'+pfra_mil+'</span>');
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
	}else if(key=="GST" || key=="LST"){
	    fillTime(time+deltat*1.0027379,key,"time");
	}else if(key.indexOf("UNIX")>=0){
	    fillTime(time+deltat,key,"UNIX");
	}else if(key.indexOf("JD")>=0){
	    fillTime(time+(deltat/1e3)/86400,key,"JD");
	}else{
	    fillTime(time+deltat,key,"time");
	}
    }

    //UPDATE EVERY MINUTE OR SO
    if(qrepeat){
	if(UPDATE>MAXUPDATE) return 0;
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
		if(key=="LMST" || key=="LST"){
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

////////////////////////////////////////////////////////////////////////
//ON DOCUMENT READY
////////////////////////////////////////////////////////////////////////
$(document).ready(function() {
    
});
