<?php
// require('../model/Administrator.php');
//新規ユーザーテーブルへの値操作用のモデル
class AdministratorDAO {
  private string $tableName = "administer";

  private function dbConnect() {
    $host   = 'www.orangefrog14.com';
    $dbname = 'cafe';
    $user   = 'orangefrog14';
    $pass   = 'orangefrog14';
    $dsn    = "mysql:dbname=$dbname;host=$host;charset=utf8";

    //local環境
    // $host   = 'localhost';
    // $dbname = 'cafe';
    // $user   = 'test_user';
    // $pass   = 'test';
    // $dsn    = "mysql:dbname=$dbname;host=$host;charset=utf8";

    try {
      $dbh = new PDO($dsn,$user,$pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
      ]);
    } catch(PDOException $e) {
      echo '接続失敗' . $e->getMessage();
      var_dump($host);
      exit();
    }

    return $dbh;
  }

  public function insertEmailAndPassWord (array $administerInfo) {
    $sql = "INSERT INTO $this->tableName(email, pass_word) VALUES(:email, :password);";

    // 前後の全角半角空白を除去
    $administerInfo = $this->trimdEmailAndPassWord($administerInfo);

    //更新結果
    $result =false;

    $dbh = $this->dbConnect();
    $dbh->beginTransaction();
    try {
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':email', $administerInfo['email'], PDO::PARAM_STR);
      $stmt->bindValue(':password', $administerInfo['passWord'], PDO::PARAM_STR);
      $result = $stmt->execute();
      $dbh->commit();
    } catch(PDOException $e) {
      $dbh->rollBack();
      exit($e);
    }
    return $result;
  }

  private function trimdEmailAndPassWord(array $inputedData): array {
    // 前後の全角半角空白を除去
    $inputedData['email'] = preg_replace('/^[[:space:]]+|[[:space:]]+$/u', '', $inputedData['email']);
    $inputedData['passWord'] = preg_replace('/^[[:space:]]+|[[:space:]]+$/u', '', $inputedData['passWord']);

    return $inputedData;
  }

public function getAllAdministors() : array {
  try {
    $dbh    = $this->dbConnect();
    $sql    = "SELECT * FROM $this->tableName";
    $stmt   = $dbh->query($sql);
    $adminDataList = $stmt->fetchAll();

    // var_dump($adminDataList);

    $administrators = [];
    foreach ($adminDataList as $adminData) {
    $administrator = new Administrator($adminData['administer_id'], 
                                       $adminData['email'], 
                                        $adminData['pass_word']);
    $administrators[] = $administrator;
    }

  } catch (PDOException $e) {
    echo "DBアクセス時にエラーが発生しました。";
    echo $e->getMessage();
  }
  
  return $administrators;
}

}
?>