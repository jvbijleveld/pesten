<?php

Class Log{
  
  static public function info($line){
    echo $line . "<br>";
  	flush();
  	ob_flush();
  	usleep(100000);
  } 
}

?>