<!DOCTYPE html>

<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- PHP CODE -->
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<?php
require_once("php/calendar.php");
//$type="multiple";
if(isset($section)){$type="multiple";}
else if(!isset($type)){$type="single";}
if(preg_match("/\/dev\//",$_SERVER["SCRIPT_FILENAME"])){
   $title="Astrotiempo (dev)";
   $lcolor="w3-red";
   $GANALYTICS="";
    echo "Session: $SESSID";
}else{
   $title="Astrotiempo";
   $lcolor="";
}
if(isset($section)){
  if(preg_match("/-tag:/",$section)){
    $parts=preg_split("/-/",$section);
    $section=$parts[0];
    $parts=preg_split("/:/",$parts[1]);
    $tag=$parts[1];
    header("Refresh:0;url=?section=$section#$tag");
 }
}

// //////////////////////////////////////////////////////////////////////
// LISTA DE MÓDULOS
// //////////////////////////////////////////////////////////////////////

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// GENERAL
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
$link_general="http://astronomia-udea.co/calendar";
$fblink_general=facebookLink($link_general);
$tlink_general=twitterLink($link_general,"Astrotiempo: significados astronómicos para nuestra medida cotidiana del tiempo.","AstronomiaUdeA","Astrotiempo");

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// PERIHELIO
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
$link_eclipse="http://bit.ly/astrotiempo-eclipse";
$fblink_eclipse=facebookLink($link_eclipse);
$tlink_eclipse=twitterLink($link_eclipse,"¿A qué hora será visible y cómo lucirá el eclipse de Agosto 21, 2017 en mi ciudad?","AstronomiaUdeA","Astrotiempo");

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// PERIHELIO
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
$link_perihelio="http://bit.ly/astrotiempo-tierra-perihelio";
$fblink_perihelio=facebookLink($link_perihelio);
$tlink_perihelio=twitterLink($link_perihelio,"¿Cuántos días faltan para el próximo perihelio (el fin de año astronómico)?","AstronomiaUdeA","Astrotiempo");

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// VELOCIMETRO DE LA TIERRA
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
$link_veltierra="http://bit.ly/astrotiempo-tierra-velocimetro";
$fblink_veltierra=facebookLink($link_veltierra);
$tlink_veltierra=twitterLink($link_veltierra,"¿Cuál es la velocidad y distancia Tierra-Sol ahora? El velocímetro de la Tierra","AstronomiaUdeA","Astrotiempo");

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// QUE HORA ES
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
$link_hora="http://bit.ly/astrotiempo-quehoraes";
$fblink_hora=facebookLink($link_hora);
$tlink_hora=twitterLink($link_hora,"¿Qué hora es?, la respuesta de la astronomía","AstronomiaUdeA","Astrotiempo");

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// LUNA AHORA
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
$link_luna="http://bit.ly/astrotiempo-luna-ahora";
$fblink_luna=facebookLink($link_luna);
$tlink_luna=twitterLink($link_luna,"¿Cómo se esta viendo la luna justo en este momento?","AstronomiaUdeA","Astrotiempo");

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// LUNA VELOCIMETRO
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
$link_velluna="http://bit.ly/astrotiempo-luna-velocimetro";
$fblink_vel_luna=facebookLink($link_velluna);
$tlink_vel_luna=twitterLink($link_velluna,"¿Cuál es la velocidad y la distancia de la Luna ahora? El velocímetro de la Luna","AstronomiaUdeA","Astrotiempo");

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// LUNA FASES
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
$link_lunafases="http://bit.ly/astrotiempo-luna-fases";
$fblink_lunafases=facebookLink($link_lunafases);
$tlink_lunafases=twitterLink($link_lunafases,"¿Cuándo serán las próximas fases de la Luna?","AstronomiaUdeA","Astrotiempo");

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
// LUNA TERMINADOR
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
$link_terminador="http://bit.ly/astrotiempo-luna-terminador";
$fblink_terminador=facebookLink($link_terminador);
$tlink_terminador=twitterLink($link_terminador,"¿Qué se esta viendo en el terminador de la Luna en este momento?","AstronomiaUdeA","Astrotiempo");

?>

<html>
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- HEADER -->
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<head>
  <title><?php echo $title?></title>

  <meta property="og:image" content="http://astronomia-udea.co/calendar/img/FelizAno-square.png"/>
  <link rel="image_src" href="img/FelizAno-square.png"/>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <!--<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">-->
  <link rel="stylesheet" href="css/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

  <!-- Font awesome: http://fontawesome.io/icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Play:700,400" type="text/css">
  <link rel="stylesheet" href="css/calendar.css">

  <link rel="stylesheet" href="js/flipclock/flipclock.large.css">
  <link rel="stylesheet" media="screen and (max-width:800px)" href="js/flipclock/flipclock.small.css">

  <script src="js/jquery.js"></script>
  <script src="js/flipclock/flipclock.js"></script>	
  <script src="js/calendar.js"></script>	

  <!-- Source: Source: http://bl.ocks.org/metormote/6392996 -->
  <link rel="stylesheet" href="js/speedometer/speedometer.css" type="text/css">
  <script type="text/javascript" src="js/speedometer/d3.v3.min.js"></script>
  <script type="text/javascript" src="js/speedometer/pointerevents.js"></script>
  <script type="text/javascript" src="js/speedometer/pointergestures.js"></script>
  <script type="text/javascript" src="js/speedometer/iopctrl.js"></script>
  <script>
  <?php echo $GANALYTICS ?>
  </script>

</head>

<body class="w3-black">
<input type="hidden" id="LOCAL_LON" value="-75.34">
<input type="hidden" id="LOCAL_LAT" value="6.2">
<input type="hidden" id="UTC_OFF" value="-18000">
<input type="hidden" id="DST_OFF" value="0">
<input type="hidden" id="TIMEZONE" value="America/Bogota">
<input type="hidden" id="INFINITEC" value="">
<input type="hidden" id="NEXTECLIPSE" value="8/21/2017">

<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- ICON BAR (LARGE AND MEDIUM SCREENS) -->
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- Icon Bar (Sidenav - hidden on small screens) -->
<nav class="w3-sidenav w3-center w3-small w3-hide-small" style="width:120px">

  <a href="?"><img class="w3-hide-small <?php echo $lcolor?>" src="img/LogoSimbolo.png" width="80%"></a>
  
  <a class="w3-padding-large w3-black" href="<?php echo ilink('home',$type)?>">
    <i class="fa fa-home w3-xxlarge"></i>
    <p>INICIO</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="<?php echo ilink('eclipses',$type)?>">
    <i class="fa fa-sun-o fa-spin w3-xxlarge"></i>
    <p>ECLIPSES</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="<?php echo ilink('quehoraes',$type)?>">
    <i class="fa fa-clock-o w3-xxlarge"></i>
    <p>¿QUÉ HORA ES?</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="<?php echo ilink('faseslunares',$type)?>">
    <i class="fa fa-moon-o w3-xxlarge"></i>
    <p>FASES LUNARES</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="<?php echo ilink('finano',$type)?>">
    <i class="fa fa-circle-o-notch fa-spin w3-xxlarge"></i>
    <p>¿FIN DE AÑO?</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="<?php echo ilink('ubicacion',$type)?>">
    <i class="fa fa-map-o w3-xxlarge"></i>
    <p>UBICACIÓN</p>
  </a>


  <a class="w3-padding-large w3-hover-black w3-text-gray" href="<?php echo ilink('estaciones',$type)?>">
    <i class="fa fa-snowflake-o fa-spin w3-xxlarge"></i>
    <p>ESTACIONES</p>
  </a>

  <a class="w3-padding-large w3-hover-black w3-text-gray" href="<?php echo ilink('tiemposolar',$type)?>">
    <i class="fa fa-sun-o fa-spin w3-xxlarge"></i>
    <p>TIEMPO SOLAR</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="#sabermas">
    <i class="fa fa-book w3-xxlarge"></i>
    <p>SABER MÁS</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="#footer">
    <i class="fa fa-facebook w3-xxlarge"></i>
    <p>COMPARTE</p>
  </a>
</nav>

<?php 
echo<<<CONTENT
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- PAGE CONTENT -->
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<div class="w3-padding-large" id="main">

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- HEADER -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <header class="w3-container w3-padding-16 w3-center w3-black" id="home">

    <a href="?type=multiple"><img class="w3-hide-small" src="img/AstroTiempoLogo.png" width="40%"/></a>
    <img class="w3-hide-medium w3-hide-large" src="img/AstroTiempoLogo.png" width="80%"/>

    <h4 class="w3-hide-small">Significados astronómicos para nuestra medida cotidiana del tiempo.</h4>
    <h6 class="w3-hide-medium w3-hide-large">Significados astronómicos para nuestra medida cotidiana del tiempo.</h6>

    <i class="w3-small w3-hide-medium w3-hide-large w3-opacity">Es mejor si ves esta página en tu
    dispositivo móvil en posición horizontal</i>

  </header>

