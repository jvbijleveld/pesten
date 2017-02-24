<?php
//namespace controller\CardDeck;

//require("/pesten/entities/Card.php");

Class CardDeck{
  
  private $cards;
  private $groups = array("hearts", "diamonds", "clubs", "spades");
  private $values = array(1,2,3,4,5,6,7,8,9,"J","Q", "K", "A");
  
  public function getFullDeck(){
    print "CardDeck::getFullDeck<br>";
    $cards = array();
    
    print_r($groups);
    foreach($groups as $group){
      
      foreach($values as $value){
        print "card: " . $group . $value;
        $cards[] = new Card($group, $value);
      }
    }
    return $cards;
  }
  
  static function shuffle($deck){
    shuffle($deck);
  }
}

?>