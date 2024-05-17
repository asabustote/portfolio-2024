<?php
//データをcontactテーブルへインサートする際に入力値をチェックするクラス
class ValidateForInsert {
  private array $errMsgs = [];



  //入力された文字列が8文字以上かつ数字を1文字でも含んでいるかを確認するメソッド
  public function validateRegistration(array $inputedData) : array {
    //メールアドレスをチェックする
    $errMsgEmail= $this->validateEmailAddress($inputedData['email']);
    $this->errMsgs['mail'] = $errMsgEmail;

    //パスワードをチェックする
    $errMsgPassWord = $this->validatePassWord($inputedData['passWord']);
    $this->errMsgs['passWord'] =$errMsgPassWord;

    return $this->errMsgs;
  }


  //入力された文字列が8文字以上かつ数字を1文字でも含んでいるかを確認するメソッド
  private function validatePassWord(String $passWord) : String {
    $errMsgPassWord = "";
    
    
    //8文字未満かつ数字が1つも含まれていない場合
    if (strlen($passWord) < 8 &&
    !preg_match("/\d/", $passWord)) {
      $errMsgPassWord = "※パスワードは8文字以上で少なくとも1つの数字を含めてください。";
    }else
    // 8文字未満の場合はエラーメッセージを追加
    if (strlen($passWord) < 8) {
        $errMsgPassWord = "※パスワードは8文字以上で入力してください。";
    }else 
    
    // 数字が1つも含まれない場合はエラーメッセージを追加
    if (!preg_match("/\d/", $passWord)) {
        $errMsgPassWord = "※パスワードには少なくとも1つの数字を含めてください。";
    }
    
    return $errMsgPassWord;
  }

  //入力された配列情報を確認し、入力に不備があればエラーメッセージを返すメソッド
  public function validateInputedData(array $inputedData) : array {
    //氏名の入力情報をチェックする
    $errMsgName = $this->validateName($inputedData['name']);    
    $this->errMsgs['name'] = $errMsgName;

    //カナの入力情報をチェックする
    $errMsgKana = $this->validateKana($inputedData['kana']);
    $this->errMsgs['kana'] = $errMsgKana;

    //電話番号の入力情報を確認する
    $errMsgTel = $this->validatePhoneNumber($inputedData['tel']);
    $this->errMsgs['tel'] = $errMsgTel;

    //メールアドレスの入力情報をチェックする
    $errMsgEmail= $this->validateEmailAddress($inputedData['email']);
    $this->errMsgs['email'] = $errMsgEmail;

    //問い合わせ内容の情報をチェックする
    $errMsgInquiry = $this->validateInquiry($inputedData['inquiry']);
    $this->errMsgs['inquiry'] = $errMsgInquiry;

    return $this->errMsgs;
  }


  private function validateName(string $name) : String{
    $errMsgName = "";
    //空文字が入力されていないかチェック
    if($this->isEmptyString($name)) {
      $errMsgName = "氏名は入力必須項目です。";
    }
    //10文字以上の入力であればエラーメッセージを格納
    if($this->isOver10Length($name)) {
      $errMsgName = "氏名の文字数が10文字を超えています。";
    }
    return $errMsgName;
  }

  //未入力（””:空文字）であるかを確認する
  //param: string ""  → return: true
  //param: string "a" → return: false
  private function isEmptyString (string $value) : bool {
    $result = false;
   if ("" === $value) {
       $result = true;
   }
   return $result;
  }

  //文字列が10文字で入力されているかを判定するメソッド
  //param:10文字以上  → return:true 
  //param:10文字以内  → return:false
  private function isOver10Length(string $name) : bool {
    $result = false;
    // 全角・半角スペースを削除
    $name = preg_replace('/[\p{Z}\s]+/u', '', $name);
    // 文字数が10文字を超えるかどうかを判定
    if (mb_strlen($name) > 10) {
     $result = true;
    } else {
     $result = false;
   }
   return $result;
  }

    //文字列が10文字で入力されているかを判定するメソッド
  //param:8文字以上  → return:true 
  //param:8文字以内  → return:false
  private function isOver8Length(string $name) : bool {
    $result = false;
    // 全角・半角スペースを削除
    $name = preg_replace('/[\p{Z}\s]+/u', '', $name);
    // 文字数が10文字を超えるかどうかを判定
    if (mb_strlen($name) > 8) {
     $result = true;
    } else {
     $result = false;
   }
   return $result;
  }

