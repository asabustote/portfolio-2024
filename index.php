<?php
session_start();
$title = 'Portfolio_2024';
$description = '説明(トップページ)';
$is_home = true;
$path = './';
include $path . 'inc/head.php';
include $path . 'libs/function.php';


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
?>
</head>
<body class="body">
  <div class="info">
    <a class="info__link" href="#">
      <p class="info__text">
        新型コロナウイルスに対する取り組みの最新情報をご案内
      </p>
    </a>
  </div>
  <!-- /.info -->
  <header class="header">
    <h1 class="level1-heading">
      あなたの<br>好きな空間を作る。
    </h1>
    <?php include $path . 'inc/nav.php'; ?>
  </header>
   <?php   include $path . 'inc/modal.php'; ?>
  <main class="contents">
    <section class="content">
      <div class="cards">
        <div class="card">
          <div class="card__img-wrapper">
            <img class="card__img" src="./images/cafe1.jpg" alt="画像:東京のカフェの店内の写真">
          </div>
          <!-- /.card__img-wrapper -->
          <div class="card__body">
            <h4 class="level4-heading">
              東京
            </h4>
            <p class="card__text">
              車で15分
            </p>
          </div>
          <!-- /.card__body -->
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card__img-wrapper">
            <img class="card__img" src="./images/cafe2.jpg" alt="画像:神奈川のカフェの店内の写真">
          </div>
          <!-- /.card__img-wrapper -->
          <div class="card__body">
            <h4 class="level4-heading">
              神奈川
            </h4>
            <p class="card__text">
              車で30分
            </p>
          </div>
          <!-- /.card__body -->
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card__img-wrapper">
            <img class="card__img" src="./images/cafe3.jpg" alt="画像:愛知のカフェの店内の写真">
          </div>
          <!-- /.card__img-wrapper -->
          <div class="card__body">
            <h4 class="level4-heading">
              愛知
            </h4>
            <p class="card__text">
              車で1時間
            </p>
          </div>
          <!-- /.card__body -->
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card__img-wrapper">
            <img class="card__img" src="./images/cafe4.jpg" alt="画像:京都のカフェの店内の写真">
          </div>
          <!-- /.card__img-wrapper -->
          <div class="card__body">
            <h4 class="level4-heading">
              京都
            </h4>
            <p class="card__text">
              車で40分
            </p>
          </div>
          <!-- /.card__body -->
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card__img-wrapper">
            <img class="card__img" src="./images/cafe5.jpg" alt="画像:岡山のカフェの店内の写真">
          </div>
          <!-- /.card__img-wrapper -->
          <div class="card__body">
            <h4 class="level4-heading">
              岡山
            </h4>
            <p class="card__text">
              車で1.5時間
            </p>
          </div>
          <!-- /.card__body -->
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card__img-wrapper">
            <img class="card__img" src="./images/cafe6.jpg" alt="画像:鹿児島のカフェの店内の写真">
          </div>
          <!-- /.card__img-wrapper -->
          <div class="card__body">
            <h4 class="level4-heading">
              鹿児島
            </h4>
            <p class="card__text">
              車で50分
            </p>
          </div>
          <!-- /.card__body -->
        </div>
        <!-- /.card -->
        <div class="card">
          <div class="card__img-wrapper">
            <img class="card__img" src="./images/cafe7.jpg" alt="画像:沖縄のカフェの店内の写真">
          </div>
          <!-- /.card__img-wrapper -->
          <div class="card__body">
            <h4 class="level4-heading">
              沖縄
            </h4>
            <p class="card__text">
              車で2時間
            </p>
          </div>
          <!-- /.card__body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.cards -->
    </section>
    <section class="content location" id="location">
      <h2 class="level2-heading">
        好きなロケーションを選ぼう
      </h2>
      <div class="cards-02">
        <div class="card-02">
          <div class="card-02__img-wrapper">
            <img class="card-02__img" src="./images/intro1.jpg" alt="画像:カフェの外観-クラシック">
          </div>
          <!-- /.card-02__img-wrapper -->
          <div class="card__body-02">
            <h5 class="level5-heading">
              <a href="map/map.php?location=Vienna">クラシック</a>
            </h5>
          </div>
          <!-- /.card__body -->
        </div>
        <!-- /.card-02 -->
        <div class="card-02">
          <div class="card-02__img-wrapper">
            <img class="card-02__img" src="./images/intro2.jpg" alt="画像:カフェの外観-バー">
          </div>
          <!-- /.card-02__img-wrapper -->
          <div class="card__body-02">
            <h5 class="level5-heading">
              <a href="map/map.php?location=New Orleans">バー</a>
            </h5>
          </div>
          <!-- /.card__body -->
        </div>
        <!-- /.card-02 -->
        <div class="card-02">
          <div class="card-02__img-wrapper">
            <img class="card-02__img" src="./images/intro3.jpg" alt="画像:カフェの外観-キャンプ">
          </div>
          <!-- /.card-02__img-wrapper -->
          <div class="card__body-02">
            <h5 class="level5-heading">
              <a href="map/map.php?location=Yosemite National Park">キャンプ</a>
            </h5>
          </div>
          <!-- /.card__body -->
        </div>
        <!-- /.card-02 -->
        <div class="card-02">
          <div class="card-02__img-wrapper">
            <img class="card-02__img" src="./images/intro4.jpg" alt="画像:カフェの外観-リゾート">
          </div>
          <!-- /.card-02__img-wrapper -->
          <div class="card__body-02">
            <h5 class="level5-heading">
              <a href="map/map.php?location=Bali">リゾート</a>
            </h5>
          </div>
          <!-- /.card__body -->
        </div>
        <!-- /.card-02 -->
      </div>
      <!-- /.cards-02 -->
      <div class="adv">
        <div class="adv-body">
          <h2 class="level2-heading-adv">
            Go To Eats
          </h2>
          <p class="adv-text">
            キャンペーンを利用して、全国で食事しよう。<br>
            いつもと違う景色に囲まれてカラダもココロもリフレッシュ。
          </p>
        </div>
        <!-- /.adv-body -->
        <div class="adv-img-wrapper">
          <img class="adv-img" src="./images/goto.jpg" alt="画像:キャンペーン広告画像">
        </div>
        <!-- /.adv-img-wrapper -->
      </div>
      <!-- /.adv -->
    </section>
    <section class="content ivent" id="ivent">
      <h2 class="level2-heading">
        カフェ作りを体験しよう
      </h2>
      <p class="ivent-text">
        お店のエキスパートが案内するユニークな体験（直接対面型またはオンライン）。
      </p>
      <div class="cards-03">
        <div class="card-03">
          <div class="card-03__img-wrapper">
            <img class="card-03-img" src="./images/exp1.jpg" alt="画像:仕事体験の写真">
          </div>
          <!-- /.card-03__img-wrapper -->
          <div class="card-03__body">
            <h5 class="level5-heading level5-heading-ivent">
              ジョブ体験
            </h5>
            <div class="card-03__text">
              カフェカウンターを体験しよう。
            </div>
            <!-- /.card-03__text -->
          </div>
          <!-- /.card-03__body -->
        </div>
        <!-- /.card-03 -->
        <div class="card-03">
          <div class="card-03__img-wrapper">
            <img class="card-03-img" src="./images/exp2.jpg" alt="画像:仕事体験の写真">
          </div>
          <!-- /.card-03__img-wrapper -->
          <div class="card-03__body">
            <h5 class="level5-heading level5-heading-ivent">
              レシピ体験
            </h5>
            <div class="card-03__text">
              美味しいレシピを考えてみよう。
            </div>
            <!-- /.card-03__text -->
          </div>
          <!-- /.card-03__body -->
        </div>
        <!-- /.card-03 -->
        <div class="card-03">
          <div class="card-03__img-wrapper">
            <img class="card-03-img" src="./images/exp3.jpg" alt="画像:仕事体験の写真">
          </div>
          <!-- /.card-03__img-wrapper -->
          <div class="card-03__body">
            <h5 class="level5-heading level5-heading-ivent">
              プロモーション体験
            </h5>
            <div class="card-03__text">
              お店の宣伝を手伝ってみよう。
            </div>
            <!-- /.card-03__text -->
          </div>
          <!-- /.card-03__body -->
        </div>
        <!-- /.card-03 -->
      </div>
      <!-- /.cards-03 -->
    </section>
    <section class="content">
      <h2 class="level2-heading">
        全国のホストに仲間入りしよう
      </h2>
      <div class="cards-04">
        <div class="card-03">
          <div class="card-03__img-wrapper">
            <img class="card-03-img" src="./images/host1.jpg" alt="画像:女性がカフェで電話をしているの写真">
          </div>
          <!-- /.card-03__img-wrapper -->
          <div class="card-03__body">
            <h5 class="level5-heading level5-heading-ivent">
              ビジネス
            </h5>
          </div>
          <!-- /.card-03__body -->
        </div>
        <!-- /.card-03 -->
        <div class="card-03">
          <div class="card-03__img-wrapper">
            <img class="card-03-img" src="./images/host2.jpg" alt="画像:男性がカフェの席についているの写真">
          </div>
          <!-- /.card-03__img-wrapper -->
          <div class="card-03__body">
            <h5 class="level5-heading level5-heading-ivent">
              コミュニティ
            </h5>
          </div>
          <!-- /.card-03__body -->
        </div>
        <!-- /.card-03 -->
        <div class="card-03">
          <div class="card-03__img-wrapper">
            <img class="card-03-img" src="./images/host3.jpg" alt="画像:女性がカフェで食事をしている写真">
          </div>
          <!-- /.card-03__img-wrapper -->
          <div class="card-03__body">
            <h5 class="level5-heading level5-heading-ivent">
              食べ歩き
            </h5>
          </div>
          <!-- /.card-03__body -->
        </div>
        <!-- /.card-03 -->
      </div>
      <!-- /.cards-03 -->
    </section>
  </main>
  <?php
  require $path . 'inc/footer.php';
  ?>
  <a class="btn btn-offset" style="position: fixed;">
    Jump To Top
  </a>
  <script src="<?php echo $path;?>js/scroll.js"></script>  
</body>
</html>