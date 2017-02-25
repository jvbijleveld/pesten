<?php
require("Card.php");

Class CardDeck{
   
  static public function getFullDeck(){
    
    $groups = array("&hearts;", "&diams;", "&clubs;", "&spades;");
    $values = array(1,2,3,4,5,6,7,8,9,"J","Q","K","A");
    $cards = array();
    
    foreach($groups as $group){
      
      foreach($values as $value){
        $cards[] = new Card($group, $value);
      }
    }
   	return $cards;
  }
}
?>