<html>
  <head>
    pesten
  </head>
  
  <body>
    
    <p>
      start
    </p>
    
<?php
require ("controller/Pesten.php");
//use controller\Pesten;

$game = new Pesten();
$game->setupGame(4);
//$game->startGame();
    
?>
    <P>
      END
    </P>
    
  </body>
  
</html>