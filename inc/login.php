<?php
session_start();

$path = '../';
require $path. 'libs/function.php';
require_once $path.'class/login/conectAdministratorTable.php';

printf("ログイン機能実装中");

$connectAdministerTable = new ConnectAdministerTable();
$administerInfo = $connectAdministerTable->getAdministerInfoByPassWordAndEmail('test', 'test');
var_dump($administerInfo);


$_POST = checkInput($_POST);

// //固定トークンを確認（CSRF対策）
// if ( isset( $_POST[ 'ticket' ], $_SESSION[ 'ticket' ] ) ) {
//   $ticket = $_POST[ 'ticket' ];
//   if ( $ticket !== $_SESSION[ 'ticket' ] ) {
//     //トークンが一致しない場合は処理を中止
//     die( 'Access denied' );
//   }
// } else {
//   header( 'HTTP/1.1 303 See Other' );
//   header( 'location: index.php' );
//   exit;
// } 




//フォームから渡ってきた入力情報を取得
$email = $_POST['email'];
$passWord = $_POST['password'];



//データベースから登録しているユーザー情報を取得
$connectAdministerTable = new ConnectAdministerTable();
$administerInfo = $connectAdministerTable->getAdministerInfoByPassWordAndEmail($email , $passWord);
//フォームから渡ってきた入力値とデータベースに登録している値を比較

// $isUser = false;

//一致していればeditページへ
//一致していなければ前ページへ戻す
if($isUser == true) {
  $location = 'Location: ../edit/user_edit.php';
} else {
  $location = 'Location: ../index.php';
}
header($location);
exit;
?>