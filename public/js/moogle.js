$(document).ready(function () {
    $('.slicked').slick({
        autoplay: true,
        dots: true,
        arrows: false,
        respondTo: 'min',
        slidesToShow: 2,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1
            }
        }]

    })
})
