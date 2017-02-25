<?php
require("./entities/CardDeck.php");
require("./entities/Log.php");
require("Player.php");

Class Game{
  
  const START_HAND = 7;
  
  private $players;
  private $deck;
  private $pile;
  private $currentPlayer;
  private $round;
  public $gameStart = false;
  
  function __construct(){
    $this->deck = CardDeck::getFullDeck();
    shuffle($this->deck);
    $this->pile = array();
    $this->players = array();
  }
  
  public function setupGame($players){
    if((count($players) * self::START_HAND +1) > count($this->deck)){
    	Log::info("Game could not start: too many players");
      return;
    }
    $this->log("Setting up an new game");
    foreach($players as $name){
      $player = new Player($name, $this);
      $player->drawFirstHand(self::START_HAND);
      $this->players[] = $player;
    }
    $this->currentPlayer = 0;
    $this->pile[] = $this->drawCard();
  }
  
  public function playGame(){
    if($this->topPileCard() != null){
			$this->gameStart = true;
			$this->round = 1;
			Log::info("*** Game starts with ". $this->topPileCard()->getName());
			while($this->gameStart){
				$this->players[$this->currentPlayer]->playTurn();
				if($this->players[$this->currentPlayer]->hasWon()){
					$this->endGame();
				}else{
					$this->currentPlayer++;
					if($this->currentPlayer >= count($this->players)){
						$this->round++;
						Log::info("** Next Round: ". $this->round);
						$this->currentPlayer = 0;
					}
				}
			}
    }
  }
  
  private function endGame(){
  	$this->gameStart = false;
    Log::info($this->players[$this->currentPlayer]->getName() . " has won in ". $this->round . " rounds!");
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
}
?>