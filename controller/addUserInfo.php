<?php
session_start();
require '../dao/UserInfoDAO.php';
require '../model/ValidateForInsert.php';

//postの値を変数に入れる
$userInfos['name']   = $_POST['name'];
$userInfos['kana']   = $_POST['kana'];
$userInfos['email']  = $_POST['email'];
$userInfos['tel']    = $_POST['tel'];
$userInfos['inquiry'] = $_POST['inquiry'];

//入力値のチェック
$ValidateForInsert = new ValidateForInsert();
$errMsgs_array  = $ValidateForInsert->validateInputedData($userInfos);

//エラーメッセージの数を数える。空文字はカウントしない。
$amountOfErrors = 0;
foreach ($errMsgs_array as $errMsg) {
    if (!empty($errMsg)) {
        $amountOfErrors++;
    } 
}

if ($amountOfErrors > 0) {
  //自画面遷移 エラー内容を表示
  $msg_array = $errMsgs_array;
  $_SESSION['userInfos'] = $userInfos;
  $loactionPath = 'Location: ../view/edit/addUserInfo.php';
} else {
  //登録処理
  $userInfoDAO = new UserInfoDAO();
  $userInfoDAO->insertToDB($userInfos);
  $userInfoDAO->serchUserInfo();
  $msg_array = 'ユーザー情報を登録しました。';
  $loactionPath = 'Location: ../view/edit/serchUserInfo.php';
}
//処理結果を$messageへ追加
$_SESSION['message'] = $msg_array;

header($loactionPath);
exit();
?>