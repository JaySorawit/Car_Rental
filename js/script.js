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
    let mylogin = document.getElementById('mylogin');

    if (window.innerWidth > 700) {
        myMenu.className = 'nav-menu';
        mylogin.className = 'nav-login';
    } 
});

window.dispatchEvent(new Event('resize'));

function menuToggle() {
    const toggleMenu = document.querySelector(".menu");
    toggleMenu.classList.toggle("active");
  }