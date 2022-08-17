window.addEventListener("DOMContentLoaded", () => {
    
    const title = document.querySelector(".nav__title");
    let url = document.location.href;
    let urlEnd = url.substring (url.lastIndexOf( "/" )+1 );
    
    const isHome = urlEnd === "index.php?route=home"
    title.classList.toggle("nav__title--home", isHome)
    title.classList.toggle("nav__title--page", !isHome)
});
