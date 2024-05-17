<?php
class Administrator {
  private String $administratorId = "";
  private String $email           = "";
  private string $passWord        = "";

  public function __construct(String $administratorId,
                              String $email,
                              String $passWord) {
    $this->administratorId = $administratorId;
    $this->email           = $email;
    $this->passWord         = $passWord;
  }

  public function getadministratorId () : String {
    return $this->administratorId;
  }

  public function getEmail () : String {
    return $this->email;
  }

  public function getPassWord () : String {
    return $this->passWord;
  }

  public function setEmail (String $email) : void {
    $this->email = $email;
  }

  public function setPassWord (String $passWord) : void {
    $this->passWord = $passWord;
  }
}
?>