  //入力値カナをチェックするメソッド。
  //param:エラーがある → return:任意のエラーメッセ時を持つ配列
  //param:エラーがない → return:空の配列
  public function validateKana(string $kana) : String {
    $errMsgKana = "";
    //空文字が入力されていないかチェック
    if($this->isEmptyString($kana)) {
      $errMsgKana = "フリガナは入力必須項目です。";
    }

    //10文字以上のカタカナの入力の場合、エラーメッセージを格納
    //条件:入力値がカタカナである。かつ文字数が10文字以上
    if($this->isKanaFormat($kana) &&
        $this->isOver10Length($kana)) {
      $errMsgKana = "フリガナの文字数が10文字を超えています。";
    }

    //10文字以内のカタカナでない文字の場合、エラーメッセージを格納
    //条件:入力値がカタカナでない。かつ文字数が10文字以内
    if(!$this->isKanaFormat($kana) &&
       !$this->isOver10Length($kana)) {
      $errMsgKana = "フリガナにはカタカナを入力して下さい。";
    }

    //10文字以上のカタカナでない文字の場合エラーメッセージを格納
    //条件:入力値がカタカタでない、10文字以上
    if(!$this->isKanaFormat($kana) &&
        $this->isOver10Length($kana)) {
      $errMsgKana = "10文字以内のカタカナを入力して下さい。";
    }


    return $errMsgKana;
  }

  private function isKanaFormat(string $kana) : bool {
    $result = false;
    // 全角・半角スペースを削除
    $kana = mb_ereg_replace('[\p{Z}\s]+', '', $kana);
    if (preg_match('/\A[\p{Katakana}\s]+\z/u', $kana)) {
     $result = true;
    }
    return $result;
  }

  //入力値telをチェックするメソッド。
  //param:エラーがある → return:任意のエラーメッセジを持つ配列
  //param:エラーがない → return:空の配列
  public function validatePhoneNumber (string $tel) : String {
    $errMsgTel = "";
    //空白、ハイフンを除く11桁の数字が渡ってきているか
    
    //条件:11桁以上の数字が入力されている場合は、エラーメッセージを持つ配列を生成
    //未入力は許容する
    if(!"" === $tel && 
       !$this->is11Digits($tel)) {
      $errMsgTel = "電話番号には11桁の数字を使用して下さい。";
    }

    return $errMsgTel;
  }

  //電話番号が3桁-4桁-4桁でなければ11桁の数値か確認。11桁の数値でなければエラーメッセージを返す
  //true(問題なし)かfalse(問題あり)を返す
  private function is11Digits($phoneNumber) {
    $result = false;
    // 全角・半角スペースを削除
    $phoneNumber = preg_replace('/[\p{Z}\s]+/u', '', $phoneNumber);
    if ($this->isPhoneNumberFormat($phoneNumber)) {
      // ハイフンを除く数字のみを抽出
      $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
    }

    // 電話番号の桁数が11桁かどうかを判定
    if (strlen($phoneNumber) === 11) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

  //3桁-4桁-4桁か確認する
  private function isPhoneNumberFormat(string $phoneNumber) : bool {
    $result = false;
    // 正規表現パターン:3桁-4桁-4桁
    $pattern = "/^\d{3}-\d{4}-\d{4}$/";

    if (preg_match($pattern, $phoneNumber)) {
        $result = true; 
    } 
    return $result;
  }

  //emailアドレスがuser@example.comの形式でなければエラーメッセージを格納するメソッド
  private function validateEmailAddress(string $email) : String {
    $errMsgEmail = "";

    //未入力でないか確認
    if ($this->isEmptyString($email)) {
      $errMsgEmail = "メールアドレスは入力必須項目です。";
    }

    //形式(@domain.)に合わなければエラーメッセージを格納
    if (!$this->isEmailAddressFormat($email)) {
      $errMsgEmail = "$email は無効なメールアドレスです。user@example.comの形式で入力して下さい。";
    }

    return $errMsgEmail;
  }

  private function isEmailAddressFormat(string $email) : bool {
    $result = false;
    // 全角・半角スペースを削除
    $email = mb_ereg_replace('[\p{Z}\s]+', '', $email);
    // メールアドレスのバリデーション
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $result = true;
    }
  
    return  $result;
  }

  private function validateInquiry(string $inquiry) : String {
    $errMsgInquiry = "";

    if($this->isEmptyString($inquiry)) {
      $errMsgInquiry = '問い合わせ内容は必須項目です。';
    }

    return $errMsgInquiry;
  }

}
?>