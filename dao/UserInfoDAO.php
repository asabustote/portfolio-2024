<?php
//contact tableへのアクセスを担当するDAO
  class UserInfoDAO {

    private $table_name = 'contacts';

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

    //contact テーブルからユーザ名と電話番号で検索し検索結果を配列で返すメソッド
    public function searchUsersByUserNameAndPhoneNum($userName, $phoneNum) : array {
      // SQL文の初期化
      $sql = $this->queryBuiler($userName, $phoneNum);
  
      try {
          // DBへの接続
          $dbh = $this->dbConnect();
          // SQL文の準備とバインド
          $stmt = $dbh->prepare($sql);
          // SQL文の実行
          $stmt->execute();
          // 結果の取得
          $userInfoList = $this->createUserInfoList($stmt);
          return $userInfoList;
      } catch (PDOException $e) {
          echo "DBアクセス時にエラーが発生しました。";
          echo $e->getMessage();
          return []; // エラーが発生した場合は空の配列を返す
      }
  }
  
  private function createUserInfoList($stmt): array {
      $userInfoList = [];
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          // UserInfoオブジェクトの生成と配列への追加
          $userInfoList[] = $row;
      }
  
      return $userInfoList;
  }

  
  private function queryBuiler(string $name, string $phoneNum) : string {
    $conditions = []; // where句を管理する配列

    if (!empty($name)) {
        $conditions[] = "name LIKE '%" . $name . "%'";
    }

    if (!empty($phoneNum)) {
      // 入力された電話番号にハイフンが含まれているか確認
      if (!preg_match("/-/", $phoneNum)) {
          // ハイフンを含まない場合は3桁、4桁、4桁の形式に変換してハイフンを追加
          $phoneNumWithHyphen = substr($phoneNum, 0, 3) . "-" . substr($phoneNum, 3, 4) . "-" . substr($phoneNum, 7);
      } else {
          $phoneNumWithHyphen = $phoneNum;
      }
     $conditions[] = "tel LIKE '%" . $phoneNumWithHyphen . "%'";
    }

    // クエリを構築
    $query = "SELECT * FROM " . $this->table_name;

    if (!empty($conditions)) {
        $query .= " WHERE ";
        $query .= implode(" AND ", $conditions);
    }

    $query .= ";";

    return $query;
  }


  public //検索条件に応じたユーザ情報を持つクラスを格納した配列を生成しセッションへ格納する
  function serchUserInfo() : void {
    $userInfoDAO = new UserInfoDAO();

    if(isset($_SESSION['serchConditon'])) {
      $serchConditon = $_SESSION['serchConditon'];
    } 

    if (isset($serchConditon)               &&
        "" == $serchConditon->getUserName() &&
        "" == $serchConditon->getPhoneNumber()) {
        $userInfoList = $userInfoDAO->getAllUsers();
    } else if(empty($_SESSION['serchConditon'])){
      $userInfoList = $userInfoDAO->getAllUsers();
    }else {
      $userInfoList = $userInfoDAO->searchUsersByUserNameAndPhoneNum($serchConditon->getUserName(), 
                                                                      $serchConditon->getPhoneNumber());
      }

    $_SESSION['userInfoList'] = $userInfoList;
  }
    

  //return array contact tableの全データ
  public function getAllUsers() {
    try {
      $dbh    = $this->dbConnect();
      $sql    = "SELECT * FROM $this->table_name";
      $stmt   = $dbh->query($sql);
      $userInfoList = $stmt->fetchAll();

    } catch (PDOException $e) {
      echo "DBアクセス時にエラーが発生しました。";
      echo $e->getMessage();
    }
    
    return $userInfoList;
  }
  

  //選択されたユーザ情報を削除するメソッド
  public function deleteByUserId(array $selectedUserIds) : int {
    $amountOfDeletedRecords = 0;
    try {
      $dbh    = $this->dbConnect();
      $sql = "DELETE FROM $this->table_name WHERE id = :id";
      $stmt = $dbh->prepare($sql);

      foreach ($selectedUserIds as $userId) {
        $stmt->bindValue(':id', (int)$userId, PDO::PARAM_INT);
        $stmt->execute();
        $amountOfDeletedRecords += $stmt->rowCount();
    }

    } catch (PDOException $e) {
      echo "DBアクセス時にエラーが発生しました。";
      echo $e->getMessage();
    }

    return $amountOfDeletedRecords;
  }


  public function getUsrInfoByUserIds(array $selectedUserIds) {
    $userInfoList = [];

    try {
        $dbh    = $this->dbConnect();
        $sql = "SELECT * FROM $this->table_name WHERE id = :id";
        $stmt = $dbh->prepare($sql);

        foreach ($selectedUserIds as $userId) {
            $stmt->bindValue(':id', (int)$userId, PDO::PARAM_INT);
            $stmt->execute();
            $userInfoList[] = $stmt->fetch(PDO::FETCH_ASSOC);
        }

    } catch (PDOException $e) {
        echo "DBアクセス時にエラーが発生しました。";
        echo $e->getMessage();
    }

    return $userInfoList;
}


    function getById($id) {
    
    if(empty($id)) {
      exit('IDが不正です。');
    }

    $dbh = $this->dbConnect();

    $sql = "SELECT * From $this->table_name Where id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$result) {
      exit('ユーザー情報はありません。');
    }

    return $result;
  }

