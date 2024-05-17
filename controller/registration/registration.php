<?php
session_start();
//新規ユーザー登録に関するコントローラー
$path = '../../';
require $path. 'libs/function.php';
require $path. 'model/ValidateForInsert.php';
require '../../dao/RegistrationDAO.php';
//sessionから入力値を取得
$_POST    = checkInput($_POST);
$inputedData['email'] = $_POST['email'];
$inputedData['passWord'] = $_POST['password'];

var_dump($inputedData);
//入力値チェック
$validateForInsert = new ValidateForInsert();
//emailの形式か//8文字以上か
$errMsgs_array = $validateForInsert->validateRegistration($inputedData);

var_dump($errMsgs_array);

//エラーメッセージの数を数える。空文字はカウントしない。
$amountOfErrors = 0;
foreach ($errMsgs_array as $errMsg) {
    if (!empty($errMsg)) {
        $amountOfErrors++;
    } 
}

//問題なければregistration tableへinsert
$msg_array = [];
if ($amountOfErrors > 0) {
  //自画面遷移 エラー内容を表示
  $msg_array = $errMsgs_array;
  $_SESSION['message'] = $msg_array;
  $loactionPath = 'Location: ../../view/registration/registration.php';
} else {
  //登録処理
  //toFix:Administorクラスへ書き換える
  $registrationDAD = new RegistrationDAO();
  $result = $registrationDAD->insertEmailAndPassWord($inputedData);
  if($result) {
    $msg_array['insertedResult'] = 'ユーザー情報を登録しました。';
    $_SESSION['result'] = $msg_array['insertedResult'];
  } 
  $loactionPath = 'Location: ../../view/registration/registration.php';
}
header($loactionPath);
exit();
?>