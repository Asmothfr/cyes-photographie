window.addEventListener("DOMContentLoaded", () => {
    
    let url = document.location.href;
    let baseUrl = url.includes("cyes-photographie/654381dfhgf1871t2gdf03");
   
    function homeFrontOffice()
    {
        let urlEnd = url.substring (url.lastIndexOf( "/" )+1);
        const title = document.querySelector(".nav__title");
        switch(urlEnd)
        {
            case "home":
                title.classList.toggle("nav__title--page")
                break
            case "":
                title.classList.toggle("nav__title--page")
                break
            default:
                title.classList.toggle("nav__title--home")
                break
        }
    }
    function homeBackOffice()
    {
        let urlEnd = url.substring (url.lastIndexOf( "/" )+1);
        console.log(urlEnd)
        const title = document.querySelector(".nav__title-admin");
        const nav = document.querySelector(".nav__list");
        switch(urlEnd)
        {
            case "home":
                title.classList.toggle("nav__title--page")
                break
            case "":
                title.classList.toggle("nav__title--page")
                break
            default:
                nav.classList.toggle("nav__list--homeAdmin")
                title.classList.toggle("nav__title-admin--home")
                break
        }
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
