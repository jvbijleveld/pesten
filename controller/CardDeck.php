<?php
require("./entities/Card.php");

Class CardDeck{
   
  static public function getFullDeck(){
    print "CardDeck::getFullDeck<br>";
    
    $groups = array("hearts", "diamonds", "clubs", "spades");
    $values = array(1,2,3,4,5,6,7,8,9,"J","Q", "K", "A");
    $cards = array();
    
    foreach($groups as $group){
      
      foreach($values as $value){
        $cards[] = new Card($group, $value);
      }
    }
   	shuffle($cards);
   	return $cards;
  }
}
?>