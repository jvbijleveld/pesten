<?php
Class Card{
  
  private $group = "";
  private $value = "";
  
  function __construct($groupName, $val){
    $this->group = $groupName;
    $this->value = $val;
  }
    
  public function getGroup(){
    return $this->group;
  }
  
  public function getName(){
    return $this->group . $this->value;
  }
  
  public function getValue(){
    return $this->value;
  }
}
?>