function toggleHam(x) {
  x.classList.toggle("change");
  let myMenu = document.getElementById('myMenu');
  let mylogin = document.getElementById('mylogin');

  if(myMenu.className === 'nav-menu') {
    myMenu.className += ' nav-menu-active';
  } 
  else{
    myMenu.className = 'nav-menu';
  }

  if(mylogin.className === 'nav-login') {
    mylogin.className += ' nav-login-active';
  } 
  else{
    mylogin.className = 'nav-login';
  }
}
  
window.addEventListener('resize', function() {
    let myMenu = document.getElementById('myMenu');
    // let mylogin = document.getElementById('mylogin');

    if (window.innerWidth > 700) {
        myMenu.className = 'nav-menu';
        // mylogin.className = 'nav-login';
    } 
});

// window.dispatchEvent(new Event('resize'));

function menuToggle() {
    const toggleMenu = document.querySelector(".menu");
    toggleMenu.classList.toggle("active");
  }

// document.addEventListener('DOMContentLoaded', function() {
// const editButton = document.getElementById('edit-button');
// const profileForm = document.querySelector('.profile-form');

// editButton.addEventListener('click', function() {
//     profileForm.classList.toggle('disabled');
// });
// });

function editToggle(btn) {
  const toggleMenu = document.querySelector(".profile-form");
  toggleMenu.classList.toggle("active");

  let myPass = document.getElementById('myPass');
  let mydate = document.getElementById('myDate');
  let myDrive = document.getElementById('myDrive');
  let mylessor = document.getElementById('mylessor');

  const myPassElements = document.querySelectorAll('.myPass');
  myPassElements.forEach(function(myPass) {
    myPass.classList.toggle('myPass-active');
  });

  if(mydate.className === 'inputboxdate') {
    mydate.className += ' inputboxdate-active';
  } 
  else{
    mydate.className = 'inputboxdate';
  }

  if(myDrive.className === 'inputboxhide') {
    myDrive.className += ' inputboxhide-active';
  } 
  else{
    myDrive.className = 'inputboxhide';
  }

  if(mylessor.className === 'inputboxhide') {
    mylessor.className += ' inputboxhide-active';
  } 
  else{
    mylessor.className = 'inputboxhide';
  }
  
  if (myPass.classList.contains('myPass-active')) {
    myPass.classList.remove('myPass-active');
    btn.textContent = 'Edit';
    window.location.replace('ProfileForm.php');
  } else {
    myPass.classList.add('myPass-active');
    btn.textContent = 'Back';
  }
}

// const form = document.querySelector('form');
// form.addEventListener('submit', function(event) {
//   const input = document.querySelector('#fname');
//   if (input.value === '') {
//     input.value = input.getAttribute('placeholder');
//   }
// });