CONTENT;
if($type=="single" or (!isset($section) or $section=="home")){ 
echo<<<CONTENT
  <script>
  $(document).ready(function() {
      //DATE
      var fecha=new Date();
      var year=fecha.getFullYear();
      var pyear=year-1;
      var nyear=year+1;
      
      $.ajax({
	url:'actions.php?action=perihelion',
	    success:function(result){
	    $('#perihelion-time').html(result);
	    perihelionCounter('clock');
	  }
	});
    });
  </script>
  <div id="clock" class="w3-center flip-container" style="border:solid white 0px;text-align:center;margin:0 auto;margin-top:2em;">
    <span id="perihelion-time" class="w3-hide"></span>
    <span class="w3-text-grey">Tiempo para el próximo perihelio, <span class="perihelion-date"></span>:</span>
    <br><br/>

    <div class="clock" style="border:solid white 0px;"></div>
    <div class="clock-end w3-xxlarge" style="display:none">
      <i class="fa fa-star fa-spin"></i>
      ¡Feliz Perihelio 2017!
      <i class="fa fa-star fa-spin"></i>
    </div>

    <div class="w3-text-grey w3-xlarge w3-center">
      <div id="fb-root"></div>
      $fblink_perihelio
      $tlink_perihelio
    </div>
    <span class="w3-text-gray w3-large" style="font-family:courier"><a href="$link_perihelio">$link_perihelio</a></span>
  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- PRESENTACIÓN -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <div class="w3-content w3-justify w3-text-grey" id="inicio">
    <h2 class="w3-text-light-grey">Presentación</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>
      <i>Medio día, bisciesto, equinoccio, fin de año, estaciones,
      ocaso, luna nueva</i> etc. son palabras que usamos con mayor o
      menor frecuencia en la vida cotidiana para referirnos a la
      medida del tiempo.  Todos corresponden a términos astronómicos o
      están inspirados en fenómenos celestes.  Sin embargo, desde hace
      tiempo nuestros dispositivos tecnológicos (primero mecánicos y
      después electrónicos) aprendieron a imitar los ciclos en los que
      se basa nuestra medida del tiempo y nos desconectamos del cielo
      y de los fenómenos astronómicos que los inspiran.
    </p>
    <p>
      Este sitio es un esfuerzo para recuperar algunos de los
      significados astronómicos de nuestra medida cotidiana del
      tiempo.  También para reconocer algunas peculiaridades de esos
      mismos fenómenos que se desconocían en el tiempo en el que
      inventamos el calendario y que nos podrían obligar a reevaluar
      la manera como concebimos algunos eventos cruciales que ocurren
      todo el tiempo.
    </p>
    
    <p class="w3-text-gray w3-center">Una inicitiva de
      de: <a href="http://astronomia-udea.co" target="_blank">
	<img src="img/LogoAstronomiaUdeA-Transparente.png" width="250" align="center"></a>
    </p>

  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- ¿QUÉ HORA ES? -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
CONTENT;
}if($type=="single" or $section=="eclipses"){ 

echo<<<CONTENT

  <!-- ------------------------------------------------------------------------ -->
  <!-- RELOJ DEL ECLIPSE -->
	<!-- ------------------------------------------------------------------------ -->
  <script>
	function updateSimulation(){

	    //RESCALE CANVAS
	    var canvas=document.getElementById("eclipse_conditions");
	    var ctx=canvas.getContext("2d");
	    var conditions=$("#eclipse_conditions");
	    var w=conditions.width(),h=conditions.height();
	    ctx.canvas.width=w;
	    ctx.canvas.height=h;
	    ctx.clearRect(0,0,w,h);

	    var corona=0;
	    var rsun=0.2*h;

	    //GET PROPERTIES
	    var imag=$("#mag").html().replace("%","")/100;
	    var dmoon=$("#dmoon").html();
	    var dsun=$("#dsun").html();
	    var fmoon=dmoon/dsun;
	    var qtipo=$("#qtipo").html();
	    var mag=Math.abs(1-imag);

	    if(mag==1){
		mag=10;
	    }
	    if(qtipo==2)
		corona=1;

	    //PROPERTIES
	    var fillsky="#0080FF";
	    if(corona)
		fillsky="darkblue";
	    var fillsun="#F2F5A9";
	    var darksun="#B18904";
	    var darksun="#FACC2E";

	    //DRAW SKY
	    ctx.beginPath();
	    ctx.fillStyle=fillsky;
	    ctx.rect(0,0,w,h);
	    ctx.fill();

	    //DRAW CORONA
	    if(corona){
		grd=ctx.createRadialGradient(w/2,h/2,1.0*rsun,w/2,h/2,2.0*rsun);
		grd.addColorStop(0,fillsun);
		grd.addColorStop(1,fillsky);
		ctx.beginPath();
		ctx.strokeStyle=fillsky;
		ctx.fillStyle=grd;
		ctx.arc(w/2,h/2,2.0*rsun,0,2*Math.PI);
		ctx.stroke();
		ctx.fill()
	    }

	    //DRAW SUN
	    var grd=ctx.createRadialGradient(w/2,h/2,0.8*rsun,w/2,h/2,rsun);
	    grd.addColorStop(0,fillsun);
	    grd.addColorStop(1,darksun);
	    ctx.beginPath();
	    ctx.strokeStyle=darksun;
	    ctx.fillStyle=grd;
	    ctx.arc(w/2,h/2,rsun,0,2*Math.PI);
	    ctx.stroke();
	    ctx.fill()

	    //DRAW MOON
	    var rmoon=fmoon*rsun;
	    ctx.beginPath();
	    ctx.strokeStyle=fillsky;
	    ctx.fillStyle=fillsky;
	    ctx.arc(w/2-2*mag*rsun,h/2,rmoon,0,2*Math.PI);
	    ctx.stroke();
	    ctx.fill()

	    //DRAW SOLAR DISK CONTOUR
	    if(corona){
		ctx.beginPath();
		ctx.setLineDash([5,5]);
		ctx.strokeStyle="white";
		ctx.arc(w/2,h/2,rsun,0,2*Math.PI);
		ctx.stroke();
	    }

	    //TEXT
	    var fsize=h/25.0
	    var dmarg=20.0

	    var qtipo=$("#qtipo").html();
	    var tipo=$("#type").html();
	    var lat=$(".lat_ecl").html();
	    var lon=$(".lon_ecl").html();
	    var mag=$("#mag").html();
	    var obs=$("#obs").html();
	    var tc1=$("#tc1").html();
	    var tcmax=$("#tcmax").html();
	    var tc4=$("#tc4").html();
	    var duracion=$("#duracion").html();
	    var cspeed=$("#INFINITEC").val();
	    cspeed=cspeed.replace( /&infin;/, '\u221E' );

	    ctx.font=fsize+"px Helvetica";
	    ctx.fillStyle="white";

	    //POSITION
	    ctx.textAlign="left";
	    ctx.fillText("lat."+lat+", lon."+lon,w/dmarg,h/dmarg);

	    if(qtipo>0){
		//MAGNITUDE
		ctx.textAlign="right";
		ctx.fillText("Mag."+mag+", obs."+obs,w-w/dmarg,h-h/dmarg);
		
		//TIMES
		ctx.textAlign="center";
		ctx.fillText("Inicio "+cspeed+" "+tc1,w/2,3*h/dmarg);
		ctx.fillText("Máximo "+cspeed+" "+tcmax,w/2,4*h/dmarg);
		ctx.fillText("Fin "+cspeed+" "+tc4,w/2,5*h/dmarg);
		ctx.fillText("Duración "+cspeed+" "+duracion,w/2,h-4*h/dmarg);
	    }else{
		ctx.textAlign="center";
		ctx.fillText(tipo,w/2,3*h/dmarg);
	    }
	}

	function initMap(reset) {
	    var lat=parseFloat($('#LOCAL_LAT').val());
	    var lon=parseFloat($('#LOCAL_LON').val());
	    var pos={lat:lat,lng:lon};
	    var map=new google.maps.Map(document.getElementById("map_eclipse"),
					{center:pos,zoom: 4});
	    map.setZoom(6);

	    var marker = new google.maps.Marker({map:map,});
	    if(!localStorage.LOCAL_LON || reset){
		geoCoords(function(){
		    var lat=parseFloat($('#LOCAL_LAT').val());
		    var lon=parseFloat($('#LOCAL_LON').val());
		    var pos={lat:lat,lng:lon};
		    marker.setPosition(pos);
		    map.setCenter(pos);
		    if(reset){
			eclipseConditions();
			saveLocalVariables(LOCAL_VARS);
		    }
		},function(){});
	    }else{
		loadLocalVariables(LOCAL_VARS);
		var lat=parseFloat($('#LOCAL_LAT').val());
		var lon=parseFloat($('#LOCAL_LON').val());
		var pos={lat:lat,lng:lon};
		marker.setPosition(pos);
		map.setCenter(pos);
	    }

	    google.maps.event.addListener(map,'click',function(event) {
		var pos=event.latLng;
		var lon=pos.lng();
		var lat=pos.lat();
		$('#LOCAL_LAT').val(Math.round10(lat,-5));
		$('#LOCAL_LON').val(Math.round10(lon,-5));

		marker.setPosition(pos);
		map.setCenter(pos);
		$('.lat_ecl').html($('#LOCAL_LAT').val());
		$('.lon_ecl').html($('#LOCAL_LON').val());
		$('.eclipse_val').html("--");

		saveLocalVariables(LOCAL_VARS);
		eclipseConditions();
	    });
	}	

	function eclipseConditions(){

	    $(".infinity").html($("#INFINITEC").val());

	    var lat=parseFloat($('#LOCAL_LAT').val());
	    var lon=parseFloat($('#LOCAL_LON').val());
	    var time=new Date($('#NEXTECLIPSE').val()+" 12:00:00 +000").getTime()/1000.0;
	    
	    getTimeZone(lat,lon,time,function(r){

		var tzone=$('#TIMEZONE').val();
		var toff=parseFloat($('#UTC_OFF').val())+parseFloat($('#DST_OFF').val());

		$.ajax({
		    url:'actions.php?action=eclipse&lat='+lat+'&lon='+lon+'&date='+$('#NEXTECLIPSE').val()+'&luzvel='+$('#LUZVEL').val(),
		    success:function(result){
			
			var props=JSON.parse(result);
			
			//SET POSITIONS
			$('.lat_ecl').html(lat);
			$('.lon_ecl').html(lon);
			$('.tzone').html(tzone);
			
			//SET COUNTER
			$('#clock_eclipse-wait').hide();
			$('#clock_eclipse').show();
			$('#clock_eclipse-time').html(props["utc1"]);
			Counter('eclipse');
			
			//SET ECLIPSE CONDITIONS
			$('#type').html(props["type"]);
			$('#tc1').html(timeZone(props["utc1"],toff));
			$('#hc1').html(Math.round10(props["el_c1"],-1));
			$('#tcmax').html(timeZone(props["utcmax"],toff));
			$('#hmax').html(Math.round10(props["el_max"],-1));
			$('#tc4').html(timeZone(props["utc4"],toff));
			$('#hc4').html(Math.round10(props["el_c4"],-1));

			$('#mag').html(Math.round10(props["mag"],-1)+"%");
			$('#obs').html(Math.round10(props["obs"],-1)+"%");

			$('#duracion').html(props["duracion"]);

			$('#dmoon').html(Math.round10(props["size_moon"],-3));
			$('#dsun').html(Math.round10(props["size_sun"],-3));
			$('#qtipo').html(props["qtipo"]);

			$('#d_sun').html(Math.round10(props["d_sun"],-1));
			$('#d_moon').html(Math.round10(props["d_moon"],-1));

			$('#mu_sun').html(Math.round10(props["mu_sun"],-2));
			$('#mu_moon').html(Math.round10(props["mu_moon"],-2));

			$('#P1').html(Math.round10(props["P1"],-1)+"<sup>o</sup>");
			$('#V1').html(Math.round10(props["V1"],-1)+" horas");
			$('#P4').html(Math.round10(props["P4"],-1)+"<sup>o</sup>");
			$('#V4').html(Math.round10(props["V4"],-1)+" horas");

			//UPDATE SIMULATION
			updateSimulation();

		    }
		});
	    });

	}
    
    $(document).ready(function() {
	
	var qcoord=true;
	if(!localStorage.LOCAL_LON){
	    $("#LOCAL_LON").val("-75");
	    $("#LOCAL_LAT").val("6");
	    $("#UTC_OFF").val("-18000");
	    $("#TIMEZONE").val("America/Bogota");
	}else{
	    qcoord=false;
	}

	if(qcoord){
	    console.log("New variables");
	    geoCoords(function(){
		saveLocalVariables(LOCAL_VARS);
		eclipseConditions();
	    },function(){
		saveLocalVariables(LOCAL_VARS);
		eclipseConditions();
	    });
	}else{
	    console.log("Old variables");
	    loadLocalVariables(LOCAL_VARS);
	    eclipseConditions();
	}
    });
  </script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOpzHobhu8v34xNylZahKvK__a9V4KFf4&callback=initMap" async defer></script>

  <a name="eclipses"></a>
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="eclipse">
    <!--
    <h2 class="w3-text-light-grey">Eclipses</h2>
    <hr style="width:200px" class="w3-opacity">

    <p>
      Los eclipses de Sol y de Luna están entre los eventos
      astronómicos que despiertan más interés y fascinación entre la
      gente.
    </p>
    
    <p>
      Desde tiempos inmemoriales los eclipses han sido registrados y
      predichos por las culturas con formas avanzadas de
      conocimiento astronómico.
    </p>
    
    <p>
      La determinación precisa del momento en el que ocurren y su
      periodicidad han jugado un papel importante en la evolución del
      calendario y en la medida del tiempo.
    </p>

    <p>
      En esta sección encontrará información sobre los próximos
      eclipses de interés, su tiempo y la ubicación en la que pueden
      observarse.
    </p>
    -->

    <p></p>
    <h3 class="w3-text-light-grey">Eclipse de Sol del <span id="eclipse_fecha"></span></h3>
    <hr style="width:100%" class="w3-opacity">

    <center>
      <div id="clock_eclipse-wait" style="display:table;width:60vw;height:30vh;border:solid white 0px">
	<div style="display:table-cell;vertical-align:middle;font-size:2em;color:gray">
	  Obteniendo posición...
	</div>
      </div>	
    </center>
    
    <div id="clock_eclipse" class="w3-center flip-container" style="border:solid white 0px;text-align:center;margin:0 auto;margin-top:2em;display:none">
      <span id="clock_eclipse-time" class="w3-hide"></span>
      <span class="w3-text-grey" style="font-size:1.2em">Tiempo para el próximo eclipse total de Sol</a><br/>
      <span class="w3-text-grey" style="font-size:0.8em">para la ubicación lat. <span class="lat_ecl"></span>, lon. <span class="lon_ecl"></span>, <span class="clock_eclipse-date"></span>:</span>
      <br><br/>
      <div class="clock_eclipse" style="border:solid white 0px;"></div>
      <div class="clock_eclipse-end w3-xxlarge" style="display:none">
	<i class="fa fa-star fa-spin"></i>
	El eclipse ha comenzado
	<i class="fa fa-star fa-spin"></i>
      </div>
    </div>

    <p>
      Haga click en cualquier lugar en el mapa para conocer las
      condiciones del eclipse total de Sol en el sitio en cuestión.
    </p>

    <p>
      <i style="color:yellow">
	Este es un sito en construcción.  Estaremos actualizando y
	enriqueciendo el contenido a medida que se acerque la fecha del
	eclipse. ¡No dejen de visitarnos!
      </i>
    </p>

    <style>
      .eclipse_prop{
	  /*text-decoration:underline;*/
      }
      .eclipse_val{
      /*background:darkgray;*/
      }
      .eclipse_nota{
      text-decoration:underline;
      }
      li.notes{
      padding:10px;
      }
    </style>

    <center>
    <table id="eclipse_table" style="padding:10px">

      <tr><td colspan=2>
      <center>
	<i style="font-size:0.8em">En dispositivos móviles vea en posición horizontal y vuelva a cargar</i>
      </center>
      </td></tr>

      <tr><td colspan=2>
      <center>
	<div id="map_eclipse" style="width:50vw;height:70vh;z-index:100;float:left"></div>
	<canvas id="eclipse_conditions" style="border:solid white 0px;width:20vw;height:70vh">
      </center>
      </td></tr>

      <tr><td colspan=2>
      <center style="padding:0px">
	<a href="JavaScript:void" onclick="resetSite()"><i>Regresar a mi posición actual</i> <i class="fa fa-bathtub w3-xxlarge"></i></a>
      </center>
      </td></tr>

      <tr><td colspan=2>
      <center style="padding:50px">

	Suponemos que la <a href="#notas" onclick="$('#notas').toggle()">velocidad de la luz</a>
	es <input class="usuario" id="LUZVEL" type="text"
	value="299792.458" size="10"> km/s (<a href="JavaScript:void"
	onclick="recalcSpeed()">Recalcular</a>)<br/>
	<i style="font-size:0.8em">si pones "infinitos"
	(<a href="JavaScript:void" onclick="recalcSpeed(2)">click
	aquí</a>) los tiempos serán calculados asumiendo que la luz
	llegará instantaneamente (<a href="JavaScript:void"
	onclick="recalcSpeed(1)">click aquí</a> para valor real)</i>

      </center>
      </td></tr>

      <tr>
	<td colspan=2>
	  <center><a href="#notas">Zona horaria</a>:<span class="tzone digprop">--</span></center>
	  <div id="dsun" style="display:none">0</div>
	  <div id="dmoon" style="display:none">0</div>
	  <div id="qtipo" style="display:none">0</div>
	</td>
      </tr>

      <tr>
	<td><center><a href="#notas">Latitud</a>:<span class="lat_ecl digprop">--</span></center></td>
	<td><center><a href="#notas">Longitud</a>:<span class="lon_ecl digprop">--</span></center></td>
      </tr>
      
      <tr>
	<td><center>
	  <span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Tipo</a>:</span>
	  <div class="eclipse_val digprop" id="type">--</div>
	</center></td>
	<td><center>
	  <span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Duración</a> <span class="infinity"></span>:</span>
	  <div class="eclipse_val digprop" id="duracion">--</div>
	</center></td>
      </tr>

      <tr>
	<td><center>
	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Hora de inicio</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="tc1">--</div>
	</center></td>
	<td><center>
	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Altura inicio</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="hc1">--</div>
	</center></td>
      </tr>

      <tr>
	<td><center>
 	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Angulo inicio</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="P1">--</div>
	</center></td>
	<td><center>
	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Dirección inicio</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="V1">--</div>
	</center></td>
      </tr>

      <tr>
	<td><center>
 	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Hora de máximo</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="tcmax">--</div>
	</center></td>
	<td><center>
	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Altura máximo</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="hmax">--</div>
	</center></td>
      </tr>

      <tr>
	<td><center>
	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Hora de fin</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="tc4">--</div>
	</center></td>
	<td><center>
	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Altura fin</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="hc4">--</div>
	</center></td>
      </tr>

      <tr>
	<td><center>
 	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Angulo fin</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="P4">--</div>
	</center></td>
	<td><center>
	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Dirección fin</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="V4">--</div>
	</center></td>
      </tr>

      <tr>
	<td><center>
	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Magnitud</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="mag">--</div>
	</center></td>
	<td><center>
	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Oscurecimiento</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="obs">--</div>
	</center></td>
      </tr>

      <tr>
	<td><center>
	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Distancia Sol</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="d_sun">--</div>
	</center></td>
	<td><center>
	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Distancia Luna</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="d_moon">--</div>
	</center></td>
      </tr>

      <tr>
	<td><center>
	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Velocidad Sol</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="mu_sun">--</div>
	</center></td>
	<td><center>
	<span class="eclipse_prop"><a href="#notas" onclick="$('#notas').toggle()">Velocidad Luna</a> <span class="infinity"></span>:</span><br/>
	<div class="eclipse_val digprop" id="mu_moon">--</div>
	</center></td>
      </tr>

    </table>
    <span class="w3-xxlarge">
      $fblink_eclipse
      $tlink_eclipse
      <span class="w3-text-gray w3-large" style="font-family:courier">
	<a href="$link_eclipse">$link_eclipse</a>
      </span>
    </span>
    </center>

    <a name="notas"></a>
    <h4 class="w3-text-light-grey">Notas</h4> (<a href="JavaScript:void" onclick="$('#notas').toggle()">Ocultar/Mostrar</a>)
    <ul id="notas" style="display:none">

      <li class="notes"><span class="eclipse_nota">Velocidad de la
      luz</span>: La luz del Sol y la Luna se demora un tiempo en
      llegar a la Tierra (poco más de 8 minutos en el caso del Sol y
      poco más de 1 segundo para la Luna).  Por esta razón la posición
      que vemos del Sol y la Luna en el cielo no son sus posiciones
      reales (son sus posiciones en el pasado).  Los tiempos del
      eclipse calculados aquí tienen en cuenta este efecto. ¿A qué
      horas ocurriría el eclipse si la luz llegará instantáneamente
      desde el Sol y la Luna?. Usando esta página usted puede
      modificar la velocidad de la luz y ver cuál es el efecto que
      cambiar el tiempo de viaje de la luz tiene en la hora del
      eclipse.</li>

      <li class="notes"><span class="eclipse_nota">Zona horaria</span>: Todos los
      tiempos están dados en la hora que marcan los relojes del sitio
      señalado. La "Zona Horaria" es la denominación oficial de la
      zona de tiempo en la que se encuentra el lugar.  Normalmente
      esta formado por dos partes "Continente"/"Zona".</li>

      <li class="notes"><span class="eclipse_nota">Latitud y Longitud</span>: estas
      son la latitud y longitud geográfica del sitio de observación
      medida en grados.  La latitud es positiva al norte del ecuador y
      negativa al Sur.  La longitud es positiva al este del meridiano
      de Greenwich y negativa al oeste.  La latitud y longitud se dan
      con precisión de segundos de arco.</li>

      <li class="notes"><span class="eclipse_nota">Tipo</span>: Tipo de eclipse que
      se observará en el lugar señalado.  Los tipos posibles son:
      parcial (la luna no obstruye totalmente al Sol), total (la luna
      tapa al Sol al menos por un breve período de tiempo), no eclipse
      (desde la prosición la luna nunca tapa al Sol, ni siquiera
      parcialmente, no visible (el eclipse no se puede ver porque el
      Sol y la Luna están debajo del horizonte, es de noche).</li>
      
      <li class="notes"><span class="eclipse_nota">Duración</span>: Duración en
      horas, minutos y segundos (hh:mm:ss.sss) de la fase más
      interesante observable eclipse desde el lugar en cuestión.  En
      lugares en los que el eclipse es parcial esta es la duración
      desde que comienza el eclipse (primer contacto) hasta que
      termina (último contacto).  En lugares donde el eclipse es total
      la duración se refiere exclusivamente a la totalidad, es decir
      el tiempo en el que el Sol permanece completamente eclipsado y
      es visible la corona solar.</li>

      <li class="notes"><span class="eclipse_nota">Hora de inicio</span>: Hora (en
      tiempo local) del inicio del eclipse.  Este es el tiempo en el
      que desde el sitio señalado se produce el primer contacto, es
      decir en el que el disco de la luna tocal el disco solar por
      primera vez.</li>

      <li class="notes"><span class="eclipse_nota">Hora de máximo</span>: Hora (en
      tiempo local) del máximo eclipse.  Este es el tiempo en el que
      desde el sitio indicado el disco lunar esta más próximo al disco
      solar.  Cuando el eclipse es total este tiempo corresponde a la
      hora central de la totalidad.</li>

      <li class="notes"><span class="eclipse_nota">Hora de fin</span>: Hora (en
      tiempo local) en la que termina el eclipse.  Este es el tiempo
      en el que desde el sitio indicado se produce el último contacto,
      es decir el último momento en el que se ve el disco lunar
      "mordiendo" el disco solar.</li>
      
      <li class="notes">Todos los tiempos tienen un error de aproximadamente 2
      segundos debido a que no es posible predecir el desfase natural
      entre la rotación de la Tierra y nuestras medidas de tiempo.  En
      términos técnicos los tiempos son calculados en UT (Tiempo
      Universal) pero las observaciones se hacen respecto al UTC
      (Tiempo Universal Coordinado).  Para una explicación detallada
      de estas escalas lea el
      artículo <a href="http://www.investigacionyciencia.es/blogs/astronomia/76/posts/qu-hora-es-14889">"¿Qué
      hora es?" del scilog "Siderofilia"</a>.</li>

      <li class="notes"><span class="eclipse_nota">Altura (inicio, máximo y
      fin)</span>: Altura en grados sobre el horizonte a la que se
      encuentra el Sol en cada etapa del eclipse.  Una altura cercana
      a 0 grados corresponde a un Sol muy cercano al horizonte.  Una
      altura cercana a 90 grados corresponde a un Sol muy alto en el
      cielo.</li>

      <li class="notes"><span class="eclipse_nota">Magnitud</span>: Fracción del
      disco solar que es tapada por la Luna en el momento de máxima
      obstrucción.  Si la magnitud es mayor o igual a uno el eclipse
      es total.  Para el eclipse parcial la magnitud esta entre 0 (no
      hay eclipse) y más de 1 (eclipse total).  Una magnitud del 50%
      significa por ejemplo que la Luna esta tapando la mitad del
      disco solar.</li>

      <li class="notes"><span class="eclipse_nota">Oscurecimiento</span>: Fracción
      del area del disco solar que es tapada por la Luna en el momento
      de máximo eclipse. Cuando el eclipse es total el oscurecimiento
      es 100%. Si el eclipse es parcial el oscurecimiento esta entre
      0% (no hay eclipse) y 100%.  Si el oscurecimiento es 90%
      significa que el 90% de la superficie solar es tapada por la
      Luna.  El oscurecimiento esta directamente relacionado (pero no
      es exactamente igual) a la disminución en el brillo del Sol.
      Debe tenerse en cuenta que la magnitud y el oscurecimiento no
      son lo mismo. Así por ejemplo una magnitud de 25% corresponde a
      un oscurecimiento de apenas 14.4%.  Para una explicación
      detallada vaya
      a <a href="http://www.cosmicriver.net/blog/solar-eclipses-magnitude-and-obscuration">este
      sitio interactivo</a>.</li>

      <li class="notes"><span class="eclipse_nota">Distancia Sol,
      Luna</span>: Distancias al Sol y a la Luna medida en kilómetros
      en el momento del eclipse máxima. La distancia es calculada
      hasta el observador, no hasta el centro de la Tierra como es
      habitual.</li>

      <li class="notes"><span class="eclipse_nota">Velocidad Sol,
      Luna</span>: Velocidad angular del sol y de la Luna en el cielo
      momento del eclipse máximo en segundos de arco (arcoseg) por
      minuto.  Este número indica cuánto se están moviendo ambos
      cuerpos en el cielo.  El movimiento del Sol y en especial el de
      la Luna en el cielo son los responsables de que el eclipse
      ocurra.  Si la Luna se mantuviera en la misma posición nunca
      pasaría delante del Sol.</li>

    </ul>

    <h3 class="w3-text-light-grey">El eclipse en Latinoamérica</h3>
    
    <p>
      Aunque el eclipse será total en una extensa franja en los
      Estados Unidos en buena parte de Latinoamérica (el norte de
      Suramérica, Centroamérica y el Caribe) podrán disfrutar de un
      eclipse parcial que en algunos lugares alcanzará una magnitud
      superior al 80%.
    </p>

    <p>
      En los mapas abajo se resumen las propiedades básicas (magnitud
      y tiempos) que tendrá el eclipse parcial tal y como será visto
      desde esta región.
    </p>

    <center>
      <a href="data/mapa-magnitud-maximo-nat.png" target="_blank">
	<img src="data/mapa-magnitud-maximo-nat.png"/>
      </a><br/>
      <i class="footnote">
	Líneas de igual magnitud y tiempo de máximo eclipse para
	Centroamérica, el Norte de Suramérica y el
	Caribe.<br/><a href="data/mapa-magnitud-maximo-bla.pdf"
	target="_blank">Versión de alta resolución imprimible</a></i>
    </center>

    <p></p>

    <center>
      <a href="data/mapa-oscurecimiento-maximo-nat.png" target="_blank">
	<img src="data/mapa-oscurecimiento-maximo-nat.png"/>
      </a><br/>
      <i class="footnote">
	Oscurescimiento y tiempo del máximo.<br/><a href="data/mapa-oscurecimiento-maximo-bla.pdf"
	target="_blank">Versión de alta resolución imprimible</a></i>
    </center>

    <p></p>

    <center>
      <a href="data/mapa-magnitud-inicio-nat.png" target="_blank">
	<img src="data/mapa-magnitud-inicio-nat.png"/>
      </a><br/>
      <i class="footnote">
	Tiempo de inicio del
	eclipse.<br/><a href="data/mapa-magnitud-inicio-bla.pdf"
	target="_blank">Versión de alta resolución imprimible</a>
      </i>
    </center>

    <p></p>

    <center>
      <a href="data/mapa-magnitud-fin-nat.png" target="_blank">
	<img src="data/mapa-magnitud-fin-nat.png"/>
      </a><br/>
      <i class="footnote">
	Tiempo de fin del
	eclipse.<br/><a href="data/mapa-magnitud-fin-bla.pdf"
	target="_blank">Versión de alta resolución imprimible</a>
      </i>
    </center>

    <h3 class="w3-text-light-grey">El eclipse por zonas de Latinoamérica</h3>

    <p>
      En los mapas a continuación se muestran las condiciones del
      eclipse en distintas subregiones de latinoamérica donde será
      visible de forma parcial.
    </p>

    <center>
      <a href="data/mapa-magnitud-inicio-nat-MEX.png" target="_blank">
	<img src="data/mapa-magnitud-inicio-nat-MEX.png" width="40%"/>
      </a>
      <a href="data/mapa-magnitud-fin-nat-MEX.png" target="_blank">
	<img src="data/mapa-magnitud-fin-nat-MEX.png" width="40%"/>
      </a>
      <br/>
      <i class="footnote">
	El eclipse en México.<br/>Versión de alta resolución
	imprimible:<a href="data/mapa-magnitud-inicio-bla-MEX.pdf"
	target="_blank">Inicio</a>, <a href="data/mapa-magnitud-fin-bla-MEX.pdf"
	target="_blank">Fin</a>
      </i>
    </center>

    <p></p>

    <center>
      <a href="data/mapa-magnitud-inicio-nat-CEN.png" target="_blank">
	<img src="data/mapa-magnitud-inicio-nat-CEN.png" width="40%"/>
      </a>
      <a href="data/mapa-magnitud-fin-nat-CEN.png" target="_blank">
	<img src="data/mapa-magnitud-fin-nat-CEN.png" width="40%"/>
      </a>
      <br/>
      <i class="footnote">
	El eclipse en Centro América.<br/>Versión de alta resolución
	imprimible:<a href="data/mapa-magnitud-inicio-bla-CEN.pdf"
	target="_blank">Inicio</a>, <a href="data/mapa-magnitud-fin-bla-CEN.pdf"
	target="_blank">Fin</a>
      </i>
    </center>

    <p></p>

    <center>
      <a href="data/mapa-magnitud-inicio-nat-RD.png" target="_blank">
	<img src="data/mapa-magnitud-inicio-nat-RD.png" width="40%"/>
      </a>
      <a href="data/mapa-magnitud-fin-nat-RD.png" target="_blank">
	<img src="data/mapa-magnitud-fin-nat-RD.png" width="40%"/>
      </a>
      <br/>
      <i class="footnote">
	El eclipse en Haití, República Dominicana y Puerto
	Rico.<br/>Versión de alta resolución
	imprimible:<a href="data/mapa-magnitud-inicio-bla-RD.pdf"
	target="_blank">Inicio</a>, <a href="data/mapa-magnitud-fin-bla-RD.pdf"
	target="_blank">Fin</a>
      </i>
    </center>

    <p></p>

    <center>
      <a href="data/mapa-magnitud-inicio-nat-COL.png" target="_blank">
	<img src="data/mapa-magnitud-inicio-nat-COL.png" width="40%"/>
      </a>
      <a href="data/mapa-magnitud-fin-nat-COL.png" target="_blank">
	<img src="data/mapa-magnitud-fin-nat-COL.png" width="40%"/>
      </a>
      <br/>
      <i class="footnote">
	El eclipse en Colombia y Venezuela.<br/>Versión de alta
	resolución
	imprimible:<a href="data/mapa-magnitud-inicio-bla-COL.pdf"
	target="_blank">Inicio</a>, <a href="data/mapa-magnitud-fin-bla-COL.pdf"
	target="_blank">Fin</a>
      </i>
    </center>

    <p></p>

    <a name="actividades"></a>
    <h3 class="w3-text-light-grey">Actividades durante el eclipse parcial</h4>
    <hr style="width:50%" class="w3-opacity">

    <p>
      Si bien los eclipses totales de sol son considerados como los
      únicos que ofrecen oportunidades interesantes para la
      astrofotografía o los estudios científicos del sol y de la luna,
      también existen observaciones y actividades interesantes que
      pueden realizarse durante un eclipse parcial.
    </p>

    <p>
      A continuación se describen algunas observaciones o medidas que
      muchos de nosotros podemos hacer con equipos modestos y con la
      ayuda de otros entusiastas y que nos permitiran obtener datos
      asombrosos sobre el Sol y la Luna.:
    </p>

    <ul>

      <li>

	<p>
	  <b class="w3-text-light-grey">Tamaños del Sol y la
	  Luna</b>. Cuando se observa el disco lunar en un eclipse hay
	  una oportunidad única para medir, con la ayuda de un amigo
	  en otra ciudad o en otro país, nada más y nada menos que la
	  distancia a la Luna. Para ello nos valemos de un fenómeno
	  conocido como "paralaje" (ver figura).
	</p>

	<p>
	  <b class="w3-text-light-grey">Paralaje lunar</b>. Cuando se
	  observa el disco lunar en un eclipse hay una oportunidad
	  única para medir, con la ayuda de un amigo en otra ciudad o
	  en otro país, nada más y nada menos que la distancia a la
	  Luna. Para ello nos valemos de un fenómeno conocido como
	  "paralaje" (ver figura)
	</p>

	<center>
	</center>
	
	<p>
	  Si medimos la diferencia entre la posición de cualquier
	  objeto visto desde dos lugares cuya distancia mutua es
	  conocida (los dos sitios de observación) es posible estimar
	  la distancia a la Luna.
	</p>

      </li>

      <li>
	<p>
	  <b class="w3-text-light-grey">La velocidad de la
	  luz</b>. Cuando vemos a la Luna eclipsar el Sol, algo
	  extraordinario esta ocurriendo.  Por estar el Sol tan lejos,
	  su luz nos llega mucho tiempo después de que nos ha llegado
	  la luz de la Luna.  Para ser exactos a la luz del Sol le
	  toma 500 segundos llegar a la Tierra (8.31 minutos).  Como
	  resultado lo que vemos en el cielo durante un eclipse es
	  como la Luna eclipsa una imagen pasada del Sol.
	</p>
	
	<p>
	  Hagamos cuentas.  El Sol se mueve (aparentemente) alrededor
	  de la Tierra completando una vuelta en 365.25 días.  Esto
	  corresponde a un avance de 0.986 grados/dia o 0.986*3600
	  segundos de arco (arcoseg) por día (1 arcoseg = 1/3600
	  grado).  Él día tiene 1440 minutos, por lo que la velocidad
	  de avance del Sol en el cielo es de 2.46 arcoseg por minuto.
	  Como la luz del Sol se demora 8.31 minutos en llegar a la
	  Tierra, la imagen que vemos en el cielo esta realmente
	  desplazada un total de 2.46*8.31 = 20.5 arcoseg.  Parece muy
	  poco, pero para la Luna, que esta "persiguiendo" al Sol en
	  el cielo, este efecto hace que la Luna empiece a tapar el
	  Sol antes de tiempo.
	</p>

	<p>
	  La Luna se mueve alrededor de la Tierra con un período de
	  29.2 días.  Si es así, en el cielo la Luna tiene una
	  velocidad angular de 360/29.2 = 12.3 grados/día o
	  equivalentemente a 30.8 arcoseg/min.  Si el Sol esta
	  desplazado de su posición real por 20.5 arcoseg, la Luna
	  llega a su cita con él 20.5/30.8=0.67 minutos (40 segundos)
	  antes de lo esperado.
	</p>

	<p>
	  Durante el eclipse podemos revertir este razonamiento.  Si
	  observamos con atención y registramos el momento en el que
	  la Luna toca al Sol por primera vez (primer contacto) o en
	  el que termina el eclipse (cuarto contacto) y comparamos
	  este tiempo con el que esperaríamos si la luz hubiera
	  llegado instantáneamente desde el Sol, podemos obtener el
	  tiempo que le tomo a la luz llegar desde el Sol. De allí
	  podríamos calcular la velocidad de la luz.
	</p>

      </li>

      <li>
	<p>
	  <b class="w3-text-light-grey">El Sol es gaseoso</b>. El Sol
	  es unobjeto gaseoso.  Aunque no nos parece así, en realidad
	  la que vemos como la superficie del Sol no corresponde a un
	  piso bien definido, como el que tienen los planetas.  Pero
	  ¿cómo lo sabemos?.  Una manera de reconocer la naturaleza
	  gaseosa del Sol es observar con cuidado el denominado
	  "oscurescimiento del limbo" solar.
	</p>
      </li>

    </ul>


  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- ¿QUÉ HORA ES? -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
CONTENT;
}if($type=="single" or $section=="quehoraes"){ 
$buttons=<<<B
	<tr>
	  <td colspan=3 class="w3-xxlarge w3-center">
	    <a class="play" href="JavaScript:void(0)" onclick="$('.play').hide();UPDATE=1;getTimes()" style="display:none;"><i class="fa fa-play w3-hover-text-red"></i></a>
	    <a href="JavaScript:void(0)" onclick="$('.play').show();UPDATE=1;clearTimeout(TIMEOUT)"><i class="fa fa-pause w3-hover-text-red"></i></a>
	    <a href="JavaScript:void(0)" onclick="UPDATE=1;updateTime(0)"><i class="fa fa-step-forward w3-hover-text-red"></i></a>
	    <a href="JavaScript:void(0)" onclick="UPDATE=1;getTimes(0)"><i class="fa fa-repeat w3-hover-text-red"></i></a>
	    $fblink_hora
	    $tlink_hora
	  </td>
	</tr>
B;

echo<<<CONTENT
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="quehoraes">
    <h2 class="w3-text-light-grey">¿Qué hora es?</h2>
    <hr style="width:200px" class="w3-opacity">

    <p>
      ¿Sabe usted a ciencia cierta qué hora es?.  Esta pregunta
      aparentemente inocente tiene bastante profundidad en astronomía.
    </p>

    <p>
      Para un relato didáctico sobre esta aparentemente sencilla
      pregunta lea el
      artículo <a href="http://www.investigacionyciencia.es/blogs/astronomia/76/posts/qu-hora-es-14889"
      target="_blank">"¿Qué hora es?"</a>, entrada
      del <a href="http://www.investigacionyciencia.es/blogs/astronomia/76/posts"
      target="_blank">Blog Siderofilia</a> de
      la <a href="http://www.investigacionyciencia.es/"
      target="_blank">revista Investigación y Ciencia</a>.
    </p>

    <p>
      Algunas de las horas dependen de la longitud geográfica en la
      que te encuentras.  Si sabes tu longitud precisa indicala a
      continuación (con solo cambiarla se actualizaran las horas
      abajo).  Si no la conoces puedes buscarla
      con <a href="http://www.whatsmygps.com"
      target="_blank">http://www.whatsmygps.com</a>
    </p>
    <p>
      Tu longitud geográfica: <input data-type="time" id="lon" type="text" 
				     name="lat"
				     value="-75.3" 
				     class="coordinput" 
				     onchange="getTimes(0)" size="100">
      <span id="lon_rec">
	<i id="lon_rec" class="fa fa-snowflake-o fa-spin w3-xlarge"></i>
	Buscando longitud...
      </span>
      
    </p>

    <center>
      <script>
         $(document).ready(function() {
	     if(!localStorage.lon || TZ!=localStorage.TZ){
	       var lon=TZ*15.0;
	       var dlon=1-2*Math.random();
	       lon+=dlon;
	     }else{
	       lon=localStorage.lon;
	     }
	     $("#lon").val(Math.round10(lon,-3));
	     getTimes();
	   });
         if (navigator.geolocation) {
	   navigator.geolocation.getCurrentPosition(function(position) {
	       $("#lon").val(Math.round10(position.coords.longitude,-3));
	       $("#lon_rec").hide();
	       getTimes();
	     }, function(){
	       $("#lon_rec").html("<i style='color:red'>No encontrada</i>");
	     });
	 } else {
	   $("#lon_rec").html("<i style='color:red'>No encontrada</i>");
	 }
      </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOpzHobhu8v34xNylZahKvK__a9V4KFf4&callback=initMap" async defer></script>

      <div data-type="time" id="DT_plain" class="w3-hide"></div>
      <div data-type="time" id="ET_plain" class="w3-hide"></div>

      <table class="time-table" width="80%">

	<tr>
	  <td style="width:10%"></td>
	  <td style="width:35%"></td>
	  <td class="w3-hide-small w3-hide-medium"></td>
	</tr>
	
	$buttons

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:LMT">LMT</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="LMT_plain" class="w3-hide"></div>
	    <div data-type="time" id="LMT" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:LMT">Tiempo medio local</a>, tiempo que
	    marcan los relojes en el huso horario.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:MST">MST</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="MST_plain" class="w3-hide"></div>
	    <div data-type="time" id="MST" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:TSM">Tiempo solar medio local</a>, hora solar media en el
	    lugar exacto en el que se encuentra.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:TST">TST</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="TST_plain" class="w3-hide"></div>
	    <div data-type="time" id="TST" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:TSM">Tiempo solar verdadero</a>, hora solar
	    verdadera en el lugar exacto en el que se encuentra.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:UTC">UTC</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="UTC_plain" class="w3-hide"></div>
	    <div data-type="time" id="UTC" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:UTC">Tiempo Universal Coordinado</a>,
	    tiempo medio local en Greenwich.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:UT1">UT1</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="UT1_plain" class="w3-hide"></div>
	    <div data-type="time" id="UT1" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:UT1">Tiempo Universal</a>, tiempo medio en
	    Greenwich ajustado a la rotación de la Tierra.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:TAI">TAI</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="TAI_plain" class="w3-hide"></div>
	    <div data-type="time" id="TAI" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:TAI">Tiempo Atómico Internacional</a>, tiempo
	    que marcan los relojes atómicos del mundo.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:TCG">TCG</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="TCG_plain" class="w3-hide"></div>
	    <div data-type="time" id="TCG" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:TCG">Tiempo Geocéntrico Coordenado</a>.
	    Tiempo medido en el centro de la Tierra.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:TCB">TCB</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="TCB_plain" class="w3-hide"></div>
	    <div data-type="time" id="TCB" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:TCB">Tiempo Baricéntrico coordenado</a>.
	    Tiempo medido en el baricentro del Sistema Solar.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:TDT">TDT</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="TDT_plain" class="w3-hide"></div>
	    <div data-type="time" id="TDT" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:TDT">Tiempo Dinámico Terrestre</a>.  Tiempo atómico en el centro de la Tierra.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:TDB">TDB</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="TDB_plain" class="w3-hide"></div>
	    <div data-type="time" id="TDB" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:TDB">Tiempo Dinámico del Baricentro</a>.
	    Tiempo atómico en el Baricentro del Sistema Solar.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:GAST">GAST</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="GAST_plain" class="w3-hide"></div>
	    <div data-type="time" id="GAST" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:GAST">Tiempo sideral aparente en Greenwich</a>,
	    ascensión recta de los cuerpos que están culminando en
	    Greenwich.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:LAST">LAST</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="LAST_plain" class="w3-hide"></div>
	    <div data-type="time" id="LAST" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:LAST">Tiempo sideral aparente local</a>,
	    ascensión recta de los cuerpos que están culminando en
	    Greenwich.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name" valign="top">
	    <a href="#hora:UTAI">TAI(s)</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="UTAI_plain" class="w3-hide"></div>
	    <div data-type="time" id="UTAI_int" style="font-family:courier;color:red">---'</div>
	    <div data-type="time" id="UTAI_fra" class="digclock" style="text-align:center">
	      ------.<span class="w3-small">---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:UTAI">Tiempo de UTAI</a>. Número de segundos
	    transcurridos desde Enero 1 de 2000 a las 0:00.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name" valign="top">
	    <a href="#hora:UNIX">UNIX(s)</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="UNIX_plain" class="w3-hide"></div>
	    <div data-type="time" id="UNIX_int" style="font-family:courier;color:red">- ---'</div>
	    <div data-type="time" id="UNIX_fra" class="digclock" style="text-align:center">
	      ------.<span class="w3-small">---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:UNIX">Tiempo de UNIX</a>. Número de segundos
	    transcurridos desde Enero 1 de 1970 a las 0:00.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name" valign="top">
	    <a href="#hora:JD">JD(d)</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="JD_plain" class="w3-hide"></div>
	    <div data-type="time" id="JD_int" style="font-family:courier;color:red">-------.</div>
	    <div data-type="time" id="JD_fra" class="digclock" style="text-align:center">
	      ---------
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:LST">Día juliano referido a UTC</a>, días
	    transcurridos desde Enero 1 de 4713 a.e.c.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name" valign="top">
	    <a href="#hora:JDB">JDB(d)</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div data-type="time" id="JDB_plain" class="w3-hide"></div>
	    <div data-type="time" id="JDB_int" style="font-family:courier;color:red">-------.</div>
	    <div data-type="time" id="JDB_fra" class="digclock" style="text-align:center">
	      ---------
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:LST">Día juliano referido al baricentro</a>,
	    días transcurridos desde Enero 1 de 4713 a.e.c referidos al
	    baricentro del Sistema Solar.
	  </td>
	</tr>

	$buttons

      </table>
    </center>
  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- FASES LUNARES -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
CONTENT;
}if($type=="single" or $section=="faseslunares"){ 
echo<<<CONTENT

  <div class="w3-content w3-justify w3-text-grey w3-padding-32" data-type="time" id="faseslunares">
    <h2 class="w3-text-light-grey">Fases lunares</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>
      La Luna es la base de la medida del tiempo a mediano y largo
      plazo en casi todas las culturas del planeta.  Por eso, al
      hablar del tiempo, es inevitable referirse a ella
    </p>

    <div class="w3-center">
      <h3 class="w3-large">
	<a name="luna_ahora">
	La luna <a href="JavaScript:void(null)"
	       onclick="setDate();updateMoon()">ahora</a> 
	</a><br/>
	<i class="fa fa-hand-o-right"></i>
	<input class="luna-fecha" type="text"
	       name="fecha" value="01/01/2011 00:00:00"
	       style="text-align:center;background:black;color:gray;border:none"
	       onchange="changeDate($(this).val())"
	       size="20em"
	       onhover=""> LTM
      </h3>

      <div id="luna" style="width:400px;line-height:400px;margin:auto;text-align:center">
	<i id="luna-wait" class="fa fa-snowflake-o w3-jumbo fa-spin"></i>
	<a id="luna-url" href="">
	<img id="luna-image" src="" width="100%" style="display:none"/>
	</a>
      </div>
      <div class="w3-text-grey w3-xlarge w3-center">
	<div id="fb-root"></div>
	$fblink_luna
	$tlink_luna 
	<a href="#luna_creditos" class="w3-small">Créditos</a>
      </div>
      <p>
	Fase: <span id="luna-phase">--</span>, 
	Edad: <span id="luna-age">--</span>
	<div style="font-size:0.8em">
	  Error: <span id="luna-error">--</span>
	</div>
      </p>
      <span class="w3-text-gray w3-large" style="font-family:courier"><a href="$link_velluna">$link_luna</a></span>
      <script>
	$(document).ready(function(){
	    setDate();
	    updateMoon();
	});
      </script>
    </div>

    <h4>
    <a name="proximos_cuartos">
      <span class="w3-text-white w3-large">Próximos cuartos</span>      
    </a>
    </h4>

    <p>
      Los cuartos de fase lunar corresponden a condiciones especiales
      de iluminación.  El cuarto inicial es la <i>luna nueva</i>
      cuando la fracción de superficie iluminada que podemos ver es
      despreciable (aproximadamente 0%).  El primer cuarto o <i>cuarto
      creciente</i> corresponde a la situación en la cuál vemos el 50%
      de la cara iluminada de la luna.  El segundo cuarto o <i>luna
      llena</i> corresponde al instante en el que podemos ver casi
      toda la cara visible de la Luna iluminada por el Sol.  Y el
      tercer cuarto o <i>cuarto menguante</i> corresponde a una
      situación similar a la del primer cuarto pero en la cual la
      porción que estuvo a oscuras en ese cuarto esta ahora iluminada
      y la que estuvo iluminada esta ahora oscura.
    </p>
    
    <p>
      A continuación encontrarás las fechas y horas exactas de los
      próximos 4 cuartos (<i>período sinódico</i>).
    </p>

    <div class="w3-center">
      <center>
      <table width="500px" border="0px">

	<tr>
	  <td class="quarter-image">
	    <a id="quarter1-url" href="#luna_ahora" onclick="">
	      <div id="quarter1-image-container">
		<img id="quarter1-image" src="" width="300px" style="display:none">
		<i class="quarter-wait fa fa-snowflake-o w3-jumbo fa-spin"></i>
	      </div>
	    </a>
	  </td>
	  <td class="quarter-date">
	    <span id="quarter1-name" style="font-size:1.2em">--</span><br/>
	    <span id="quarter1-date" style="font-family:courier">--/--/----, --:--:--</span>
	  </td>
	</tr>

	<tr>
	  <td class="quarter-image">
	    <a id="quarter2-url" href="#luna_ahora" onclick="">
	      <div id="quarter2-image-container">
		<img id="quarter2-image" src="" width="300px" style="display:none">
		<i class="quarter-wait fa fa-snowflake-o w3-jumbo fa-spin"></i>
	      </div>
	    </a>
	  </td>
	  <td class="quarter-date">
	    <span id="quarter2-name" style="font-size:1.2em">--</span><br/>
	    <span id="quarter2-date" style="font-family:courier">--/--/----, --:--:--</span>
	  </td>
	</tr>

	<tr>
	  <td class="quarter-image">
	    <a id="quarter3-url"  href="#luna_ahora" onclick="">
	      <div id="quarter3-image-container">
		<img id="quarter3-image" src="" width="300px" style="display:none">
		<i class="quarter-wait fa fa-snowflake-o w3-jumbo fa-spin"></i>
	      </div>
	    </a>
	  </td>
	  <td class="quarter-date">
	    <span id="quarter3-name" style="font-size:1.2em">--</span><br/>
	    <span id="quarter3-date" style="font-family:courier">--/--/----, --:--:--</span>
	  </td>
	</tr>

	<tr>
	  <td class="quarter-image">
	    <a id="quarter4-url" href="#luna_ahora" onclick="">
	      <div id="quarter4-image-container">
		<img id="quarter4-image" src="" width="300px" style="display:none">
		<i class="quarter-wait fa fa-snowflake-o w3-jumbo fa-spin"></i>
	      </div>
	    </a>
	  </td>
	  <td class="quarter-date">
	    <span id="quarter4-name" style="font-size:1.2em">--</span><br/>
	    <span id="quarter4-date" style="font-family:courier">--/--/----, --:--:--</span>
	  </td>
	</tr>

      </table>

      <div class="w3-text-grey w3-xlarge w3-center">
	<div id="fb-root"></div>
	$fblink_lunafases
	$tlink_lunafases
	<a href="#luna_creditos" class="w3-small">Créditos</a>
      </div>
	  
      <span class="w3-text-gray w3-large" style="font-family:courier"><a href="$link_lunafases">$link_lunafases</a></span>
      </center>

      <script>
	$(document).ready(function(){
	    updateQuarters();
	});
      </script>

    </div>

    <a name="craters_luna">
      <span class="w3-text-white w3-large">Identificación de cráteres</span>      
    </a>

    <p>
      En los lugares que están cerca al denominado <i>terminador</i>
      de la Luna, las sombras proyectadas por los cráteres, montañas y
      otros accidentes topográficos lunares son mucho más largas que
      en otras partes iluminadas de nuestro satélite.  Por esa misma
      razón es mucho más interesante observar la luna en fases
      diferentes a la llena, que muchos prefieren.
    </p>

    <p>
      En la siguiente imagen encontrarás el nombre de los accidentes
      lunares que se encuentran justo en el terminador lunar en este
      instante (o en el instante que tu desees).  La imagen fue
      preparada por el
      <a href="https://svs.gsfc.nasa.gov/index.html">estudio de
      visualización de NASA</a> usando para ello mapas de la misión
      LRO.
    </p>
    
    <div class="w3-center">
      <a name="luna_terminador">
      <h3 class="w3-large">
	Crateres en el terminador <a href="JavaScript:void(null)"
	       onclick="setDate();updateMoonCrateres()">ahora</a>
	<br/>
	<i class="fa fa-hand-o-right"></i>
	<input class="luna-fecha" type="text"
	       name="fecha" value="01/01/2011 00:00:00"
	       size="20em"
	       style="text-align:center;background:black;color:gray;border:none"
	       onchange="changeDateCrateres($(this).val())"
	       onhover=""> LTM
      </h3>
      </a>
      <div id="luna-crateres" style="width:400px;line-height:400px;margin:auto;border:solid white 0px;text-align:center">
	<i id="luna-crateres-wait" class="fa fa-snowflake-o w3-jumbo fa-spin"></i>
	<a id="luna-crateres-url" href="">
	  <img id="luna-crateres-image" src="" width="100%" style="display:none"/>
	</a>
	<br/><br/>
	<div style="padding:20px">
	<i class="w3-small">Crédito: Estudio de Visualización de NASA, <a href="https://svs.gsfc.nasa.gov/4537">Fases y Libración Lunar</a></i>
	</div>
      </div>

      <script>
	$(document).ready(function(){
	    updateMoonCrateres();
	});
      </script>
	<div class="w3-text-grey w3-xlarge w3-center">
	  <div id="fb-root"></div>
	  $fblink_terminador
	  $tlink_terminador
	  <a href="#luna_creditos" class="w3-small">Créditos</a>
	</div>
      <span class="w3-text-gray w3-large" style="font-family:courier"><a href="$link_terminador">$link_terminador</a></span>
    </div>
    
    <p></p>

    <a name="speedometer_luna">
      <span class="w3-text-white w3-large">El velocímetro de la Luna</span>      
    </a>
    
    <p>
      ¿Sabes a qué velocidad viaja la Luna a esta hora? ¿a qué
      distancia esta de la Tierra?.  Con este instrumento virtual
      podrás saberlo.  Los valores de la velocidad están en kilómetros
      por hora, mientras que la distancia mostrada en la pantalla esta
      en kilómetros.  Los valores se actualizan solo durante un
      minuto.  Para seguirlos viendo cambiar en tiempo real actualice
      la página (CTRL+R) o <a href="JavaScript:void(null)" onclick="location.reload()">haz click
      aquí</a>.
    </p>
  
    <center>
      <script>
	  $(document).ready(function() {
	      var svgLuna = d3.select("#speedometer-luna")
		  .append("svg:svg")
		  .attr("width",500)
		  .attr("height",400);

	      var gaugeLuna = iopctrl.arcslider()
		  .radius(200)
		  .events(false)
		  .indicator(iopctrl.defaultGaugeIndicator);

	      gaugeLuna.axis().orient("in")
		  .normalize(true)
		  .ticks(10)
		  .tickSubdivide(4)
		  .tickSize(20, 8, 10)
		  .tickPadding(5)
		  .scale(d3.scale.linear()
			 .domain([3400, 3900])
			 .range([-3*Math.PI/4, 3*Math.PI/4]));

	      var segDisplayLuna = iopctrl.segdisplay()
		  .width(200)
		  .digitCount(10)
		  .negative(false)
		  .decimals(3);

	      svgLuna.append("g")
		  .attr("class", "segdisplay")
		  .attr("transform", "translate(150, 300)")
		  .call(segDisplayLuna);

	      svgLuna.append("g")
		  .attr("class", "gauge")
		  .call(gaugeLuna);

	      DV_TIME=0;
	      FAC_TIME=1e-4;
	      getSpeed(gaugeLuna,segDisplayLuna,"MOON","EARTH",3600);
	  });
      </script>
      <div>
	Velocidad de la Luna (km/h):
	<span id="speed-MOON" class="digclock" style="text-align:center;width:10em;margin-bottom:-1em">--</span>
        <span id="speedometer-luna"></span>
	<br/>
	<div class="w3-text-grey w3-xlarge w3-center">
	  <div id="fb-root"></div>
	  $fblink_vel_luna
	  $tlink_vel_luna
	</div>
	<span class="w3-text-gray w3-large" style="font-family:courier"><a href="$link_velluna">$link_velluna</a></span>
      </div>
    </center>

    <h4>
      <a name="luna_creditos">
      <span class="w3-text-white w3-large">Créditos</span>      
      </a>
    </h4>
    
    Todas las imágenes usadas en esta página han sido elaboradas por
      el <a href="https://svs.gsfc.nasa.gov/index.html">NASA
      Scientific Visualization Studio</a> de NASA.  El autor ha
      elaborado los programas
      en <b style="font-family:courier">JavaScript</b>, <b style="font-family:courier">Python</b>
      para calcular laso condiciones actuales de la Luna y extraídos
      de los archivos del estudio las imágenes correspondientes.  Los
      cálculos astronómicos han sido realizados usando la biblioteca
      <a href="http://naif.jpl.nasa.gov/naif/">SPICE de NASA NAIF</a>
      y el wrapper para
      python <a href="http://spiceypy.readthedocs.io/en/master/" style="font-family:courier">SpiceyPy</a>.  Los códigos
      fuentes de la página pueden encontrarse en el repositorio de
      GitHub <a href="http://github.com/seap-udea/calendar"
      style="font-family:courier">Calendar</a>.

  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- ¿FIN DE AÑO? -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
CONTENT;
}if($type=="single" or $section=="finano"){ 
echo<<<CONTENT
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="finano">
    <h2 class="w3-text-light-grey">¿Fin de año?</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>
      ¿Términa realmente el año el 31 de diciembre a la media noche?.
      Esto es lo que todos asumimos cuando celebramos con alegría el
      cambio de fecha ese día.  Pero esto no siempre ha sido así y
      tampoco tendría por qué seguir siéndolo.
    </p>

    <script>
      $(document).ready(function() {
	  //DATE
	  var fecha=new Date();
	  var year=fecha.getFullYear();
	  var pyear=year-1;
	  var nyear=year+1;

	  $.ajax({
	    url:'actions.php?action=perihelia&year='+pyear,
		success:function(result){
		$('#perihelia-table').html(result);
	      }
	    });
	  
	  $.ajax({
	    url:'actions.php?action=perihelion',
		success:function(result){
		$('#perihelion-time').html(result);
		perihelionCounter('clock-ano');
	      }
	    });
	});
    </script>
  
    <div id="clock" class="w3-center flip-container" style="border:solid white 0px;text-align:center;margin:0 auto;margin-top:2em;">
      <span id="perihelion-time" class="w3-hide"></span>
      <a name="perihelio"></a>
      <span class="w3-text-grey">Tiempo para el próximo perihelio, <span class="perihelion-date"></span>:</span>
      <br><br/>
      
      <div class="clock-ano" style="border:solid white 0px;"></div>
      <div class="clock-end w3-xxlarge" style="display:none">
	<i class="fa fa-star fa-spin"></i>
	¡Feliz Perihelio 2017!
	<i class="fa fa-star fa-spin"></i>
      </div>
      
      <div class="w3-text-grey w3-xlarge w3-center">
	<div id="fb-root"></div>
	$fblink_perihelio
	$tlink_perihelio
      </div>
      <span class="w3-text-gray w3-large" style="font-family:courier"><a href="$link_perihelio">$link_perihelio</span>
    </div>

    <p>
      La definición del día de año nuevo es bastante arbitraria. Por
      casi cada cultura del planeta existe un día diferente para
      marcar el inicio del año <a href="#bib:WikiNewYear">[3]</a>.  En
      la mayoría de los casos esta fecha viene determinada por fiestas
      religiosas, asntos culturales e incluso razones políticas.
      Lamentablemente, en casi ningún caso el día del fin e inicio de
      año se basa en fenómenos astronómicos.
    </p>

    <center><img src="img/FelizAno.png" width="60%"></img></center>

    <p>
      En occidente el fin de año corresponde al último día del mes de
      diciembre (el último mes del año). Así esta definido desde los
      calendarios romanos más antiguos (de los que viene nuestro
      calendario actual) .  En la edad media (para ser exactos después
      en el año 567 e.c.<a href="bib:WikiNewYear">[3]</a>) se modifico
      la fecha del inicio del año a una de varias fechas: el 25 de
      diciembre (fecha mitíca del nacimiento de Jesús), el primero de
      marzo o el 25 de marzo (fiesta católica de la Anunciación).
      Muchos países mantuvieron esta directiva hasta bien entrado los
      1700s.  Sin embargo la instauración en 1582 del calendario
      Gregoriano (el que usamos hoy en día) reestableció en casi todos
      los países católicos el primero de enero como el día del inicio
      del año.
    </p>
    
    <p>
      Pero no hay ningún evento astronómico de relevancia que ocurra
      cada año el 31 de diciembre o el primero de enero. No hay un
      cambio de estación, el Sol no ocupa un lugar especial en el
      cielo y ni siquiera la Tierra esta en un lugar particular de su
      órbita (tampoco esta cada 31 de diciembre en el mismo lugar).
      Por la misma razón definir esta fecha como el final o el inicio
      de "año" es astronómicamente hablando arbitrario y se basa
      únicamente en tradiciones religiosas y culturales en franco
      desuso.
    </p> 

    <center><img src="img/OrbitaTierra.png"
    width="80%"></img></center>

    <p>
      Una elección más conveniente en términos físicos y astronómicos
      podría ser la de identificar sobre la órbita de la Tierra (cuyo
      movimiento periódico define justamente el año) un punto de
      caraceterísticas únicas.  Siendo la órbita de nuestro planeta
      elíptica hay dos puntos que cumplen esa condición:
      el <b>afelio</b> y el
      <b>perihelio</b>.  Ambos se producen separados por un tiempo de
      aproximadamente 6 meses, con el perihelio ocurriendo por estos
      años entre el 3 y el 4 de enero.  Si de elegir una fecha para
      una celebración basada en hechos astronómicos se tratáse, el
      Perihelio (por su cercanía temporal con el último mes del año)
      sería el evento más indicado para la fiesta de fin e inicio de
      año.
    </p>

    <p>
      Las fechas exactas de ocurrencia de los próximos 10 perihelios
      se muestran en la tabla abajo.  Allí se han indicado también la
      distancia a la que estará la Tierra en la fecha y hora del
      perihelio, así como también el tiempo transcurrido desde el
      último perihelio.
    </p>

    <center id="perihelia-table"></center>
    <p>
      Para que no se pierda ninguna celebración en lo sucesivo le
      ofrecemos aquí un contador regresivo hasta la fecha del próximo
      perihelio. 
    </p>
    
    <p>
      Para una reflexión más completa (y en un tono más informal) lea
      el
      artículo <a href="http://www.investigacionyciencia.es/blogs/astronomia/76/posts/fin-de-ao-14837"
      target="_blank">"¿Fin de Año?"</a>, entrada
      del <a href="http://www.investigacionyciencia.es/blogs/astronomia/76/posts"
      target="_blank">Blog Siderofilia</a> de
      la <a href="http://www.investigacionyciencia.es/"
      target="_blank">revista Investigación y Ciencia</a>.
    </p>

    <a name="speedometer_tierra">
      <span class="w3-text-white w3-large">El velocímetro de la Tierra</span>      
    </a>

    <p>
	¿Sabes a qué velocidad viaja la Tierra a esta hora? ¿a qué
	distancia esta del Sol?.  Con este instrumento virtual podrás
	saberlo.  Los valores de la velocidad están en kilómetros por
	segundo, mientras que la distancia mostrada en la pantalla
	esta en kilómetros.  Los valores se actualizan solo durante un
	minuto.  Para seguirlos actualizando actualice la página (CTRL+L).
    </p>

    <center>
      <script>
	  $(document).ready(function() {
	      var svg = d3.select("#speedometer")
		  .append("svg:svg")
		  .attr("width",500)
		  .attr("height",400);

	      var gauge = iopctrl.arcslider()
		  .radius(200)
		  .events(false)
		  .indicator(iopctrl.defaultGaugeIndicator);
	      gauge.axis().orient("in")
		  .normalize(true)
		  .ticks(10)
		  .tickSubdivide(4)
		  .tickSize(20, 8, 10)
		  .tickPadding(5)
		  .scale(d3.scale.linear()
			 .domain([28, 31])
			 .range([-3*Math.PI/4, 3*Math.PI/4]));

	      var segDisplay = iopctrl.segdisplay()
		  .width(300)
		  .digitCount(12)
		  .negative(false)
		  .decimals(3);

	      svg.append("g")
		  .attr("class", "segdisplay")
		  .attr("transform", "translate(100, 300)")
		  .call(segDisplay);

	      svg.append("g")
		  .attr("class", "gauge")
		  .call(gauge);

	      DV_TIME=0;
	      getSpeed(gauge,segDisplay);
	  });
      </script>
      <div>
	Velocidad de la Tierra (km/s):
	<span id="speed-EARTH" class="digclock" style="text-align:center;width:10em;margin-bottom:-1em">--</span>
        <span id="speedometer"></span>
	<br/>
	<div class="w3-text-grey w3-xlarge w3-center">
	  <div id="fb-root"></div>
	  $fblink_veltierra
	  $tlink_veltierra
	</div>
	<span class="w3-text-gray w3-large"
	style="font-family:courier"><a href="$link_veltierra">$link_veltierra</a></span>
      </div>
    </center>


  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- UBICACION -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
CONTENT;
}if($type=="single" or $section=="ubicacion"){ 
echo<<<CONTENT
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" data-type="time" id="ubicacion">
    <h2 class="w3-text-light-grey">Ubicación</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>
      ¿Dónde estas en el planeta? ¿qué sentido tiene esta pregunta
      cuando estamos hablando es del tiempo?. Una de las
      características más interesantes del tiempo es que esta ligado
      íntimamente al espacio.  El tiempo que hace depende a veces de
      forma muy complicada del lugar en el que te encuentras en la
      Tierra
    </p>
    
    <div class="w3-center">
      <h3 class="w3-large">Tu ubicación</h3>
      Latitud: <input id="latitud" type="text" size="10em" value="25" style="border:none;border-bottom:solid white 1px;background:black;color:white"/> 
      Longitud: <input id="longitud" type="text" size="10em" value="-90" style="border:none;border-bottom:solid white 1px;background:black;color:white"/> 
      <div id="status" style="padding:10px">
	<div id="loading">Cargando...</div>
	<div id="successful" style="display:none;">Localizado</div>
      </div>
      <div style="width:60vw;height:60vh;margin:auto;border:solid white 1px;text-align:center;">
	<div id="map" style="width:60vw;height:60vh;z-index:-1"></div>
      </div>
    </div>
    <script>
	function initMap() {
	    var map = new google.maps.Map(document.getElementById("map"), {
		center: {lat: 25, lng: -90},
		zoom: 4
	    });
	    var infoWindow = new google.maps.InfoWindow({map: map});
	    if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
		    var pos = {
			lat: position.coords.latitude,
			lng: position.coords.longitude
		    };
		    infoWindow.setPosition(pos);
		    infoWindow.setContent('Usted esta aquí.');
		    $("#longitud").val(Math.round10(position.coords.longitude,-5));
		    $("#latitud").val(Math.round10(position.coords.latitude,-5));
		    map.setCenter(pos);
		    map.setZoom(6);
		    $("#loading").hide();
		    $("#successful").show();
		    $("#map").css("z-index","10");
		}, function() {
		    handleLocationError(true, infoWindow, map.getCenter());
		    $("#overlay").hide();
		});
	    } else {
		handleLocationError(false, infoWindow, map.getCenter());
		$("#overlay").hide();
	    }
	    
	    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ?
				      'Error: The Geolocation service failed.' :
				      'Error: Your browser doesn\'t support geolocation.');
	    }
	}
    
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOpzHobhu8v34xNylZahKvK__a9V4KFf4&callback=initMap" async defer></script>
  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- ESTACIONES -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
