<?php
header( 'Content-type: text/html; charset=utf-8' );

require ("./controller/Game.php");

$pesten = new Game();
$pesten->setupGame(array("Moe","Apu","Homer","Barney")); // 4 players
$pesten->playGame();
    
?>
