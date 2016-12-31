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
    //Current Date
    var currentDate = new Date();

    //Manual
    //var currentDate = new Date(2016,11,31,23,59,50);
    
    // Set some date in the future. In this case, it's always Jan 1
    var futureDate=new Date(Date.UTC(2017,0,4,14,17,03));
    //var futureDate=currentDate;

    //Manual
    //var futureDate=new Date(Date.UTC(2016,11,30,19,59,00));
    
    // Calculate the difference in seconds between the future and current date
    var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;

    if(diff==0){
	$('.clock-end').show();
    }

    //Manual
    //var futureDate=new Date(Date.UTC(2017,0,4,14,17,03));
    
    //Create clock
    var clock = $('.'+target).FlipClock(diff, {
	clockFace: 'DailyCounter',
	language: 'spanish',
	countdown: true
    });

    //var perihelio=new Date(Date.UTC(2017,1,4,14,17,03));
    $('.perihelio').html(futureDate.toLocaleString());
}

////////////////////////////////////////////////////////////////////////
//ON DOCUMENT READY
////////////////////////////////////////////////////////////////////////
$(document).ready(function() {
    perihelionCounter('clock');
    perihelionCounter('clock-ano');

    $.ajax({
	url:'actions.php?action=perihelia&year=2016',
	success:function(result){
	    $('#perihelia-table').html(result);
	}
    });

});