CONTENT;
}if($type=="single" or $section=="estaciones"){ 
echo<<<CONTENT
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" data-type="time" id="estaciones">
    <h2 class="w3-text-light-grey">Estaciones</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>
      $MENATWORK
    </p>
  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- TIEMPO SOLAR -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
CONTENT;
}if($type=="single" or $section=="tiemposolar"){ 
echo<<<CONTENT
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" data-type="time" id="tiemposolar">
    <h2 class="w3-text-light-grey">Tiempo solar</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>
      $MENATWORK
    </p>
  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- END -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->

CONTENT;
}

echo<<<CONTENT
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- SABER MAS -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" data-type="time" id="sabermas">
    <h2 class="w3-text-light-grey">Saber más</h2>
    <hr style="width:200px" class="w3-opacity">

    <ol>

      <li><a name="bib:Treitz2013"></a><a href="http://www.investigacionyciencia.es/revistas/investigacion-y-ciencia/numero/445/historias-del-calendario-11464">Historias
      del calendario</a>, Norbert Treitz, Investigación y Ciencia,
      Octubre de 2013.</li>

      <li><a name="bib:Finkleman2011"></a><a href="http://www.investigacionyciencia.es/revistas/investigacion-y-ciencia/numero/423/el-futuro-del-tiempo-8834">El futuro del tiempo</a>, Finkleman, David Allen, Steve Seago, John H., Investigación y Ciencia, Diciembre de 2011.</li>

      <li><a name="bib:WikiNewYear"></a><a href="https://en.wikipedia.org/wiki/New_Year%27s_Day">New
      year's day</a>, Artículo de Wikipedia en Inglés.</li>

      <li><a name="bib:Zuluaga2016"></a><a href="http://www.investigacionyciencia.es/blogs/astronomia/76/posts/fin-de-ao-14837">¿Año
      Nuevo?</a>, Jorge I. Zuluaga, SciLogs de Investigación y
      Ciencia, Diciembre 29 de 2016.</li>

      <li><a name="bib:Zuluaga2017"></a><a href="http://www.investigacionyciencia.es/blogs/astronomia/76/posts/qu-hora-es-14889">¿Qué
      hora es?</a>, Jorge I. Zuluaga, SciLogs de Investigación y
      Ciencia, Enero 5 de 2017.</li>

      <li><a name="bib:NASAVIS2017"></a><a href="https://svs.gsfc.nasa.gov/index.html">NASA
      Scientific Visualization Studio</a>, NASA.</li>

      <li><a name="bib:Janetta2013"></a><a href="http://www.cosmicriver.net/blog/solar-eclipses-magnitude-and-obscuration">Solar
      eclipses: magnitude and obscuration</a>, Adrian Janetta, Agosto
      de 2013.</li>

      <li><a name="bib:Jubier2017"></a><a href="http://xjubier.free.fr/en/site_pages/solar_eclipses/TSE_2017_GoogleMapFull.html">Solar
      Eclipse Map and Conditions</a>, Xavier M. Jubier, Última visita:
      Junio 29 de 2017.</li>

    </ol>

  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- FOOTER -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge w3-center" data-type="time" id="footer">
    <center><hr style="width:80%" class="w3-opacity"/></center>
    $fblink_general
    $tlink_general
    <span class="w3-small">/ Desarrollado por Jorge I. Zuluaga <i class="fa fa-copyright"></i> 2016</span>
    <br/>
    <span class="w3-small">Su sesión $SESSID</span>
    <!-- <span style="font-family:courier,sans serif;">12:04</span>-->
  </footer>
  <!-- End footer -->

<!-- END PAGE CONTENT -->
</div>

</body>
</html>
CONTENT;
?>
