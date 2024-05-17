<?php
session_start();
require '../../libs/function.php';
//セッション変数を初期化
$name    = $_SESSION['name'] ?? NULL;
$kana    = $_SESSION['kana'] ??  NULL;
$email   = $_SESSION['email'] ?? NULL;
$tel     = $_SESSION['tel'] ??  NULL;
$inquiry = $_SESSION['inquiry'] ??  NULL;

//個々のエラーを初期化
$error_name    = $error['name'] ?? "";
$error_kana    = $error['kana'] ?? "";
$error_email   = $error['email'] ?? "";
$error_tel     = $error['tel'] ?? "";
$error_inquiry = $error['inquiry'] ?? "";

if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
  $error_name    = $_SESSION['message']['name'] ?? "";
  $error_kana    = $_SESSION['message']['kana'] ?? "";
  $error_email   = $_SESSION['message']['email'] ?? "";
  $error_tel     = $_SESSION['message']['tel'] ?? "";
  $error_inquiry = $_SESSION['message']['inquiry'] ?? "";

  $name = $_SESSION['userInfos']['name'];
  $kana = $_SESSION['userInfos']['kana'];
  $email = $_SESSION['userInfos']['email'];
  $tel = $_SESSION['userInfos']['tel'];
  $inquiry = $_SESSION['userInfos']['inquiry'];

} else {
  $message = [];
}

$title       = 'ユーザー情報追加画面';
$description = 'ユーザー情報追加画面';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title><?php echo $title; ?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo $description; ?>">
  <link rel="stylesheet" href="../../css/a_modern_css_rest.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/table.css">
</head>
<body>
  <secton class="content contact contact_2">
    <form name="myForm" class="validationForm contact__form" action="../../controller/addUserInfo.php" method="post">
          <h3 class="level3-heading">
            下記の項目をご記入の上送信ボタンを押してください。
          </h3>
          <div class="form__data-list">
             <div class="form__data">
                <label for="name">名前
                  <span class="warning error-php">*<?php echo h( $error_name );?></span>
                </label>
                <input class="name required maxlength form__user-data" data-maxlength="10" type="text" name="name" id="name" placeholder="山田太郎" value="<?php echo h($name); ?>">
              </div>
              <!-- /.form__data -->
            <div class="form__data">
              <lavel for="kana">フリガナ
                <span class="warning error-php">*<?php echo h( $error_kana ); ?></span>
              </lavel>
              <input class="kana required maxlength form__user-data" data-maxlength="10" type="text" name="kana" id="kana" placeholder="ヤマダタロウ"  value="<?php echo h($kana); ?>">
            </div>
            <!-- /.form__data -->
            <div class="form__data">
              <label for="tel">
                電話番号
                <span class="warning error-php">*<?php echo h( $error_tel ); ?></span>
              </label>
              <input class="tel form__user-data" type="tel" name="tel" id="tel" placeholder="090-1234-5678" value="<?php echo h($tel); ?>">
              </div>
              <!-- /.form__data -->
              <div class="form__data">
                <label for="email">メールアドレス
                  <span class="warning">*<?php echo h( $error_email ); ?></span>
                </label>
                <input class="required email form__user-data" type="email" id="email" name="email" placeholder="test@test.co.jp" value="<?php echo h($email); ?>">
              </div>
              <!-- /.form__data -->
              <div class="form__data level3-heading">
                <label for="inquiry">お問い合わせ内容をご記入ください
                  <span class="warning error-php">*<?php echo h($error_inquiry); ?></span>
                </label>
                <!-- maxlength data-maxlength="100" -->
                <textarea class="required  form__user-data"  name="inquiry" id="inquiry" rows="5" cols="50"><?php echo h( $inquiry ); ?></textarea>
              </div>
              <!-- /.form__data -->
            <button id="submit" name="send" class="button-submit" onclick="return confirmCRUDPrompt('add')">追加</button>
          </div>
          <a style="margin-left: 0;" class="button-back horizontal-btn-list__btn" href="../edit/serchUserInfo.php">戻る</a>
          <!-- /.form__data-list -->
    </form>

  </secton>
  <script src="../../js//util.js"></script>
</body>