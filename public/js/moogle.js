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
    return Promise.resolve($.ajax({
        url: url,
        method: method,
    }));

}

/**
 * delete message
 */
let dels = Array.from(document.getElementsByClassName('delete-btn'));

dels.forEach(function(del){
    del.addEventListener('click', function(){
        if (confirm("Are you sure?")){
            let urlDel = del.dataset.url;
            let idMsg = del.dataset.id;
            let result = ajax('GET', urlDel);
            alert('Message deleted');
            result.then(data => {
                if (data === '1'){
                    let section = document.getElementById(idMsg);
                    section.remove(section);
                } else{
                    let url = del.dataset.target;
                    window.location.assign(url);
                }
            },
                    error => console.log(error));
        }
    })
});
