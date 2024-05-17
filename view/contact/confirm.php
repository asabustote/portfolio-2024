<?php
session_start();
$path = '../../';
// require_once $path.'class/Confirm.php';
require_once '../../model/Confirm.php';
require $path.'libs/function.php';

$_POST = checkInput( $_POST );  

//固定トークンを確認（CSRF対策）
if ( isset( $_POST[ 'ticket' ], $_SESSION[ 'ticket' ] ) ) {
  $ticket = $_POST[ 'ticket' ];
  if ( $ticket !== $_SESSION[ 'ticket' ] ) {
    //トークンが一致しない場合は処理を中止
    die( 'Access Denied!' );
  }
} else {
  //トークンが存在しない場合は処理を中止（直接このページにアクセスするとエラーになる）
  // die( 'Access Denied（直接このページにはアクセスできません）' );
  header( 'HTTP/1.1 303 See Other' );
  header( 'location: contact.php' );
}


//POSTされたデータを初期化して前後にあるホワイトスペースを削除
$array_inputedValues['name']    = trim(filter_input(INPUT_POST, 'name'));
$array_inputedValues['kana']    = trim(filter_input(INPUT_POST, 'kana'));
$array_inputedValues['tel']     = trim(filter_input(INPUT_POST, 'tel'));
$array_inputedValues['email']   = trim(filter_input(INPUT_POST, 'email'));
$array_inputedValues['inquiry'] = trim(filter_input(INPUT_POST, 'inquiry'));


//値の検証（入力内容が条件を満たさない場合はエラーメッセージを配列 $error に設定）
$confirm = new Confirm($array_inputedValues);
$error = $confirm->validateInputedValues();

//POSTされたデータとエラーの配列をセッション変数に保存
$_SESSION['name']    = $array_inputedValues['name'];
$_SESSION['kana']    = $array_inputedValues['kana'];
$_SESSION['tel']     = $array_inputedValues['tel'];
$_SESSION['email']   = $array_inputedValues['email'];
$_SESSION['inquiry'] = $array_inputedValues['inquiry'];
$_SESSION['error']   = $error;

//チェックの結果にエラーがある場合は入力フォームに戻す
if ( count( $error ) > 0 ) {
  //入力画面（contact.php）の URL 
  $url = ( empty( $_SERVER[ 'HTTPS' ] ) ? 'http://' : 'https://' ) . $_SERVER[ 'SERVER_NAME' ] . ':8888'  . $dirname . '/contact-1_1_0.php';
  header( 'HTTP/1.1 303 See Other' );
  header( 'location: ' . 'contact.php' );
  exit;
}

// //ログインエラーメッセージの取得
if (isset($_SESSION['msg'])) {
  $msg      = $_SESSION['msg'];
  $email    = $_SESSION['email'];
  $passWord = $_SESSION['password'];
  $_SESSION = array();
} else {
  $msg      = "";
  $email    = "";
  $passWord = "";
}

$title = 'Lesson Sample Site';
$description = '説明(確認ページ)';
include $path . 'inc/head.php';
  ?>
</head>
<?php   include $path . 'inc/nav.php'; ?>
<?php   include $path . 'inc/modal.php'; ?>
<body>
  <main class="contents">
    <section class="content contact">
      <h5 class="level5-heading heading-contact">
        お問い合わせ
      </h5>
      <form class="contact__form" action="../contact/compleat.php" method="post">
        <h3 class="level3-heading">
          下記の項目をご記入の上送信ボタンを押してください
        </h3>
        <p class="form__text">
        下記の内容をご確認の上送信ボタンを押してください<br>
        内容を訂正する場合は戻るを押してください。
        </p>
        <dl class="confirm__list">
          <dt class="confirm__title">
            <labe for="name">氏名</label>
          </dt>
          <dd class="confirm__user-data">
          <?php echo h($array_inputedValues['name']); ?>
          </dd>
          <dt class="confirm__title">
            <label for="kana">フリガナ</label>
          </dt>
          <dd class="confirm__user-data">
          <?php echo h($array_inputedValues['kana']); ?>
          </dd>
          <dt class="confirm__title">
            <label for="tel">電話番号</label>
          </dt>
          <dd class="confirm__user-data">
          <?php echo h($array_inputedValues['tel']); ?>
          </dd>
          <dt class="confirm__title">
            <label for="email">メールアドレス</label>
          </dt>
          <dd class="confirm__user-data">
            <?php echo h($array_inputedValues['email']); ?>
          </dd>
          <dt class="confirm__title">
            <label for="inquiry">お問い合わせ内容</label>
          </dt>
        </dl>
        <dd class="confirm__user-data">
        <?php echo nl2br(h($array_inputedValues['inquiry']),false); ?>
        </dd>   
        <dl class="horizontal-btn-list">
          <dd class="horizontal-btn-list__item">
            <form action="../contact/compleat.php" method="post">
              <input type="hidden" name="ticket" value="<?php echo h($ticket); ?>">
              <button id="submit" type="submit" class="button-submit horizontal-btn-list__btn">送信</button>
            </form>
          </dd>
          <dd class="horizontal-btn-list__item">
            <a class="button-back horizontal-btn-list__btn" href="../contact/contact.php">戻る</a>
          </dd>
        </dl>
      </form>
    </section>
  </main>
  <?php   include $path . 'inc/footer.php'; ?>
</body>
</html>