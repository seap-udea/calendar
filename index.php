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
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Play:700,400" type="text/css">
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
      Tu longitud geográfica: <input data-type="time" id="lon" type="text" name="lat"
				     value="-75.3" class="coordinput" onchange="getTimes(0)">
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
      </script>

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
			 .domain([3500, 4000])
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
