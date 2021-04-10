$(() => {
    /*****************************  Alert Message  *****************************/
    const $alert = $('#global_alert');
    const timeOut = (duration) => {
        duration *= 1000;
        setTimeout(() => {
            $alert.addClass('hide');
            $alert.removeClass('show');
        }, duration);
    }

    if($alert.length !== 0 && $alert.hasClass('show')) {
        timeOut($alert.data('duration'));
    }



    /*****************************  Header Jumbo SideNav  *****************************/

    const menu = $('#mega_nav .menu');
    const menuMain = $("#mega_nav .menu .menu_main");
    const goBack = $(".mobile_menu_head > .go_back");
    const menuTrigger = $('#mega_nav .mobile_menu_trigger');
    const closeMenu = $('#mega_nav .mobile_menu_head .mobile_menu_close');

    let subMenu;

    $(document).on('click', menuMain, (element) => {
        $('#mega_nav .current_menu_title').html("Su-F").css('padding-left', '1rem');
        if(!menu.hasClass('active')) {
            return;
        }

        if(element.target.closest('.menu_item_has_children')) {
            const hasChildren = element.target.closest('.menu_item_has_children');

            showSubMenu(hasChildren);
        }
    });

    $(menuTrigger).click(() => {
        toggleMenu();
    });
    $(goBack).click(() => {
        hideSubMenu();
    });
    $(closeMenu).click(() => {
        toggleMenu();
    });

    $('#mega_nav .menu_overlay').click(() => {
        toggleMenu();
    });

    let toggleMenu = (() => {
        menu.toggleClass('active');
        $('#mega_nav .menu_overlay').toggleClass('active');
    })

    let showSubMenu = (hasChildren) => {
        subMenu = hasChildren.querySelector('.sub_menu');
        subMenu.classList.add('active');
        subMenu.style.animation = 'slide_left .5s ease forwards';

        const menuTitle = hasChildren.querySelector('span').parentNode.childNodes[0].textContent;

        $('#mega_nav .current_menu_title').html(menuTitle).css('padding-left', 0);
        $('#mega_nav .mobile_menu_head').addClass('active');
    }

    let hideSubMenu = () => {
        subMenu.style.animation = 'slide_right .5s ease forwards';

        $('#mega_nav .current_menu_title').html("Su-F");
        $('#mega_nav .mobile_menu_head').removeClass('active');
    };

    $(function(){
        let path = window.location.href;

        $('#mega_nav ul li a').each(function() {
            if($(this).prop('href') === path) {
                $(this).addClass('active');
            }
        });
    });

    window.onresize = () => {
        if(window.innerWidth > 991.98) {
            $('#mega_nav .nav_link.products').attr('href', '../../products.php');

            if($('#mega_nav .menu').hasClass('active')) {
                toggleMenu();
            }
        } else {
            $('#mega_nav .nav_link.products').attr('href', '#');
        }
    }

    if(window.innerWidth > 991.98) {
        $('#mega_nav .nav_link.products').attr('href', '/products');
    } else {
        $('#mega_nav .nav_link.products').attr('href', '#');
    }


    $('.item_right form').on('mouseenter mouseleave', function() {
        if($(this).find('input').val() === '') {
            $(this).find('input').toggleClass('active');
        }
    })
    $('.item_right input').blur(function(){
        if($(this).val() === '') {
            $(this).removeClass('active');
        } else if($(this).val() !== '' && !$(this).hasClass('active')) {
            $(this).addClass('active');
        }
    });



    /*****************************  CART PAGE  *****************************/

    $(function(){
        $('#cart td.quantity input[type="number"]').niceNumber({
            autoSize:false,
            buttonDecrement:"<i class='bx bx-minus font-weight-bold'></i>",
            buttonIncrement:"<i class='bx bx-plus font-weight-bold'></i>",
            buttonPosition:'around',     // 'around', 'left', or 'right'

            //  Callback Functions
            onDecrement:false,
            onIncrement:false,
        });
    });



    /*****************************  Contact Info  *****************************/

    $('.info_icon').on('mouseenter', function() {
        $($(this)).parent().next().find('.info_text').css('color', 'rgb(217, 180, 60)');
    }).on( 'mouseleave', function() {
        $($(this)).parent().next().find('.info_text').css('color', 'rgb(184, 134, 11)');
    });
});




/**
 * ---------------------------------------------------------------------------------------------------------------------
 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%    GLOBAL FUNCTIONS
 * ---------------------------------------------------------------------------------------------------------------------
 * */
jQuery.cachedScript = function( url, options ) {
    options = $.extend( options || {}, {
        dataType: "script",
        cache: true,
        url: url
    });

    return jQuery.ajax( options );
};
