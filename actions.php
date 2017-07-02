<?php
////////////////////////////////////////////////////////////////////////
//EXTERNAL
////////////////////////////////////////////////////////////////////////
require_once("php/calendar.php");

////////////////////////////////////////////////////////////////////////
//ACTIONS
////////////////////////////////////////////////////////////////////////
if(isset($action)){

  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  //ECLIPSE CONDITIONS
  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  if($action=="eclipse"){
    //RUN SCRIPT
    $cmd="$PYTHON bin/eclipse.py $lat $lon $date $luzvel";
    $out=shell_exec($cmd);
    $json=preg_replace("/}/","",$out).",";
    $props=json_decode($out,true);

    //GET PROPERTIES

    //First contact
    $utc1=$props["tc1"];
    $utc1=date("U",strtotime($utc1));
    $json.='"utc1":"'.$utc1.'",';

    //Maximum
    $utcmax=$props["tcmax"];
    $utcmax=date("U",strtotime($utcmax));
    $json.='"utcmax":"'.$utcmax.'",';

    //Last contact
    $utc4=$props["tc4"];
    $utc4=date("U",strtotime($utc4));
    $json.='"utc4":"'.$utc4.'",';
    
    //RETURN
    $json=rtrim($json,",");
    $json.="}";

    echo $json;
  }		

  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  //PERIHELIA TABLE
  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  if($action=="perihelia"){
    $fper="data/$year.pp";
    if(!file_exists($fper)){
      $cmd="$PYTHON bin/perihelia-table.py $year > $fper";
      shell_exec($cmd);
    }
    $out=shell_exec("cat $fper");
    echo $out;
  }

  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  //PERIHELION DATE
  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  if($action=="perihelion"){
    $fper="data/next.p";
    $cmd="$PYTHON bin/perihelion.py > $fper";
    if(file_exists($fper)){
      $out=shell_exec("cat $fper");
      $per=date("U",strtotime($out."+000"));
      if((time()-$per)>0){
	//echo "Executing.";
	shell_exec($cmd);
      }
    }else{
      //echo "Executing.";
      shell_exec($cmd);
    }
    $out=shell_exec("cat $fper");
    echo date("U",strtotime($out."+000"));
  }

  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  //TIME
  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  if($action=="time"){
    $out=shell_exec("$PYTHON bin/time.py now 2> /tmp/a");
    echo $out;
  }

  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  //TIME
  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  if($action=="speedometer"){
    $out=shell_exec("$PYTHON bin/speedometer.py $object $center 2> /tmp/a");
    echo $out;
  }

  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  //LUNA
  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  if($action=="luna"){
    $cmd="$PYTHON bin/luna.py $modo '$fecha' 2> /tmp/luna";
    $out=shell_exec($cmd);
    echo $out;
  }

  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  //CRATERES
  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  if($action=="crateres"){
    if(preg_match("/\w/",$fecha)){$fecha="'$fecha'";}
    $cmd="$PYTHON bin/crateres.py $modo $fecha $SESSID 2> /tmp/luna";
    $out=shell_exec($cmd);
    echo $out;
  }

  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  //PHASES
  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  if($action=="phases"){
    if(preg_match("/\w/",$fecha)){$fecha="'$fecha'";}
    $cmd="$PYTHON bin/phases.py $modo $fecha $SESSID 2> /tmp/luna";
    $out=shell_exec($cmd);
    echo $out;
  }
    
}

?>
