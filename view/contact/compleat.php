<?php
session_start();

$path = '../../';
require $path. 'libs/function.php';
require $path.'dao/UserInfoDAO.php';
$_POST = checkInput($_POST);

//固定トークンを確認（CSRF対策）
if ( isset( $_POST[ 'ticket' ], $_SESSION[ 'ticket' ] ) ) {
  $ticket = $_POST[ 'ticket' ];
  if ( $ticket !== $_SESSION[ 'ticket' ] ) {
    //トークンが一致しない場合は処理を中止
    die( 'Access denied' );
  }
} else {
  header( 'HTTP/1.1 303 See Other' );
  header( 'location: contact.php' );
  exit;
}

//変数にエスケープ処理したセッション変数の値を代入
$name    = h( $_SESSION[ 'name' ] );
$kana    = h( $_SESSION[ 'kana' ] );
$email   = h( $_SESSION[ 'email' ] ) ;
$tel     =  h( $_SESSION[ 'tel' ] ) ;
$inquiry = h( $_SESSION[ 'inquiry' ] );

$userData = $_SESSION;
$userInfoDAO = new UserInfoDAO();
$userInfoDAO->insertToDB($userData);

//$_SESSIONの値を初期化
unset($_SESSION['name']);
unset($_SESSION['kana']);
unset($_SESSION['email']);
unset($_SESSION['tel']);
unset($_SESSION['inquiry']);
unset($_SESSION['error']);

$title = 'Lesson Sample Site';
$description = '説明(完了ページ)';
include $path . 'inc/head.php';
?>
</head>
<body>
<?php   include $path . 'inc/nav.php'; ?>
<?php   include $path . 'inc/modal.php'; ?>
  <main class="contents">
    <section class="content contact">
      <h5 class="level5-heading heading-contact">
        お問い合わせ
      </h5>
      <form class="contact__form complete_msg">
        <p class="form__text">
          お問い合わせ頂きありがとうございます。
        </p>
        <p class="form__text">
          送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。
        </p>
        <p class="form__text">
          なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。
        </p>
        <a class="back-to-home" href="../../index.php">
          トップへ戻る
        </a>
      </form>
    </section>
  </main>
 
  <?php   include $path . 'inc/footer.php'; ?>

</body>
</html>