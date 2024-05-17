<?php
Class Confirm {
  public array $inputedValues = array();

  public function __construct(array $inputedValues) {  
    $this->inputedValues['name']    = $inputedValues['name'];
    $this->inputedValues['kana']    = $inputedValues['kana'];
    $this->inputedValues['tel']     = $inputedValues['tel'];
    $this->inputedValues['email']   = $inputedValues['email'];
    $this->inputedValues['name']    = $inputedValues['name'];
    $this->inputedValues['inquiry'] = $inputedValues['inquiry'];
  }

  public function validateInputedValues() {
    $error_array = array();
    
    $error_array = $this->validatName   ($this->inputedValues['name'], $error_array);
    $error_array = $this->validatKana   ($this->inputedValues['kana'], $error_array);
    $error_array = $this->validateTelNo ($this->inputedValues['tel'], $error_array);
    $error_array = $this->validateEmail ($this->inputedValues['email'], $error_array);
    $error_array = $this->validateInquery($this->inputedValues['inquiry'], $error_array);

    return $error_array;
  }

  private function validatName(String $inputedName, array $error_array) {
    if ($inputedName == "") {
      $error_array['name'] = '*お名前は必須項目です。';
    } else if (preg_match( '/\A[[:^cntrl:]]{1,10}\z/u', $inputedName ) == 0 ) {
      $error_array['name'] = 'お名前は10文字以内でお願いします。';
    }
    return $error_array;
  }

  private function validatKana(String $inputedKana, array $error_array) {
    if ($inputedKana == "") {
      $error_array['kana'] = '*フリガナは必須項目です。';
    } else if ( preg_match( '/\A[[:^cntrl:]]{1,10}\z/u', $inputedKana ) == 0 ) {
      $error_array['kana'] = 'フリガナは10文字以内でお願いします。';
    }
    return $error_array;
  }

  private function validateTelNo($inputedTelNo, array $error_array) {
    if ($inputedTelNo != '' &&
      !preg_match('/\A\(?\d{2,5}\)?[-.\s]?\d{1,4}[-.\s]?\d{3,4}\z/u', $inputedTelNo)) {
      $error_array['tel'] = '*電話番号の形式が正しくありません。';
    }
    return $error_array;
  }
  
  private function validateEmail(String $inputedEmail, array $error_array) {
    if ($inputedEmail == '' ) {
      $error_array['email'] = '*メールアドレスは必須です。';
    } else { //メールアドレスを正規表現でチェック
      $pattern = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/uiD';
      if ( !preg_match( $pattern, $inputedEmail ) ) {
        $error_array['email'] = '*メールアドレスの形式が正しくありません。';
      }
    }
    return $error_array;
  }

  private function validateInquery(String $inputedInquiry, array $error_array) {
    if ($inputedInquiry == '' ) {
      $error_array['inquiry'] = '*お問い合せ内容は必須項目です。';
      //制御文字でないことと文字数をチェック
    } else if (preg_match( '/\A[[:^cntrl:]]{1,100}\z/u', $inputedInquiry ) == 0 ) {
      $error_array['inquiry'] = '*お問い合わせ内容は100文字以内でお願いします。';
    }
    return $error_array;
   }

}
?>