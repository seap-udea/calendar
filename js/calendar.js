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

////////////////////////////////////////////////////////////////////////
//ON DOCUMENT READY
////////////////////////////////////////////////////////////////////////
$(document).ready(function() {

    //DATE
    var fecha=new Date();
    var year=fecha.getFullYear();
    var pyear=year-1;
    var nyear=year+1;

    //GET PERIHELIA LIST
    /*
    $.ajax({
	url:'actions.php?action=perihelia&year='+pyear,
	success:function(result){
	    $('#perihelia-table').html(result);
	}
    });

    //GET YEAR PERIHELION DATE
    $.ajax({
	url:'actions.php?action=perihelion&year='+nyear,
	success:function(result){
	    $('#perihelion-time').html(result);
	    perihelionCounter('clock');
	    perihelionCounter('clock-ano');
	}
    });
    */

    //UPDATE TIME
    fecha.getHours();
});
