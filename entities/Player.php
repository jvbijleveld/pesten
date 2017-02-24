<?php
namespace Entities\Player;

Class Player{
  
  private $name;
  private $hand;
  private $game;
  
  function __construct($name){
    $this->name = $name;
  }
  
  public playTurn(){
    
    $card = $this->getPlayableCard();
    
    if($card){
      $this->playCard($card);
    }else{
      $this->drawCard();
    }
  }

  public function hasWon(){
    return count($this->hand) == 0;
  }
  
  private getPlayableCard(){
    $pileCard = $game::topPileCard();
    
    foreach($hand as $card){
      if($pileCard->getGroup() == $card->getGroup()){
        return $card;
      }elseif($pileCard->getValue() == $card->getValue()){
        return $card
      }
    }
    return null;
  }
  
  public playCard($card){
    unset($hand[$card]);
    $this->game->playCard($card);
    $this->game->log($this->name . " plays card " . $card.getName(). "; ". count($this->hand). " remaining");
    
  }
  
  private drawCard(){
    $this->hand[] = $this->game->drawCard();
    $this->game->log($this->name . " draws card from pile");
  }
  
  public setHand($hand){
    $this->hand = $hand;
  }
  
  public setName($name){
    $this->name = $name;
  }
  
  public getName(){
    return $this->name;
  }
}

?>