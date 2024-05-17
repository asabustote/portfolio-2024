<?php
//新規ユーザーテーブルへの値操作用のモデル
class RegistrationDAO {
  private $dbh = "";
  private string $tableName = "administer";

  private function dbConnect() {
    $host   = 'www.orangefrog14.com';
    $dbname = 'cafe';
    $user   = 'orangefrog14';
    $pass   = 'orangefrog14';
    $dsn    = "mysql:dbname=$dbname;host=$host;charset=utf8";
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

//   public function insertUserInfo (AdministerInfo $administeruInfo) {
//     $sql = "INSERT INTO $this->tableName(email, pass_word) VALUES(:email, :password);";

//     // 前後の全角半角空白を除去
//     $this->trimdEmailAndPassWord($administeruInfo);

//     $this->dbh->beginTransaction();
//     try {
//       $stmt = $this->dbh->prepare($sql);
//       $stmt->bindValue(':email', $administeruInfo->getEmail(), PDO::PARAM_STR);
//       $stmt->bindValue(':password', $administeruInfo->getPassWord(), PDO::PARAM_STR);
//       $stmt->execute();
//       $this->dbh->commit();
//     } catch(PDOException $e) {
//       $this->dbh->rollBack();
//       exit($e);
//     }
//   }

//   private function trimdEmailAndPassWord(AdministerInfo $administerInfo): void {
//     // 前後の全角半角空白を除去
//     $administerInfo->setEmail(preg_replace('/^[[:space:]]+|[[:space:]]+$/u', '', $administerInfo->getEmail()));
//     $administerInfo->setPassWord(preg_replace('/^[[:space:]]+|[[:space:]]+$/u', '', $administerInfo->getPassWord()));
// }


public function getAllUsers() : array {
  try {
    $dbh    = $this->dbConnect();
    $sql    = "SELECT * FROM $this->tableName";
    $stmt   = $dbh->query($sql);
    $userInfoList = $stmt->fetchAll();

  } catch (PDOException $e) {
    echo "DBアクセス時にエラーが発生しました。";
    echo $e->getMessage();
  }
  
  return $userInfoList;
}



}
?>