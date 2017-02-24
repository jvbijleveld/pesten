<?php
require("CardDeck.php");
require("./entities/Player.php");

Class Pesten{
  
  const START_HAND = 7;
  
  private $players;
  private $deck;
  private $pile;
  private $currentPlayer;
  public $gameStart = false;
  
  function __construct(){
    $this->deck = CardDeck::getFullDeck();
    $this->pile = array();
    $this->players = array();
  }
  
  public function setupGame($nofPlayers){
    $x = 1;
    if(($nofPlayers * self::START_HAND +1) > count($this->deck)){
    	$this->log("Game could not start: too many players");
    }
    $this->log("Setting up an new game");
    while($x <= $nofPlayers){
      $player = new Player("Player ".$x, $this);
      $player->drawFirstHand(self::START_HAND);
      $this->players[] = $player;
      $x++;
    }
    $this->currentPlayer = 0;
    $this->pile[] = $this->drawCard();
  }
  
  public function playGame(){
  	$this->gameStart = true;
  	$r = 1;
  	$this->log("*********************************************");
  	$this->log("****          GAME TIME                ******");
  	$this->log("*********************************************");
    while($this->gameStart){
    	$this->players[$this->currentPlayer]->playTurn();
	    if($this->players[$this->currentPlayer]->hasWon()){
	      $this->endGame();
	    }else{
	      $this->currentPlayer++;
	      if($this->currentPlayer >= count($this->players)){
	      	$r++;
	      	$this->log("** Next Round: ". $r);
	        $this->currentPlayer = 0;
	      }
	    }
    }
  }
  
  private function endGame(){
  	$this->gameStart = false;
    $this->log($this->players[$this->currentPlayer]->getName() . " has won!");
    ob_end_flush();
  }
  
  public function topPileCard(){
    return $this->pile[count($this->pile)-1];
  }
  
  public function playCard($card){
    $this->pile[] = $card;
  }
  
  public function drawCard(){
  	if(count($this->deck) > 0){
    	$returnCard = $this->deck[count($this->deck)-1];
    	unset($this->deck[count($this->deck)-1]);
    	return $returnCard;
  	}else{
  		return null;
  	}
  }
  
  public function log($line){
  	echo $line . "<br>";
  	flush();
  	ob_flush();
  	usleep(200000);
  }
 }
?>