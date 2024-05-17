//modal-window
'use strict';

document.addEventListener('DOMContentLoaded', function(){

  const modalBack     = document.querySelector('.modal-back');
  const modal         = document.querySelector('.modal');
  const auth          = document.querySelector('.auth__text');
  const menuItems     = document.querySelectorAll('.menu__item');
  const authHumberger = menuItems[0];
  const humbergerAuth = document.querySelectorAll('.menu__item')[0];
  
  auth.addEventListener('click', function(e) {
    e.preventDefault();
    modalBack.classList.add('open');
    modal.classList.add('open');
  },false)
  
  authHumberger.addEventListener('click', function(e) {
    e.preventDefault();
    modalBack.classList.add('open');
    modal.classList.add('open');
  },false)
  
  modalBack.addEventListener('click', function(event) {
   if(event.target.closest(".modal") === null) {
    modalBack.classList.remove('open');
    modal.classList.remove('open');
    modal.classList.remove('fade-up');
   }
  }, false);
  
  
  auth.addEventListener('click', function() {
    modal.classList.add('fade-up');
  },false)
  
  humbergerAuth.addEventListener('click', function() {
    modal.classList.toggle('fade-up');
  }, false);
  
  }, false);