<?php
namespace Entities\Card;

Class Card{
  
  private $group;
  private $value;
  
  function __contsruct($group, $val){
    $this->group = $group;
    $this->value = $val;
  }
    
  public getGroup(){
    return $this->group;
  }
  
  public function getName(){
    return $this->getGroup() . $this->getValue();
  }
  
  public getValue(){
    return $this->value;
  }
  
}
?>