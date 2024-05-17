document.addEventListener('DOMContentLoaded', function() {

  submit.addEventListener('click', function() {
    const errorMessages = [];


    const required = document.getElementsByClassName('required');
    let countReq = 0;
  
    for (let i = 0; i < required.length; i++) {
      const requires = required[i];
      
      if (requires.value === "") {
        countReq++;
      }
    }

    if (countReq > 0) {
      errorMessages.push('*は必須項目です。');
    }

    const nameElems =  document.querySelectorAll('.name');

    for(let i = 0; i < nameElems.length; i++){
      const nameElem = nameElems[i];
      const namelength = nameElem.dataset.maxlength;
  
      if(nameElem.value.length > namelength) {
        errorMessages.push('名前は' + namelength + '文字以内でご入力ください'); 
      }
    }

    const kanaElems =  document.querySelectorAll('.kana');

    for(let i = 0; i < kanaElems.length; i++){
      const kanaElem = kanaElems[i];
      const kanalength = kanaElem.dataset.maxlength;
  
      if(kanaElem.value.length > kanalength) {
        errorMessages.push('カナは' + kanalength + '文字以内でご入力ください'); 
      }
    }

    const emailElems = document.querySelectorAll('.email');
    const patternEmail = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ui;
    
    for (let i = 0; i < emailElems.length; i++) {
      const emailElem = emailElems[i];
      
      if(emailElem.value !== '') {
        if (!patternEmail.test(emailElem.value)) {
          errorMessages.push('メールアドレスは正しくでご入力ください。'); 
        }
      }
    }

    const telElems = document.querySelectorAll('.tel');
    const patternTel = /^\(?\d{2,5}\)?[-(\.\s]{0,2}\d{1,4}[-)\.\s]{0,2}\d{3,4}$/;
    
    for (let i = 0; i < telElems.length; i++) {
      const telElem = telElems[i];
      
      if(telElem.value !== '') {
        if (!patternTel.test(telElem.value)) {
          errorMessages.push('電話番号は0-9の数字のみでご入力ください。'); 
        }
      }
    }

    if(errorMessages.length > 0) {
      window.alert(errorMessages.join('\n'));
    }

  });

}, false);
