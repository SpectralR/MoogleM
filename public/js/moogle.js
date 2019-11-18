/**
 * slick slider
 */
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

/**
 * logout form
 */
$('#logout-button').click(function(event){
    event.preventDefault();
    document.getElementById('logout-form').submit();
})

/**
 * AJAX calls
 */
function ajax(method, url){
    var ajaxCall = new XMLHttpRequest();
    ajaxCall.open(method, url);
    ajaxCall.send();
}

/**
 * delete message
 */
let dels = Array.from(document.getElementsByClassName('delete-btn'));

dels.forEach(function(del){
    del.addEventListener('click', function(){
        if (confirm("Are you sure?")){
            var urlDel = del.dataset.url;
            var url = del.dataset.target;
            ajax('GET', urlDel);
            alert('Message deleted');
            window.location.assign(url)
        }
    })
})
