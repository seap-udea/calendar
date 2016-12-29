<?php
   $timezone=date_default_timezone_get();
   $img=urlencode("http://astronomia-udea.co/calendar/img/FelizAno-square.png");
?>

<!DOCTYPE html>
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
  <!--
      Font awesome: ttp://fontawesome.io/icons/
  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/calendar.css">

  <link rel="stylesheet" href="js/flipclock/flipclock.large.css">
  <link rel="stylesheet" media="screen and (max-width:800px)" href="js/flipclock/flipclock.small.css">

  <script src="js/jquery.js"></script>
  <script src="js/flipclock/flipclock.js"></script>	

  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-89567672-1', 'auto');
  ga('send', 'pageview');
  </script>

</head>

<body class="w3-black">
<!--<img src="img/FelizAno.png" style="display:block"></img>-->
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- ICON BAR (LARGE AND MEDIUM SCREENS) -->
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- Icon Bar (Sidenav - hidden on small screens) -->
<nav class="w3-sidenav w3-center w3-small w3-hide-small">
  <!-- Avatar image in top left corner -->
  <img src="img/LogoSimbolo.png" width="100%">
  <a class="w3-padding-large w3-black" href="#">
    <i class="fa fa-home w3-xxlarge"></i>
    <p>INICIO</p>
  </a>
  <a class="w3-padding-large w3-hover-black" href="#perihelio">
    <i class="fa fa-circle-o-notch fa-spin w3-xxlarge"></i>
    <p>PERIHELIO</p>
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

    <h1 class="w3-jumbo w3-hide-small">Astrotiempo</h1>
    <h3 class="w3-xxlarge w3-hide-medium w3-hide-large">Astrotiempo</h3>

    <h4 class="w3-hide-small">Significados astronómicos para nuestra medida cotidiana del tiempo.</h4>
    <h6 class="w3-hide-medium w3-hide-large">Significados astronómicos para nuestra medida cotidiana del tiempo.</h6>

  </header>

  <div id="clock" class="w3-center flip-container" style="border:solid white 0px;text-align:center;margin:0 auto;margin-top:2em;">
    <span class="w3-text-grey">Tiempo para el próximo perihelio, <span class="perihelio"></span>:</span>
    <br><br/>
    <div class="clock" style="border:solid white 0px;"></div>
    <div class="w3-text-grey w3-xlarge w3-center">
      <div id="fb-root"></div>
      <a href="JavaScript:window.open('https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fastronomia-udea.co%2Fcalendar&amp;src=sdkpreparse&p[images][0]=<?php echo $img?>','Facebook','width=500,height=300')"><i class="fa fa-facebook-official w3-hover-text-indigo"></i></a>
      <a href="JavaScript:window.open('https://twitter.com/intent/tweet?text=¿Cuántos días faltan para el próximo perihelio (el fin de año astronómico)?&via=zuluagajorge&url=http://astronomia-udea.co/calendar','Tweet','width=500,height=300')"><i class="fa fa-twitter w3-hover-text-light-blue"></i></a>
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
  <!-- PERIHELIO -->
  <!-- ----------------------------------------------------------------------------------------------------------------- -->
  <!-- About Section -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-32" id="perihelio">
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

    <script type="text/javascript">

      (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8";
      fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));

      $(document).ready(function() {

	  // Grab the current date
	  var currentDate = new Date();
	  
	  // Set some date in the future. In this case, it's always Jan 1
	  var futureDate  = new Date(2017,0,4,9,30,0);
	  
	  // Calculate the difference in seconds between the future and current date
	  var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;
	  
	  // Instantiate a coutdown FlipClock
	  clock = $('.clock').FlipClock(diff, {
	      clockFace: 'DailyCounter',
	      language: 'spanish',
	      countdown: true
	  });

	  var perihelio=new Date('2017-01-04 14:17:03 UTC');
	  $('.perihelio').html(perihelio.toLocaleString());

      });
    </script>
  </div>

  <div class="w3-center">
    <img src="img/man-at-work.png" width="20%"></img>
  </div>
  
  <!-- Footer -->
  <footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge w3-center" id="footer">
    <i class="fa fa-facebook-official w3-hover-text-indigo"></i>
    <i class="fa fa-instagram w3-hover-text-purple"></i>
    <i class="fa fa-snapchat w3-hover-text-yellow"></i>
    <i class="fa fa-pinterest-p w3-hover-text-red"></i>
    <i class="fa fa-twitter w3-hover-text-light-blue"></i>
    <i class="fa fa-linkedin w3-hover-text-indigo"></i>
  </footer>
  <!-- End footer -->

<!-- END PAGE CONTENT -->
</div>

</body>
</html>
