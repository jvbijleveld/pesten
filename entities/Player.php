<?php
Class Player{
  
  private $name;
  private $hand;
  private $game;
  
  function __construct($name, $game){
    $this->name = $name;
    $this->game = $game;
    $this->hand = array();
  }
  
  public function playTurn(){
    $card = $this->getPlayableCard();
    if($card){
      $this->playCard($card);
    }else{
      $this->drawCard();
    }
    return true;
  }

  public function hasWon(){
  	if(count($this->hand)== 0){
  		return true;
  	}else{
  		return false;
  	}
  }
  
  public function drawFirstHand($nofCards){
  	$x = 0;
  	$this->game->log($this->name . " draws first hand (".$nofCards.")");
  	while($x < $nofCards){
  		$this->drawCard();
  		$x++;
  	}
  }
  
  private function getPlayableCard(){
    $pileCard = $this->game->topPileCard();
    
    foreach($this->hand as $card){
      if($pileCard->getGroup() == $card->getGroup()){
        return $card;
      }elseif($pileCard->getValue() == $card->getValue()){
        return $card;
      }
    }
    return null;
  }
  
  public function playCard($card){
  	if(($key = array_search($card, $this->hand)) !== false) {
  		unset($this->hand[$key]);
  	}
    $this->game->log($this->name . " plays card " . $card->getName(). " on pile ".$this->game->topPileCard()->getName() ."; ". count($this->hand). " remaining");
    $this->game->playCard($card);
  }
  
  private function drawCard(){
  	$card = $this->game->drawCard();
  	if($card != null){
    	$this->hand[] = $card;
  	}
    if($this->game->gameStart){
    	$this->game->log($this->name . " draws card from pile; ". count($this->hand). " remaining");
    }
  }
  
  public function setHand($hand){
    $this->hand = $hand;
  }
  
  public function setName($name){
    $this->name = $name;
  }
  
  public function getName(){
    return $this->name;
  }
  
  public function toString(){
  	return $this->name . " (". count($this->hand).")";
  }
}
?>