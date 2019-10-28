$(document).ready(function () {
    console.log('hello');
    $('.slicked').slick({
        autoplay: true,
        dots: true,
        arrows: false,
        respondTo: 'min',
        slidesToShow: 2
    })
})
