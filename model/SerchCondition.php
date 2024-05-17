<?php
Class SerchCodition {
  private $userName   = "";
  private $phoneNumber = "";

  public function __construct(String $userName, String $phoneNumber) {
    $this->userName = $userName;
    $this->phoneNumber = $phoneNumber;
  }

  public function getUserName() : string {
    return $this->userName;
  }

  public function getPhoneNumber() : string {
    return $this->phoneNumber;
  }

  public function setUserName(String $userName) {
    $this->userName = $userName;
  }
  
  public function setPhoneNumber(String $phoneNumber) {
    $this->phoneNumber = $phoneNumber;
  }
  
} 
?>