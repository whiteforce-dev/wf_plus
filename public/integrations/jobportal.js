window.addEventListener(`scroll`,function() {
    let nav = document.getElementById("navbar")
    if (window.scrollY > 5)
         nav.classList.add("white-bg")
    
    else 
    nav.classList.remove("white-bg");
    
})
window.addEventListener(`scroll`,function() {
    let temp = document.getElementById("navbar-t")
    if (window.scrollY > 5)
         temp.classList.add("white-bg")
    
    else 
    temp.classList.remove("white-bg");
    
})

function readmore () {
    document.getElementById("read").outerHTML=`<span></span>`
} 

// window.addEventListener(`scroll`,function() {
//   let nav = document.getElementById("header-top")
//   if (window.scrollY > 5)
//        nav.classList.add("top-bg")
  
//   else 
//   nav.classList.remove("top-bg");
  
// })




  let mode = window.localStorage.getItem('mode'),
      root = document.getElementsByTagName('html')[0];
  if (mode !== null && mode === 'dark') {
    root.classList.add('dark-mode');
  } else {
    root.classList.remove('dark-mode');
  }


// <!-- Page loading scripts -->

  (function () {
    window.onload = function () {
      const preloader = document.querySelector('.page-loading');
      preloader.classList.remove('active');
      setTimeout(function () {
        preloader.remove();
      }, 1000);
    };
  })();


// <!-- Google Tag Manager -->


gsap.fromTo('.displacement', {
  r: 0,
}, {
  r: 300,
  repeat: -1,
  duration: 6,
  ease: 'power3.inOut',
  yoyo: true
})