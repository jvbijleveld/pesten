<?php
header( 'Content-type: text/html; charset=utf-8' );

require ("controller/Pesten.php");

$game = new Pesten();
$game->setupGame(4); // 4 players
$game->playGame();
    
?>
