<?php
//namespace controller\Pesten;

require("CardDeck.php");

Class Pesten{
  
  const START_HAND = 7;
  
  private $players;
  private $deck;
  private $pile;
  private $currentPlayer;
  
  function __construct(){
    print "CardDeck::construct<br>";
    //$cd = new CardDeck();
    //$cd->getFullDeck();
    $deck = CardDeck::getFullDeck();
    print "deck loaded<br>";
  }
  
  public function setupGame($nofPlayers){
    $x = 0;
    
    while($x < $nofPlayers){
      $player = new Player("Player ".$x);
      $this->drawFirstHand($player);
      $players[] = $player;
      $x++;
    }
    
    $currentPlayer = 0;
    print_r($deck);
  }
  
  public function playGame(){
    
    $players[$currentPlayer].playTurn();
    if($players[$currentPlayer].hasWon()){
      $this->endGame();
    }else{
      $currentPlayer++;
      
      if($currentPlayer > count($players)){
        $currentPlayer = 0;
      }
    }
  }
  
  private function endGame(){
    log($players[$currentPlayer].getName . " has won!");
  }
  
  private function drawFirstHand($player){
    $x =0;
    
    while($x < self::START_HAND){
      $player->drawCard();
      $x++
    }
  }
  
  static public function topPileCard(){
    return $pile[count($pile)-1];
  }
  
  public function playCard($card){
    $pile[] = $card;
  }
  
  public function drawCard(){
    $returnCard = $deck[count($deck)-1];
    unset($deck[$returnCard]);
    return $returnCard;
  }
  
  public function log($line){
    echo $line;
  }
  
 }

?>