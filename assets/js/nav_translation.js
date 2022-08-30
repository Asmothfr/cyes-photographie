window.addEventListener("DOMContentLoaded", () => {
    
    let url = document.location.href;
    let baseUrl = url.includes("cyes-photographie/654381dfhgf1871t2gdf03");
   
    function homeFrontOffice(){
        let urlEnd = url.substring (url.lastIndexOf( "/" )+1);
        const isHome = urlEnd === "index.php?route=home"
        console.log(isHome)
        const title = document.querySelector(".nav__title");
        title.classList.toggle("nav__title--home", isHome)
        title.classList.toggle("nav__title--page", !isHome)
    }
    function homeBackOffice()
    {
        let urlEnd = url.substring (url.lastIndexOf( "/" )+1);
        const isHome = urlEnd === "index.php?route=home"
        const title = document.querySelector(".nav__title-admin");
        const nav = document.querySelector(".nav__list");
        nav.classList.toggle("nav__list--homeAdmin", isHome)
        title.classList.toggle("nav__title-admin--home", isHome)
        title.classList.toggle("nav__title--page", !isHome)
    }
    if(baseUrl)
    {
        homeBackOffice()
    }
    else
    {
        homeFrontOffice()
    }
});
