$(() => {
    /*****************************  SWIPER  *****************************/

    const swiper = new Swiper('.product_swiper', {
        slidesPerView: 'auto',
        spaceBetween: 10,
        loop: true,
        loopFillGroupWithBlank: true,
        mousewheel: true,
        autoplay: {
            delay: 7000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            576: {
                loop: false,
                loopFillGroupWithBlank: false,
                slidesPerView: 2,
                spaceBetween: 5
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                spaceBetween: 13,
            }
        }
    });


    let galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView: 3,
        freeMode: true,
        loopedSlides: 3, //looped slides should be the same
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
    });
    let galleryTop = new Swiper('.gallery-top', {
        spaceBetween: 10,
        loop: true,
        loopedSlides: 3, //looped slides should be the same
        grabCursor: true,
        autoplay: {
            delay: 7000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: galleryThumbs,
        },
    });
})
