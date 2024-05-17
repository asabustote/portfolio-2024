<?php
require_once '../model/UserInfo.php';
//ログイン時に登録しているユーザーのメールアドレスとパスワードが一致するか確認するクラス
class UserAuthentication {

  private string $emailPattern =   '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/uiD';
  private string $passWordPattern = '/^[0-9a-zA-Z]{8,}$/';

  public function checkInputs (UserInfo $userInfo) : bool {
    $result = false;
    if ($this->checkEmail   ($userInfo->getEmail()) &&
        $this->checkPassWord($userInfo->getPassWord())) {
        $result = true;
    }
    return $result;
  }

  private function checkEmail (string $inputedEmail) : bool  {
    $result = false;

    if (preg_match($this->emailPattern, $inputedEmail)) {
        $result = true;
    } else if (" " == $inputedEmail) {
        $result = false;
    } else {
        $result = false;
    }
    return $result;
  }

  private function checkPassWord (string $inputedPassWord) : bool {
    $result = false;

    if (preg_match($this->passWordPattern, $inputedPassWord)) {
      $result = true;
    }

    return $result;
  }
}
?>