<?php
//エスケープ処理を行う関数
function h($var) {
  if(is_array($var)){
    //$varが配列の場合、h()関数をそれぞれの要素について呼び出す（再帰）
    return array_map('h', $var);
  } else if (!is_null($var)) {
    return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
  }
}
 
//入力値に不正なデータがないかなどをチェックする関数
function checkInput($var){
  if(is_array($var)){
    return array_map('checkInput', $var);
  }else{
    //NULLバイト攻撃対策
    if(preg_match('/\0/', $var)){  
      die('不正な入力です。');
    }
    //文字エンコードのチェック
    if(!mb_check_encoding($var, 'UTF-8')){ 
      die('不正な入力です。');
    }
    //改行、タブ以外の制御文字のチェック
    if(preg_match('/\A[\r\n\t[:^cntrl:]]*\z/u', $var) === 0){  
      die('不正な入力です。制御文字は使用できません。');
    }
    return $var;
  }
}

function dataValidate($userInfo) {
  if ( $userInfo['name'] == '' ) {
    $error[ 'name' ] = '*お名前は必須項目です。';
    //制御文字でないことと文字数をチェック
  } else if ( preg_match( '/\A[[:^cntrl:]]{1,10}\z/u', $userInfo['name'] ) == 0 ) {
    $error[ 'name' ] = 'お名前は10文字以内でお願いします。';
  }
  if ( $userInfo['kana'] == '' ) {
    $error[ 'kana' ] = 'フリガナは必須項目です。';
    //制御文字でないことと文字数をチェック
  } else if ( preg_match( '/\A[[:^cntrl:]]{1,10}\z/u', $userInfo['kana'] ) == 0 ) {
    $error[ 'kana' ] = '*フリガナは10文字以内でお願いします。';
  }
  if ( $userInfo['email'] == '' ) {
    $error[ 'email' ] = '*メールアドレスは必須です。';
  } else { //メールアドレスを正規表現でチェック
    $pattern = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/uiD';
    if ( !preg_match( $pattern, $userInfo['email'] ) ) {
      $error[ 'email' ] = '*メールアドレスの形式が正しくありません。';
    }
  }
  if ( $userInfo['tel'] != '' && preg_match( '/\A\(?\d{2,5}\)?[-(\.\s]{0,2}\d{1,4}[-)\.\s]{0,2}\d{3,4}\z/u', $userInfo['tel'] ) == 0 ) {
    $error[ 'tel' ] = '*電話番号の形式が正しくありません。';
  }
  if ( $userInfo['body'] == '' ) {
    $error[ 'body' ] = '*お問い合せ内容は必須項目です。';
    //制御文字でないことと文字数をチェック
  }
}