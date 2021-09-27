$(() => {
    /*****************************  INDEX SWIPERS  *****************************/

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



    /*****************************  DETAILS SWIPER  *****************************/

    const swiperSlide = $('.swiper-slide');
    let galleryThumbs = new Swiper('.details-swiper', {
        spaceBetween: 10,
        slidesPerView: 3,
        freeMode: true,
        loopedSlides: 3, //looped slides should be the same
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
    });
    let galleryTop = new Swiper('.details-swiper-2', {
        spaceBetween: 10,
        loop: true,
        loopedSlides: 3, //looped slides should be the same
        grabCursor: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: true,
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
        on: {
            init: function (sw) {
                if(sw.activeIndex === 1) {
                    this.autoplay = false;
                }
            },
        },
    });

    swiperSlide.on('mouseover', function() {
        galleryTop.autoplay.stop();
    });

    swiperSlide.on('mouseout', function() {
        galleryTop.autoplay.start();
    });

    let galleryTopImage = $('.gallery-top .swiper-slide');
    galleryTopImage.on('mousemove', function(event) {
        let width = $(this).width();
        let height = $(this).height();
        let mouseX = event.offsetX;
        let mouseY = event.offsetY;

        let bgPosX = mouseX / width * 100;
        let bgPosY = mouseY / height * 100;

        $(this).css('background-position', `${bgPosX}% ${bgPosY}%`);
    });
    galleryTopImage.on('mouseleave', function () {
        $(this).css('background-position', `center`);
    })
})
