'use strict';
document.addEventListener('DOMContentLoaded', function() {

  window.addEventListener('scroll', function() {

    const btn = document.querySelector('.btn');
    const btnTop = btn.getBoundingClientRect().top;
    const isScrolled = window.scrollY; //原点から垂直方向にスクロールした量
    const location = this.document.querySelector('.location').getBoundingClientRect().top;
  //スクロール量が指定要素を過ぎたら指定要素へクラス付与
          if(isScrolled > location) {
            btn.classList.add('btn-fadeUp');
          }else {
            btn.classList.remove('btn-fadeUp');
          }

    const headerInner = document.querySelector('.header__inner');
    const headerInnerBottom = document.querySelector('.header__inner').getBoundingClientRect().bottom;

    console.log(headerInnerBottom);

    if (isScrolled > headerInnerBottom) {
      headerInner.classList.add('header__inner-fadeDown');
    } else {
      headerInner.classList.remove('header__inner-fadeDown');
    }

  }, false);

}, false);