$(document).ready(function () {
    $('.slicked').slick({
        autoplay: false,
        dots: false,
        arrows: false,
        centerMode: true,
        slidesToShow: 2,
        responsive: [{
            breakpoint: 768,
            settings: {
                centerMode: true,
                slidesToShow: 1
            }
        }]

    })
})
