<?php
require '../../dao/AdministratorDAO.php';
require '../../model/Administrator.php';
session_start();
//formからの値を取得
//emailとpassword
$email   = $_SESSION['email'];
$passWord = $_SESSION['password'];

//Administratorテーブルにある全ての管理者情報の取得
$administorDAO = new AdministratorDAO();
$administors = $administorDAO->getAllAdministors();

//入力された値とAdministratorテーブルにある全ユーザを検証
$result = false;
for ($i = 0; $i < count($administors); $i++) {
  $administor = $administors[$i];
  if ($administor->getEmail()     === $email &&
      $administor->getPassWord()  === $passWord) {
        $result = true;
        $_SESSION['administor'] = $administor;
        break;
  } else if ($administor->getEmail()    !== $email &&
             $administor->getPassWord() === $passWord) {
        $result = false;
        $_SESSION['msg'] = 'メールアドレスが不一致です。';
        break;
  } else if ($administor->getEmail()    === $email &&
             $administor->getPassWord() !== $passWord) {
        $result = false;
        $_SESSION['msg'] = "パスワードが不一致です。";
        break;
  } else if ($administor->getEmail()    !== $email &&
             $administor->getPassWord() !== $passWord) {
    $_SESSION['msg'] = 'メールアドレスとパスワーとが不一致です。';
  }
}

//一致するユーザがいれば、一致したユーザとしてログイン（管理者画面へ）
if ($result) {
  $loactionPath = 'Location: ../../view/edit/serchUserInfo.php';
} else {
  $_SESSION['email']    = $email;
  $_SESSION['password'] = $passWord;
  $loactionPath = 'Location: ../../index.php';
}

//一致するユーザがいなければ元のページに戻しエラーメッセジを表示
header($loactionPath);
exit();
?>