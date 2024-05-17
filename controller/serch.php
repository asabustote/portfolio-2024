<?php
require '../dao/UserInfoDAO.php';
require '../model/SerchCondition.php';
session_start();

if(isset($_GET['action'])) {
  $action = $_GET['action'];
} else if (isset($_POST['action'])) {
  $action = $_POST['action'];
}

$locationPath = "";
$userInfoDAO = new UserInfoDAO();

  if (strcmp("serch", $action) == 0) {
    // 検索条件を取得
    $userName    = $_GET['userName'];
    $phoneNumber = $_GET['phoneNumber'];
  
    // 検索条件を関するクラスへ格納
    $searchCondition = new SerchCodition($userName, $phoneNumber);
  
    // 検索条件をセッションに保存
    $_SESSION['serchConditon'] = $searchCondition;
    $locationPath = 'Location: ../view/edit/serchUserInfo.php';
  } else if (strcmp("delete", $action) == 0) {
    $selectedId = $_POST['selectedId'];
  
    if ($selectedId == null) {
      $_SESSION['message'] = '削除したいユーザーを選択してください。';
    } else {
      //idにより値を削除する
      $amountOfDeletedRecords = $userInfoDAO->deleteByUserId($selectedId);
      if ($amountOfDeletedRecords > 0) {
        $message = $amountOfDeletedRecords."件のデータを削除しました";
      } else {
        $message = '削除処理が失敗しました。';
      }
      $_SESSION['message'] = $message;
    }
    $locationPath = 'Location: ../view/edit/serchUserInfo.php';
  } else if (strcmp("add", $action) == 0) {
    $locationPath = 'Location: ../view/edit/addUserInfo.php';
  }else if (strcmp("update", $action) == 0) {
    $selectedId = $_POST['selectedId'];
  
    if ($selectedId == null) {
      $_SESSION['message'] = '更新したいユーザーを選択してください。';
      $locationPath = 'Location: ../view/edit/serchUserInfo.php';
    } else {
      $_SESSION['selectedIds'] = $selectedId;
      $locationPath = 'Location: ../view/edit/updateUserInfo.php';
    }
  } 
  
  $userInfoDAO->serchUserInfo();


header($locationPath);
?>