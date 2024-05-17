<div class="<?php echo isset($is_home) ? 'header__inner' : 'header__inner header__inner-bg'; ?>">
  <div class="header-logo__img-wrappre">
    <a <?php echo isset($is_home) ? '': 'href=' .$path. 'index.php'; ?>>
      <img class="header-logo__img" src="<?php echo $path;?>images/logo.png" alt="画像:ロゴ">
    </a>
  </div>
  <!-- header-logo__img-wrappre -->
  <nav class="grobal-nav">
    <ul class="grobal-nav__items">
      <li class="grobal-nav__item">
        <a class="grobal-nav__link" <?php echo isset($is_home) ? "href='view/portfolio_2022/index.html'" : "href=" . $path . 'view/portfolio_2022/index.html';?>>
          portfolio_2022
        </a>
      </li>
      <li class="grobal-nav__item">
        <a class="grobal-nav__link" <?php echo isset($is_home) ? "" : "href=" . $path . 'index.php#ivent';?>>
          体験
        </a>
      </li>
      <li class="grobal-nav__item">
        <a class="grobal-nav__link" href="<?php echo $path; ?>view/contact/contact.php">
          お問い合わせ
        </a>
      </li>
    </ul>
  </nav>
  <div class="auth">
    <a class="auth__link" href="#">
      <p class="auth__text">
        サインイン
      </p>
    </a>
  </div>
  <!-- /.auth -->
 <div class="humberger">
  <img class="humberger-img" src="<?php echo $path; ?>images/menu.png">
    <div class="humberge__menu">
      <ul class="menu__items">
        <li class="menu__item">
          サインイン
        </li>
        <li class="menu__item">
          <a class="humberge__link" <?php echo isset($is_home) ? "href='view/portfolio_2022/index.html'" : "href=" . $path . 'view/portfolio_2022/index.html';?>>
            portfolio_2022
          </a>
        </li>
        <li class="menu__item">
          <a class="humberge__link" <?php echo isset($is_home) ? "" : "href=" . $path . 'index.php#ivent';?>>
            体験
          </a>
        </li>
        <li class="menu__item">
          <a class="humberge__link" href="<?php echo $path; ?>view/contact/contact.php">
            お問い合わせ
          </a>
        </li>
      </ul>
    </div>
    <!-- /.humberge__menu -->
  </div>
  <!-- /.humberger -->
</div>
<!-- /.header__inner -->
<!-- サイトのロゴとタイトルへのリンクをホーム（index.php  ）の場合は a 要素の href 属性を指定せず、その他のページではホームへのリンクとするため、$is_home というトップページの判定用の変数が設定（定義）されているかどうかで出力を変える -->