
<?php
session_start();
require '../../model/SerchCondition.php';
require '../../libs/function.php';

if(isset($_SESSION['userInfoList'])) {
  $userInfoList = $_SESSION['userInfoList'];
} 

//検索条件の取得
if(isset($_SESSION['serchCodition'])) {
  $serchCondition = $_SESSION['serchCodition'];
} else {
  $serchCondition = new SerchCodition("","");
}

if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
} else {
  $message = "";
}

$_SESSION = array();

$title       = '管理者画面';
$description = '管理者画面';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>    
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Customer's Infomation</h1>
            <form class="form_layout" action="../../controller/serch.php" method="get">
              <div class="input-group">
                <input class="input" type="search" name="userName" placeholder="Search user name..." value="<?php echo $serchCondition->getUserName(); ?>">
                <input class="input" type="search" name="phoneNumber" placeholder="Search phone number..."  value="<?php echo $serchCondition->getPhoneNumber(); ?>">
                <input class="input" type="submit" value="serch">
              </div>
              <input type="hidden" name="action" value="serch">
            </form>
            <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File"></label>
                <input type="checkbox" id="export-file">
                <div class="export__file-options">
                    <label>Export As &nbsp; &#10140;</label>
                    <label for="export-file" id="toPDF">PDF <img src="images/pdf.png" alt=""></label>
                    <label for="export-file" id="toJSON">JSON <img src="images/json.png" alt=""></label>
                    <label for="export-file" id="toCSV">CSV <img src="images/csv.png" alt=""></label>
                    <label for="export-file" id="toEXCEL">EXCEL <img src="images/excel.png" alt=""></label>
                </div>
            </div>
        </section>
         <div class="msg"> <?php echo $message; ?> </div>
        <section>
            <h1><a/h1>
        </section>
        <section class="table__body">
        <form  action="../../controller/serch.php" method="post">
         <input type="hidden" name="id" value="<?php echo $id; ?>">
            <table>
                <thead>
                    <tr>
                        <th> Select <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Customer <span class="icon-arrow">&UpArrow;</span></th>
                        <th> kana <span class="icon-arrow">&UpArrow;</span></th>
                        <th> tel <span class="icon-arrow">&UpArrow;</span></th>
                        <th> E-mail <span class="icon-arrow">&UpArrow;</span></th>
                        <th> inquiry <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <tbody class="vertical-table__body">
                        <?php if (isset($userInfoList)) {
                            foreach ($userInfoList as $userInfo):?>
                        <tr class="vertical-table__body-row">
                        <td class="vertical-table__text"><label><input type="checkbox" name='selectedId[]' value='<?php echo h($userInfo['id']);?>'></label></td>
                        <td class="vertical-table__text"><?php echo h($userInfo['id']); ?></td>
                        <td class="vertical-table__text">
                            <?php echo h($userInfo['name']); ?>
                        </td>
                        <td class="vertical-table__text">
                            <?php echo h($userInfo['kana']); ?>
                        </td>
                        <td><?php echo h($userInfo['tel']); ?></td>
                        <td><?php echo h($userInfo['email']); ?></td>
                        <td><?php echo h($userInfo['inquiry']); ?></td>
                        </tr>
                        <?php     endforeach;
                        }?>
                </tbody>
            </table>
        </section>
                <button class="margin-left-40px float1" name="action" value="add">add</button>
                <?php if(isset($userInfoList)) { ?>
                <button class="float1" name="action" value="update">update</button>
                <button class="float1" name="action" value="delete" onclick="return confirmCRUDPrompt('delete')">delete</button>
                <?php }?>
                <a class="float1" href="../../index.php">Back</a>
            
        </form>
    </main>
    <script src="script.js"></script>
    <script src="../../js/util.js"></script>

</body>

</html>
