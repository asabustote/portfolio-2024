<?php
session_start();
require '../../dao/UserInfoDAO.php';

// 更新したい情報のidを取得
$selectedIds = $_SESSION['selectedIds'];

// idによりdbから値を取得
$usrInfoDao = new UserInfoDAO();

//更新エラーでupdate.phpから戻ってきた時の処理
if (isset($_SESSION['inputedUserInfos'])) {
  foreach ($_SESSION['inputedUserInfos'] as $userInfo) {
    $userinfolist[] = $userInfo;
  }
} else {//serchUserInfo.phpからきた時の処理
  $userinfolist = $usrInfoDao->getUsrInfoByUserIds($selectedIds);
}

// エラーメッセージを初期化);
$errors = $_SESSION['message'] ?? [];

// フォームに表示する情報
$title = 'ユーザー情報更新画面';
$description = 'ユーザー情報更新画面';
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
  <script src="../../js/util.js"></script>
</head>

<body>
  <secton class="content contact contact_2">
    <form class="vertical-table" action="../../controller/update.php" method="post">
      <h3 class="level3-heading">ユーザー情報更新フォーム</h3>
      <table class="vertical-table__inner">
        <thead class="vertical-table__headers">
          <tr class="vertical-table__header-row">
              <th class="vertical-table__header">ID</th>
              <th class="vertical-table__header">名前</th>
              <th class="vertical-table__header">カナ</th>
              <th class="vertical-table__header">TEL</th>
              <th class="vertical-table__header">E-mail</th>
              <th class="vertical-table__header">問い合わせ内容</th>
          </tr>
        </thead>
        <tbody class="vertical-table__body">
          <?php foreach ($userinfolist as $userInfo):?>
          <tr class="vertical-table__body-row">
            <td class="vertical-table__text"><?php echo $userInfo['id']; ?></td>
            <input type="hidden" name="id[]" value="<?php echo $userInfo['id']; ?>">
            <td class="vertical-table__text">
              <input class="name required maxlength form__user-data" data-maxlength="10" type="text" name="name[]" id="name" value="<?php echo $userInfo['name']; ?>">
              <span class="warning error-php"><?php echo isset($errors[$userInfo['id']]['name']) ? $errors[$userInfo['id']]['name'] : ''; ?></span>
            </td>
            <td class="vertical-table__text">
              <input class="kana required maxlength form__user-data" data-maxlength="10" type="text" name="kana[]" id="kana" value="<?php echo $userInfo['kana']; ?>">
              <span class="warning error-php"><?php echo isset($errors[$userInfo['id']]['kana']) ? $errors[$userInfo['id']]['kana'] : ''; ?></span>
            </td>
            <td class="vertical-table__text">
              <input class="tel form__user-data" type="tel" name="tel[]" id="tel" value="<?php echo $userInfo['tel']; ?>">
              <span class="warning error-php"><?php echo isset($errors[$userInfo['id']]['tel']) ? $errors[$userInfo['id']]['tel'] : ''; ?></span>
            </td>
            <td class="vertical-table__text">
              <input class="required email form__user-data" type="email" id="email" name="email[]"  value="<?php echo $userInfo['email']; ?>">
              <span class="warning error-php"><?php echo isset($errors[$userInfo['id']]['email']) ? $errors[$userInfo['id']]['email'] : ''; ?></span>
            </td>
            <td class="vertical-table__text">
              <textarea class="required  form__user-data"  name="body[]" id="body" rows="5" cols="50"><?php echo $userInfo['inquiry']; ?></textarea>
              <span class="warning error-php"><?php echo isset($errors[$userInfo['id']]['inquiry']) ? $errors[$userInfo['id']]['inquiry'] : ''; ?></span>
            </td>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
      <button style="margin-bottom: 10px;" id="submit" class="button-submit"  value="update" onclick="return confirmCRUDPrompt('update')">更新</button>
      <a style="margin-left: 0;" class="button-back horizontal-btn-list__btn"  href="../edit/serchUserInfo.php">戻る</a>
    </form>
    <!-- /.vertical-table -->
  </secton>
</body>
</html>
