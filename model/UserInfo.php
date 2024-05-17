<?php
//ユーザー情報を保持するクラス
class UserInfo {
  private string $userName = "";
  private string $email    = "";
  private string $password = "";
  private array $messages = [];


 public function __construct(array $inputedValues) {  
    $this->email    = $inputedValues['email'];
    $this->password = $inputedValues['password'];
  }

  public function getEmail () : string {
    return $this->email;
  }

  public function getPassWord () : string {
    return $this->password;
  }

  public function getMessages () : array {
    return $this->messages;
  }

  public function setMessages (string $message) : void {
    $this->messages = $message;
  }
}
?>