<?php
session_start();
require '../model/ValidateForInsert.php';
require '../dao/UserInfoDAO.php';

$validateUserInfo = new ValidateForInsert();
$errMsg = []; // エラーメッセージを格納する配列を初期化
$amountOfUpdatedRecords = 0; //更新された件数を格納する変数を初期化
$userInfoDAO = new UserInfoDAO();

// POSTされたデータからユーザー情報を取得
$userInfos = [];
for ($i = 0; $i < count($_POST['id']); $i++) {
    $userInfos[$i]['id'] = $_POST['id'][$i]; 
    $userInfos[$i]['name'] = $_POST['name'][$i]; 
    $userInfos[$i]['kana'] = $_POST['kana'][$i]; 
    $userInfos[$i]['tel'] = $_POST['tel'][$i]; 
    $userInfos[$i]['email'] = $_POST['email'][$i];
    $userInfos[$i]['inquiry'] = $_POST['body'][$i];  
}

//エラーチェック
$errMsgs = [];
for ($i = 0; $i < count($userInfos); $i++) {
    $key = $userInfos[$i]['id'];
    $errMsgs[$key] = $validateUserInfo->validateInputedData($userInfos[$i]);
}

//アップデート可能かの判定
$amountOfErrors = 0;
foreach ($errMsgs as $errMsg) {
    if (!empty($errMsg)) {
        $amountOfErrors++;
    } 
}

if ($amountOfErrors > 0) {
    $amountOfUpdatedRecord = $userInfoDAO->userInfoUpdate($userInfos);
    $amountOfUpdatedRecords += $amountOfUpdatedRecord;
    $_SESSION['message'] = $amountOfUpdatedRecords."件のデータを更新しました。";
    $locationPath = "Location: ../view/edit/serchUserInfo.php";
    $userInfoDAO->serchUserInfo();
} else {
    $_SESSION['message'] = $errMsgs;
    $_SESSION['inputedUserInfos'] = $userInfos; // 最後の要素の情報がセットされる
    $locationPath = 'Location: ../view/edit/updateUserInfo.php';
}

// リダイレクト
header($locationPath);
exit();
?>