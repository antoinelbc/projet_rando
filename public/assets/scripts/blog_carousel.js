let slider = tns({
    container: ".my-slider",
    items: 3,
    controls: false,
    mouseDrag: true,
    "slideBy": 1,
    "nav": false,
    arrowKeys: false,
    autoplay: true,
    responsive: {
        980: {
            items: 3
        },
        640: {
            items: 2
        },
        240: {
            items: 1
        }
    }
})

//Fixes the bug when pressing the right arrow which shifts the window
window.addEventListener("keydown", function(e) {
    if(["ArrowLeft", "ArrowRight"].indexOf(e.code) > -1){
        e.preventDefault();
    }
}, false);