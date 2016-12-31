<!DOCTYPE html>

<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- PHP CODE -->
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<?php
   require_once("php/calendar.php");
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
<nav class="w3-sidenav w3-center w3-small w3-hide-small" style="width:12%">
  <!-- Avatar image in top left corner -->
  <img src="img/LogoSimbolo.png" width="80%">

  <a class="w3-padding-large w3-black" href="#">
    <i class="fa fa-home w3-xxlarge"></i>
    <p>INICIO</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="#finano">
    <i class="fa fa-circle-o-notch fa-spin w3-xxlarge"></i>
    <p>¿FIN DE AÑO?</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="#estaciones">
    <i class="fa fa-snowflake-o fa-spin w3-xxlarge"></i>
    <p>ESTACIONES</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="#quehoraes">
    <i class="fa fa-clock-o w3-xxlarge"></i>
    <p>¿QUÉ HORA ES?</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="#tiemposolar">
    <i class="fa fa-sun-o fa-spin w3-xxlarge"></i>
    <p>TIEMPO SOLAR</p>
  </a>

  <a class="w3-padding-large w3-hover-black" href="#faseslunares">
    <i class="fa fa-moon-o w3-xxlarge"></i>
    <p>FASES LUNARES</p>
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
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <ul class="w3-navbar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
    <li class="w3-left" style="width:25% !important"><a href="#">INICIO</a></li>
    <li class="w3-left" style="width:25% !important"><a href="#perihelio">PERIHELIO</a></li>
    <li class="w3-left" style="width:25% !important"><a href="#contact">CONTACTO</a></li>
  </ul>
</div>

<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- PAGE CONTENT -->
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<div class="w3-padding-large" id="main">

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- HEADER -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <header class="w3-container w3-padding-16 w3-center w3-black" id="home">

    <!--<h1 class="w3-jumbo w3-hide-small">Astrotiempo</h1>
    <h3 class="w3-xxlarge w3-hide-medium w3-hide-large">Astrotiempo</h3>-->
    <img src="img/AstroTiempoLogo.png" width="40%"/>

    <h4 class="w3-hide-small">Significados astronómicos para nuestra medida cotidiana del tiempo.</h4>
    <h6 class="w3-hide-medium w3-hide-large">Significados astronómicos para nuestra medida cotidiana del tiempo.</h6>

  </header>

  <div id="clock" class="w3-center flip-container" style="border:solid white 0px;text-align:center;margin:0 auto;margin-top:2em;">
    <span class="w3-text-grey">Tiempo para el próximo perihelio, <span class="perihelio"></span>:</span>
    <br><br/>
    <div class="clock" style="border:solid white 0px;"></div>
    <div class="w3-text-grey w3-xlarge w3-center">
      <div id="fb-root"></div>
      <?php echo facebookLink("http://astronomia-udea.co/calendar") ?>
      <?php echo twitterLink("http://astronomia-udea.co/calendar","¿Cuántos días faltan para el próximo perihelio (el fin de año astronómico)?","zuluagajorge") ?>
    </div>
  </div>

  <!-- -----------------------------------------------------------------------------------------------------------------
  -->
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
      <!--Pregrado Astronomía de la Universidad de Antioquia-->
    </p>

  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- ¿FIN DE AÑO? -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- About Section -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="finano">
    <h2 class="w3-text-light-grey">¿Fin de año?</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>
      Lea el artículo completo en: <a href="http://www.investigacionyciencia.es/blogs/astronomia/76/posts/fin-de-ao-14837" target="_blank">"¿Fin de Año?"</a>,
	entrada
	del <a href="http://www.investigacionyciencia.es/blogs/astronomia/76/posts" target="_blank">Blog
	Siderofilia</a> de
	la <a href="http://www.investigacionyciencia.es/" target="_blank">revista
	Investigación y Ciencia</a>.
    </p>
    <center><img src="img/FelizAno.png"></img></center>
  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- ESTACIONES -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="estaciones">
    <h2 class="w3-text-light-grey">Estaciones</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>
      <?php echo $MENATWORK ?>
    </p>
  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- ¿QUÉ HORA ES? -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="quehoraes">
    <h2 class="w3-text-light-grey">¿Qué hora es?</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>
      <?php echo $MENATWORK ?>
    </p>
  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- TIEMPO SOLAR -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="tiemposolar">
    <h2 class="w3-text-light-grey">Tiempo solar</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>
      <?php echo $MENATWORK ?>
    </p>
  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- FASES LUNARES -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="faseslunares">
    <h2 class="w3-text-light-grey">Fases lunares</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>
      <?php echo $MENATWORK ?>
    </p>
  </div>

  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- FOOTER -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge w3-center" id="footer">
    <center><hr style="width:80%" class="w3-opacity"/></center>
    <?php echo facebookLink("http://astronomia-udea.co/calendar") ?>
    <?php echo twitterLink("http://astronomia-udea.co/calendar","Astrotiempo: significados astronómicos para nuestra medida cotidiana del tiempo.","zuluagajorge") ?>
    <span class="w3-small">/ Desarrollado por Jorge I. Zuluaga <i class="fa fa-copyright"></i> 2016</span>
  </footer>
  <!-- End footer -->

<!-- END PAGE CONTENT -->
</div>

</body>
</html>
