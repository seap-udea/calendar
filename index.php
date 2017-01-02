<!DOCTYPE html>

<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- PHP CODE -->
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<?php
   require_once("php/calendar.php");
   if(!isset($type)){$type="single";}
?>

<html>
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- HEADER -->
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<head>
  <title>Astrotiempo</title>

  <meta property="og:image" content="http://astronomia-udea.co/calendar/img/FelizAno-square.png"/>
  <link rel="image_src" href="img/FelizAno-square.png"/>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

  <!-- Font awesome: http://fontawesome.io/icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/calendar.css">

  <link rel="stylesheet" href="js/flipclock/flipclock.large.css">
  <link rel="stylesheet" media="screen and (max-width:800px)" href="js/flipclock/flipclock.small.css">

  <script src="js/jquery.js"></script>
  <script src="js/flipclock/flipclock.js"></script>	
  <script src="js/calendar.js"></script>	

</head>

<body class="w3-black">

<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- ICON BAR (LARGE AND MEDIUM SCREENS) -->
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- Icon Bar (Sidenav - hidden on small screens) -->
<nav class="w3-sidenav w3-center w3-small w3-hide-small" style="width:120px">

  <a href="?"><img class="w3-hide-small" src="img/LogoSimbolo.png" width="80%"></a>
  
  <a class="w3-padding-large w3-black" href="<?php echo ilink('home',$type)?>">
    <i class="fa fa-home w3-xxlarge"></i>
    <p>INICIO</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="<?php echo ilink('finano',$type)?>">
    <i class="fa fa-circle-o-notch fa-spin w3-xxlarge"></i>
    <p>¿FIN DE AÑO?</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="<?php echo ilink('quehoraes',$type)?>">
    <i class="fa fa-clock-o w3-xxlarge"></i>
    <p>¿QUÉ HORA ES?</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="<?php echo ilink('estaciones',$type)?>">
    <i class="fa fa-snowflake-o fa-spin w3-xxlarge"></i>
    <p>ESTACIONES</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="<?php echo ilink('tiemposolar',$type)?>">
    <i class="fa fa-sun-o fa-spin w3-xxlarge"></i>
    <p>TIEMPO SOLAR</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="<?php echo ilink('faseslunares',$type)?>">
    <i class="fa fa-moon-o w3-xxlarge"></i>
    <p>FASES LUNARES</p>
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

<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- ICON BAR (SMALL SCREENS) -->
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- Navbar on small screens (Hidden on medium and large screens) -->
<!--
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <ul class="w3-navbar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
    <li class="w3-left" style="width:25% !important"><a href="#">INICIO</a></li>
    <li class="w3-left" style="width:25% !important"><a href="#finano">¿FIN DE AÑO?</a></li>
  </ul>
</div>
-->

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
  $fblink=facebookLink("http://astronomia-udea.co/calendar");
  $tlink=twitterLink("http://astronomia-udea.co/calendar","¿Cuántos días faltan para el próximo perihelio (el fin de año astronómico)?","zuluagajorge");

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
      $fblink
      $tlink
    </div>
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
  <!-- ¿FIN DE AÑO? -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