public function userInfoUpdate(array $userInfos) : int {
  $sql = "UPDATE $this->table_name SET
            name = :name, kana = :kana, tel = :tel, email = :email, inquiry = :inquiry
          WHERE
            id = :id";

  $dbh = $this->dbConnect();
  $dbh->beginTransaction();
  $totalUpdatedRecords = 0;

  try {
      $stmt = $dbh->prepare($sql);
      
      foreach ($userInfos as $userInfo) {

          // 空白を除去 電話番号は3桁-4桁-4桁の形式へ変換
          $userInfo = $this->trimAndConvert($userInfo);
          
          $stmt->bindValue(':name', $userInfo['name'], PDO::PARAM_STR);
          $stmt->bindValue(':kana', $userInfo['kana'], PDO::PARAM_STR);
          $stmt->bindValue(':tel', $userInfo['tel'], PDO::PARAM_INT);
          $stmt->bindValue(':email', $userInfo['email'], PDO::PARAM_STR);
          $stmt->bindValue(':inquiry', $userInfo['inquiry'], PDO::PARAM_STR);
          $stmt->bindValue(':id', $userInfo['id'], PDO::PARAM_INT);
          $stmt->execute();
          $totalUpdatedRecords += $stmt->rowCount();
      }

      $dbh->commit();
  } catch(PDOException $e) {
      $dbh->rollBack();
      exit($e);
  }
  
  return $totalUpdatedRecords;
}


  public function userInfoDelete($id) {
    if(empty($id)) {
      exit('IDが不正です。');
    }

    $dbh = $this->dbConnect();

    $sql = "DELETE FROM $this->table_name WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

    $stmt->execute();
  }

  public function insertToDB(array $userData) : int {

    // 空白を除去 電話番号は3桁-4桁-4桁の形式へ変換
    $userData = $this->trimAndConvert($userData);

    $sql = "INSERT INTO 
              $this->table_name (name, kana, tel, email, inquiry)
            VALUES
              (:name, :kana, :tel, :email, :inquiry)";
    
    $dbh = $this->dbConnect();
    $dbh->beginTransaction();

    $deletedRowCount = 0;
    try {
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':name',  $userData['name'], PDO::PARAM_STR);
      $stmt->bindValue(':kana',  $userData['kana'], PDO::PARAM_STR);
      $stmt->bindValue(':tel',   $userData['tel'], PDO::PARAM_STR);
      $stmt->bindValue(':email', $userData['email'], PDO::PARAM_STR);
      $stmt->bindValue(':inquiry',  $userData['inquiry'], PDO::PARAM_STR);
      $stmt->execute();
      $deletedRowCount = $stmt->rowCount(); 
      $dbh->commit();
    }catch(PDOException $e) {
      $dbh->rollBack();
      exit($e);
    }
    return $deletedRowCount;
  }

  private function trimAndConvert(array $userData): array {
    // 前後の全角半角空白を除去
    $userData['name'] = preg_replace('/^[[:space:]]+|[[:space:]]+$/u', '', $userData['name']);
    $userData['kana'] = preg_replace('/^[[:space:]]+|[[:space:]]+$/u', '', $userData['kana']);
    $userData['tel'] = preg_replace('/^[[:space:]]+|[[:space:]]+$/u', '', $userData['tel']);
    $userData['email'] = preg_replace('/^[[:space:]]+|[[:space:]]+$/u', '', $userData['email']);
    
    //3桁-4桁-4桁の形式へ変換
    $userData['tel'] = $this->convertToPhoneNumberFormat($userData['tel']);
    
    return $userData;
}


  private function convertToPhoneNumberFormat(string $phoneNumber) : string {
    // 正規表現パターン:3桁-4桁-4桁
    $pattern = "/^\d{3}-\d{4}-\d{4}$/";

    // 入力された文字列が指定された形式にマッチするかどうか確認
    if (!preg_match($pattern, $phoneNumber)) {
        // マッチしない場合、3桁-4桁-4桁の形式に変換
        // 数字以外の文字を削除
        $phoneNumber = preg_replace("/[^0-9]/", "", $phoneNumber);
        
        // 電話番号を3桁-4桁-4桁の形式に変換
        $phoneNumber = substr($phoneNumber, 0, 3) . '-' . substr($phoneNumber, 3, 4) . '-' . substr($phoneNumber, 7);
    }
    
    return $phoneNumber;
  }



  }
?>