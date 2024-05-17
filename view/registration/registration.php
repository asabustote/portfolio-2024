<?php
//ユーザー新規登録画面
require '../../libs/function.php';
session_start();


if (isset($_SESSION['message'])) {
    $err_email    = $_SESSION['message']['mail'];
    $err_passWord = $_SESSION['message']['passWord'];
} else {
    $message = [];
    $err_email    = "";
    $err_passWord = "";
}

if (isset($_SESSION['registrationInfo'])) {
    $email    = $_SESSION['registrationInfo']['email'];
    $passWord = $_SESSION['registrationInfo']['passWord'];
} else {
    $email    = "";
    $passWord = "";
}

if (isset($_SESSION['result'])) {
    $resultMsg = $_SESSION['result'];
  } else {
    $resultMsg = "";
  }

  $_SESSION = array();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>registration</title>
  <link rel="stylesheet" type="text/css" href="registration.css">
</head>
<body>
        <div class="container">
            <form name="registration-form" action="../../controller/registration/registration.php" method="post">
                <div class="brand-title">Registratio</div>
                <?php echo $resultMsg;?>
                <br><span class="warning error-php"><?php echo h( $err_email );?></span>
                <br><span class="warning error-php"><?php echo h( $err_passWord );?></span>
                    <div class="inputs">
                        <label>EMAIL</label>
                        <input name="email" type="email" placeholder="example@test.com" value="<?php echo h($email);?>"/>
                        <label>PASSWORD</label>
                        <input name="password" type="password" placeholder="Min 8 characters long, at least 1 number." value="<?php echo h($passWord);?>"/>
                        <button type="submit">Registration</button>
                        <button type="reset">reset</button>
                        <a href="../../index.php">トップへ戻る</a>  
                    </div>
                </div>
            </form>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>