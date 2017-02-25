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
  	while($x < $nofCards){
  		$this->drawCard();
  		$x++;
  	}
    Log::info($this->name . " starts with hand: " . $this->printHand());
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
    Log::info($this->name . " plays " . $card->getName(). " and has ". count($this->hand). " remaining");
    $this->game->playCard($card);
  }
  
  private function drawCard(){
  	$card = $this->game->drawCard();
  	if($card != null){
    	$this->hand[] = $card;
  	
    if($this->game->gameStart){
    	Log::info($this->name . " has no suitable card, draws ".$card->getName()." from pile, and has ". count($this->hand). " remaining");
    }
    }else{
      Log::info($this->name . " has no suitable card and pile is empty, skipping a turn");
    }
  }
  
  public function printHand(){
    $ret = "";
    foreach($this->hand as $card){
      $ret .= $card->getName(). " ";
    }
    return $ret;
  }
  
  public function getName(){
    return $this->name;
  }
  
  public function toString(){
  	return $this->name . " (". count($this->hand).")";
  }
}
?>