CONTENT;
}if($type=="single" or $section=="finano"){ 
  $fblink=facebookLink("http://astronomia-udea.co/calendar");
  $tlink=twitterLink("http://astronomia-udea.co/calendar","¿Cuántos días faltan para el próximo perihelio (el fin de año astronómico)?","zuluagajorge");
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

    <center><img src="img/FelizAno.png" width="60%"></img></center>

    <p>
      La definición del día de año nuevo es bastante arbitraria. Por
      casi cada cultura del planeta existe un día diferente para
      marcar el inicio del año <a href="#bib:WikiNewYear">[3]</a>.  En
      la mayoría de los casos esta fecha viene determinada por fiestas
      religiosas, asntos culturales e incluso razones políticas.
      Lamentablemente, en casi ningún caso el día del fin e inicio de
      año se basa en fenómenos astronómicos.
    </p>

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
	$fblink
	$tlink
      </div>
    </div>

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
  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- ¿QUÉ HORA ES? -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
CONTENT;
}if($type=="single" or $section=="quehoraes"){ 
$buttons=<<<B
	<tr>
	  <td colspan=3 class="w3-xxlarge w3-center">
	    <a id="play" href="JavaScript:void(0)" onclick="$('#play').hide();UPDATE=1;getTimes()" style="display:none;"><i class="fa fa-play w3-hover-text-red"></i></a>
	    <a href="JavaScript:void(0)" onclick="$('#play').show();UPDATE=1;clearTimeout(TIMEOUT)"><i class="fa fa-pause w3-hover-text-red"></i></a>
	    <a href="JavaScript:void(0)" onclick="UPDATE=1;updateTime(0)"><i class="fa fa-step-forward w3-hover-text-red"></i></a>
	    <a href="JavaScript:void(0)" onclick="UPDATE=1;getTimes(0)"><i class="fa fa-repeat w3-hover-text-red"></i></a>
	  </td>
	</tr>
B;

echo<<<CONTENT
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="quehoraes">
    <h2 class="w3-text-light-grey">¿Qué hora es?</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>
      ¿Sabe usted a ciencia cierta qué hora es?
    </p>

    Algunas de las horas dependen de la longitud geográfica en la que
    te encuentras.  Si sabes tu longitud precisa indicala a
    continuación (con solo cambiarla se actualizaran las horas abajo),
    tu longitud geográfica: <input id="lon" type="text" name="lat"
    value="-75.3" class="coordinput" onchange="getTimes(0)">

    <center>
      <script>
	  $(document).ready(function() {
	      var lon=TZ*15.0;
	      $("#lon").val(lon);
	      getTimes();
	  });
      </script>

      <div id="DT_plain" class="w3-hide"></div>
      <div id="ET_plain" class="w3-hide"></div>

      <table class="time-table" width="80%">

	<tr>
	  <td style="width:10%"></td>
	  <td style="width:35%"></td>
	  <td class="w3-hide-small"></td>
	</tr>
	
	$buttons

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:LMT">LMT</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div id="LMT_plain" class="w3-hide"></div>
	    <div id="LMT" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:LMT">Tiempo en el meridiano local</a>, tiempo que marcan los
	    relojes en el huso horario.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:LMST">LMST</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div id="LMST_plain" class="w3-hide"></div>
	    <div id="LMST" class="digclock" style="text-align:center">
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
	    <a href="#hora:UTC">UTC</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div id="UTC_plain" class="w3-hide"></div>
	    <div id="UTC" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:UTC">Tiempo atómico Universal</a>, tiempo
	    universal coordinado o tiempo local en Greenwich.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:TAI">TAI</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div id="TAI_plain" class="w3-hide"></div>
	    <div id="TAI" class="digclock" style="text-align:center">
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
	    <a href="#hora:TDB">TDB</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div id="TDB_plain" class="w3-hide"></div>
	    <div id="TDB" class="digclock" style="text-align:center">
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
	    <a href="#hora:TDT">TDT</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div id="TDT_plain" class="w3-hide"></div>
	    <div id="TDT" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:TDT">Tiempo Dinámico Terrestre</a>.  Tiempo atómico en el centro de la Tierra.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:GST">GST</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div id="GST_plain" class="w3-hide"></div>
	    <div id="GST" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:GST">Tiempo sideral en Greenwich</a>,
	    ascensión recta de los cuerpos que están culminando en
	    Greenwich.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name">
	    <a href="#hora:LST">LST</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div id="LST_plain" class="w3-hide"></div>
	    <div id="LST" class="digclock" style="text-align:center">
	      --<span class="blink_me">:</span>--<span class="blink_me">:</span>--<span class="w3-small">.---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:LST">Tiempo sideral local</a>, ascensión
	    recta de los cuerpos que están culminando en Greenwich.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name" valign="top">
	    <a href="#hora:UNIX">UNIX</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div id="UNIX_plain" class="w3-hide"></div>
	    <div id="UNIX_int" style="font-family:courier;color:red">- ---'</div>
	    <div id="UNIX_fra" class="digclock" style="text-align:center">
	      ------.<span class="w3-small">---</span>
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:UNIX">Tiempo de UNIX</a>. Número de segundos
	    transcurridos desde Enero 1 de 1970.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name" valign="top">
	    <a href="#hora:JD">JD</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div id="JD_plain" class="w3-hide"></div>
	    <div id="JD_int" style="font-family:courier;color:red">-------.</div>
	    <div id="JD_fra" class="digclock" style="text-align:center">
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
	    <a href="#hora:JDB">JDB</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div id="JDB_plain" class="w3-hide"></div>
	    <div id="JDB_int" style="font-family:courier;color:red">-------.</div>
	    <div id="JDB_fra" class="digclock" style="text-align:center">
	      ---------
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:LST">Día juliano referido al baricentro</a>,
	    días transcurridos desde Enero 1 de 4713 a.e.c referidos al
	    baricentro del Sistema Solar.
	  </td>
	</tr>

	<tr>
	  <td  class="time-table time-table-name" valign="top">
	    <a href="#hora:JDT">JDT</a>
	  </td>
	  <td class="time-table time-table-clock">
	    <div id="JDT_plain" class="w3-hide"></div>
	    <div id="JDT_int" style="font-family:courier;color:red">-------.</div>
	    <div id="JDT_fra" class="digclock" style="text-align:center">
	      ---------
	    </div>
	  </td>
	  <td class="time-table time-table-explanation w3-hide-small w3-hide-medium">
	    <a href="#hora:LST">Día juliano referido al centro de la Tierra</a>, días
	    transcurridos desde Enero 1 de 4713 a.e.c referidos al centro de la Tierra.
	  </td>
	</tr>

	$buttons

      </table>
    </center>
  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- ESTACIONES -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
CONTENT;
}if($type=="single" or $section=="estaciones"){ 
echo<<<CONTENT
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="estaciones">
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
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="tiemposolar">
    <h2 class="w3-text-light-grey">Tiempo solar</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>
      $MENATWORK
    </p>
  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- FASES LUNARES -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
CONTENT;
}if($type=="single" or $section=="faseslunares"){ 
echo<<<CONTENT
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="faseslunares">
    <h2 class="w3-text-light-grey">Fases lunares</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>
      $MENATWORK
    </p>
  </div>

CONTENT;
}

  $fblink=facebookLink("http://astronomia-udea.co/calendar");
  $tlink=twitterLink("http://astronomia-udea.co/calendar","Astrotiempo: significados astronómicos para nuestra medida cotidiana del tiempo.","zuluagajorge");

echo<<<CONTENT
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- SABER MAS -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="sabermas">
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

    </ol>

  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- FOOTER -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge w3-center" id="footer">
    <center><hr style="width:80%" class="w3-opacity"/></center>
    $fblink
    $tlink
    <span class="w3-small">/ Desarrollado por Jorge I. Zuluaga <i class="fa fa-copyright"></i> 2016</span>
    <!-- <span style="font-family:courier,sans serif;">12:04</span>-->
  </footer>
  <!-- End footer -->

<!-- END PAGE CONTENT -->
</div>

</body>
</html>
CONTENT;
?>
