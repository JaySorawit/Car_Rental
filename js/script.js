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
  
    // // Add event listener to document object
    // document.addEventListener('click', function(e) {
    //   // Check if clicked element is outside of navbar
    //   if (!myMenu.contains(e.target) && !mylogin.contains(e.target)) {
    //     // Reset navbar classes and hamburger icon
    //     myMenu.style.display = 'none';
    //     mylogin.style.display = 'none';
    //     x.classList.remove('change');
    //   }
    // });
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
    
    // document.addEventListener("click", function(e) {
    //     const clickInsideMenu = toggleMenu.contains(e.target);

    //     if (!clickInsideMenu && toggleMenu.classList.contains("active")) {
    //             toggleMenu.className += ' menu';
    //     }
    // });
  }
  

  