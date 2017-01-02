	      if(navigator.geolocation){
		  navigator.geolocation.getCurrentPosition(function(p){
		      alert("Geolocation");
		      /*
		      $('#lat').value(p.coords.latitude);
		      $('#lon').value(p.coords.longitude);
		      */
		  },function(){});
	      }else{
		  alert("No geolocation");
	      }
