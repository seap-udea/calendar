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
    
}

?>
