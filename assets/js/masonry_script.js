const masonryInit = ()=>{
    $grid = $('.grid').imagesLoaded( function() {
        $('.grid').masonry({
            itemSelector: '.grid-item',
        })
    })
}

export {
    masonryInit
}