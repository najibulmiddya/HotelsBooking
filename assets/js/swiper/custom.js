
// uses index page
var swiper = new Swiper(".mySwiper", {
    spaceBetween: 30,
    effect: "fade",
    loop: true,
    autoplay: {
        delay: 2500, disableOnInteraction: false,
    }
});
// uses index page
var swiper = new Swiper(".testimonials", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    slidesPerView: "3",
    loop: true,
    coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
    },
    pagination: {
        el: ".swiper-pagination",
    },
    breakpoints: {
        320: {
            slidesPerView: 1,
        },
        640: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    },
});
// use about page
var swiper = new Swiper(".MANAGEMENT-TEAMS", {
    slidesPerView: 4,
    spaceBetween: 40,
    pagination: {
        el: ".swiper-pagination",
    },
    breakpoints: {
        320: {
            slidesPerView: 1,
        },
        640: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    },
});

$(document).ready(function () {
    $('#js-alert').hide();

    // js bs alert
    function js_alert(status, message) {
        if (status == true) {
            status = "success";
            mes_type = "Successfully !"
        } else {
            status = "danger";
            mes_type = "Failed !";
        }
        if (status == 'error') {
            mes_type = "Error !"
        }
        $('#mes-type').text(mes_type);
        $('#ja-message').text(message);
        $('#js-alert').show();
    }
});