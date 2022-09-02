window.addEventListener("DOMContentLoaded", () => {

    jQuery(function($){
        let portfolio = $(".grid")
        portfolio.masonry({
            itemSelector:".grid-item"
        })
    })
});
