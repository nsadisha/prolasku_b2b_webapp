<script>
;(function ($) {
    'use strict';
    let $document = $(document),
        $body = $('body'),
        $window = $(window),
        $biolife_slide = $('.biolife-carousel'),
        $scroll_items = $('.biolife-cart-info .minicart-block ul.products'),
        $vertical_menu = $('#header .vertical-category-block:not(.always)'),
        $menu_mobile = $('.clone-main-menu'),
        $sticky_object = $('.biolife-sticky-object'),
        $shop_filter = $('#top-functions-area'),
        $biolife_select = $('select:not(.hidden)'),
        $rating_form = $('.comment-form-rating'),
        $accodition = $('.biolife-accodition'),
        $block_tab = $('.biolife-tab-contain'),
        $biolife_countdown = $('.biolife-countdown:not(.on_testing_mode)'),
        $biolife_popup = $('.biolife-popup'),
        $pre_loader = $('#biof-loading'),
        $btn_scroll_top = $('.btn-scroll-top'),
        $biolife_stretch_the_right_background = $('.biolife-stretch-the-right-background'),
        $cat_scrollbar = $('.cat_scrollbar'),
        $brand_scrollbar = $('.brand_scrollbar');

    let typingTimer;

    function IS_JSON(str){
        var IS_JSON_str = true;
        try
        {
            var json = jQuery.parseJSON(str);
        }
        catch(err)
        {
            IS_JSON_str = false;
        }    
    }

    /*Create Mobile Menu*/
    if ($menu_mobile.length) {
        $menu_mobile.biolife_menu_mobile();
    }

    /*Register Quickview Box*/
    if ($('#biolife-quickview-block').length) {
        $document.on('click', '.btn_call_quickview', function (e) {
            e.preventDefault();
            $('body').trigger('open-overlay', ['open-quickview-block']);
            $('#biolife-quickview-block-popup').modal('show');
        })
    }

    /*Register Select Element*/
    if ($biolife_select.length) {
        $biolife_select.niceSelect()
    }

    /*Minicart Scroll handle*/
    if ($scroll_items.length) {
        $scroll_items.niceScroll();
    }
    /*cat_scrollbar Scroll handle*/
    if ($cat_scrollbar.length) {
        $cat_scrollbar.niceScroll();
    }

    /*brand_scrollbar Scroll handle*/
    if ($brand_scrollbar.length) {
        $brand_scrollbar.niceScroll();
    }

    /*Carousel Handle*/
    if ($biolife_slide.length) {
        $biolife_slide.biolife_init_carousel();
    }

    /*Vertical Menu Handle*/
    if ($vertical_menu.length) {
        $vertical_menu.biolife_vertical_menu();
    }

    /*Toggle shop filter on mobile*/
    if ($shop_filter.length) {
        $shop_filter.on('click', 'a.icon-for-mobile', function (e) {
            e.preventDefault();
            $body.trigger('open-overlay', ['top-refine-opened']);
        });
    }

    /*Header Sticky*/
    if ($sticky_object.length) {
        $sticky_object.biolife_sticky_header();
    }

    /*Tab button*/
    if ($block_tab.length) {
        $block_tab.biolife_tab();
    }

    /*Rating on single product*/
    if ($rating_form.length) {
        $rating_form.biolife_rating_form_handle();
    }

    /*Accodition menu*/
    if ($accodition.length) {
        $accodition.biolife_accodition_handle();
    }

    /*Countdown*/
    if ($biolife_countdown.length) {
        $biolife_countdown.biolife_countdown();
    }

    /*stretch right background*/
    if ($biolife_stretch_the_right_background.length) {
        $biolife_stretch_the_right_background.biolife_stretch_the_right_background();
        window.onresize = function (event) {
            event.preventDefault();
            $biolife_stretch_the_right_background.biolife_stretch_the_right_background();
        };
    }

    /*Popup*/
    if ($biolife_popup.length) {
        $biolife_popup.modal('show');
    }

    /*Scroll to top*/
    if ($btn_scroll_top.length) {
        $window.on('scroll', function () {
            if ($window.scrollTop() >= 800) {
                $btn_scroll_top.addClass('showUp');
            } else {
                $btn_scroll_top.removeClass('showUp');
            }
        });
        $btn_scroll_top.on('click', function () {
            $('html, body').animate({
                scrollTop: 0
            }, 100);
        });
    }

    /*Events On Document*/
    $document.on('click', '.minicart-item .action .edit', function (e) {
        e.preventDefault();
        let $this = $(this),
            cart_item = $this.closest('.minicart-item'),
            input_field = cart_item.find('.input-qty'),
            curent_val = input_field.val();
        if (!cart_item.hasClass('editing')) {
            cart_item.addClass('editing');
            input_field.removeAttr('disabled').val('');
            input_field.val(curent_val).focus();
        } else {
            cart_item.removeClass('editing');
            input_field.attr('disabled', 'disabled');
        }
    });

    $document.on('click', '#overlay', function (e) {
        e.preventDefault();
        let _this = $(this),
            current_class = _this.attr('data-object'),
            class_list = 'open-overlay';
        if (typeof current_class !== "undefined" && current_class !== '') {
            class_list += ' ' + current_class;
            _this.attr('data-object', '');
        }
        $('body').removeClass(class_list);
    });

    $document.on('click', '.mobile-search .btn-close', function (e) {
        e.preventDefault();
        $('body').removeClass('open-overlay open-mobile-search');
    });

    $document.on('click', '.mobile-search .open-searchbox, .dsktp-open-searchbox', function (e) {
        e.preventDefault();
        $body.trigger('open-overlay', ['open-mobile-search']);
    });

    $document.on('click', '.mobile-footer .btn-toggle, .mobile-menu-toggle .btn-toggle', function (e) {
        e.preventDefault();
        let class_name = $(this).attr('data-object');
        if (typeof class_name !== "undefined") {
            $body.trigger('open-overlay', [class_name]);
        }
    });

    $document.on('click', '.biolife-mobile-panels .biolife-close-btn, .biolife-panels-actions-wrap .biolife-close-btn, .btn-close-quickview', function (e) {
        e.preventDefault();
        let class_name = $(this).attr('data-object');
        if (typeof class_name !== 'undefined') {
            $body.trigger('close-overlay', [class_name]);
        }
    });

    $document.on('click', '.biolife-filter .check-list .check-link', function (e) {
        e.preventDefault();
        let this_item = $(this),
            father = this_item.parent(),
            contain = this_item.closest('ul.check-list');
        if (!contain.hasClass('multiple')) {
            father.siblings().removeClass('selected');
        }
        father.toggleClass('selected');
    });

    $document.on('click', '.biolife-filter .color-list .c-link', function (e) {
        e.preventDefault();
        let father = $(this).parent();
        father.siblings().removeClass('selected');
        father.toggleClass('selected');
    });

    $document.on('click', '.qty-input .qty-btn', function (e) {
        e.preventDefault();
        let btn = $(this),
            input = btn.siblings("input[name^='qty']");
        if (input.length) {
            let current_val = parseInt(input.val(), 10),
                max_val = parseInt(input.data('max_value'), 10),
                step = parseInt(input.data('step'), 10);
            if (btn.hasClass('btn-up')) {
                current_val += step;
                if (current_val <= max_val) {
                    input.val(current_val);
                }
            } else {
                current_val -= step;
                if (current_val > 0) {
                    input.val(current_val);
                }
            }
        }
    });

    /*Events On Body Target*/
    $body.on('update-minicart', function (el, block_minicart) {
        if (block_minicart.find('ul.products li').length === 0) {
            block_minicart.html('<p class="minicart-empty">No product in your cart</p>');
        }
    });

    $body.on('open-overlay', function (e, classes) {
        let addition_classes = 'open-overlay';
        if (classes !== '') {
            addition_classes += ' ' + classes;
            $('#overlay').attr('data-object', classes);
        }
        $body.addClass(addition_classes);
    });

    $body.on('close-overlay', function (e, object) {
        let classes = 'open-overlay';
        if (object !== '') {
            classes += ' ' + object;
            $('#overlay').attr('data-object', '');
        }
        $body.removeClass(classes);
    });

    /*Create overlay Element*/
    $body.append('<div id="overlay"></div>');

    $.fn.biolife_best_equal_products();

    /*preload handle*/
    $window.on('load', function () {
        if ($pre_loader.length) {
            $pre_loader.fadeOut(800);
            setTimeout(function () {
                $pre_loader.remove();
            }, 3000);
        }
    });


    $(document).on('click', '.add_to_cart', function (e) {
        e.preventDefault();
        const form = $(this).closest('form');
        // console.log(form.serialize());
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            dataType: 'json',
            data: form.serialize(),
            success: function (res_data) {
                console.log(res_data);
                // console.log(typeof res_data);
                var returned_data = IS_JSON(res_data) ? jQuery.parseJSON(res_data) : res_data;
                // console.log(returned_data);
                // console.log(typeof returned_data);
                if(typeof returned_data=='object'){
                    if(returned_data.response_type=='success'){
                        load_cart_data();
                        toastr.success("<?=$trans->getTrans('Item has been Added into Cart')?>");
                    }else{
                        toastr.error(returned_data.response_message);
                    }
                }else{
                        toastr.error("<?=$trans->getTrans('somethings wrong')?>");
                }
            },error: function(data) {
                console.log('error:')
                console.log(data.responseText)
                toastr.error("<?=$trans->getTrans('somethings wrong')?>");
            }

        });
    });

    $(document).on('click', '.remove', function () {
        var product_id = $(this).data("id");
        if (confirm("Are you sure you want to remove this product?")) {
            $.ajax({
                url: "cart-remove.php",
                method: "POST",
                data: {id: product_id, __token: 'remove_' + product_id},
                dataType: 'json',
                success: function (res_data) {
                    // console.log(res_data);
                    // console.log(typeof res_data);
                    var returned_data = IS_JSON(res_data) ? jQuery.parseJSON(res_data) : res_data;
                    // console.log(returned_data);
                    // console.log(typeof returned_data);
                    if(typeof returned_data=='object'){
                        if(returned_data.response_type=='success'){
                            load_cart_data();
                            toastr.success("<?=$trans->getTrans('Item has been removed from Cart')?>");
                            if ($('.shop_table').length > 0) {
                                location.reload();
                            }
                        }else{
                            toastr.error(returned_data.response_message);
                        }
                    }else{
                            toastr.error("<?=$trans->getTrans('somethings wrong')?>");
                    }
                },error: function(data) {
                    console.log('error:')
                    console.log(data.responseText)
                    toastr.error("<?=$trans->getTrans('somethings wrong')?>");
                }                

            });
        } else {
            return false;
        }
    });

    $(document).on('click', '.add-item', function (e) {
        e.preventDefault();
        var product_id = $(this).data("id");
        var qty = $(this).closest('.cart_item').find('.qty').val();
        console.log(qty);
        if (confirm("Are you sure you want to remove this product?")) {
            $.ajax({
                url: "cart-add-item.php",
                method: "POST",
                data: {
                    id: product_id,
                    qty: qty,
                    __token: 'add_' + product_id
                },

                dataType: 'json',
                success: function (res_data) {
                    // console.log(res_data);
                    // console.log(typeof res_data);
                    var returned_data = IS_JSON(res_data) ? jQuery.parseJSON(res_data) : res_data;
                    // console.log(returned_data);
                    // console.log(typeof returned_data);
                    if(typeof returned_data=='object'){
                        if(returned_data.response_type=='success'){
                            load_cart_data();
                            toastr.success("<?=$trans->getTrans('Item has been updated')?>");
                            if ($('.shop_table').length > 0) {
                                location.reload();
                            }
                        }else{
                            toastr.error(returned_data.response_message);
                        }
                    }else{
                            toastr.error("<?=$trans->getTrans('somethings wrong')?>");
                    }
                },error: function(data) {
                    console.log('error:')
                    console.log(data.responseText)
                    toastr.error("<?=$trans->getTrans('somethings wrong')?>");
                }       
            })
        } else {
            return false;
        }
    });

    $(document).on('click', '.update-item', function (e) {
        e.preventDefault();
        var product_id = $(this).data("id");
        var qty = $(this).closest('.cart_item').find('.qty').val();
        $.ajax({
            url: "cart-update-item.php",
            method: "POST",
            data: {
                id: product_id,
                qty: qty,
                __token: 'add_' + product_id
            },
            dataType: 'json',
            success: function (res_data) {
                // console.log(res_data);
                // console.log(typeof res_data);
                var returned_data = IS_JSON(res_data) ? jQuery.parseJSON(res_data) : res_data;
                // console.log(returned_data);
                // console.log(typeof returned_data);
                if(typeof returned_data=='object'){
                    if(returned_data.response_type=='success'){
                        load_cart_data();
                        toastr.success("<?=$trans->getTrans('Item has been updated')?>");
                        if ($('.shop_table').length > 0) {
                            location.reload();
                        }
                    }else{
                        toastr.error(returned_data.response_message);
                    }
                }else{
                        toastr.error("<?=$trans->getTrans('somethings wrong')?>");
                }
            },error: function(data) {
                console.log('error:')
                console.log(data.responseText)
                toastr.error("<?=$trans->getTrans('somethings wrong')?>");
            }       
        })
    });

    function load_cart_data() {
        $.ajax({
            url: "cart-update.php",
            method: "POST",
            dataType: "json",
            success: function (data) {
                $('#cart_details').html(data.cart_details);
                $('#total_price').text(data.total_price);
                $('#total_qty').text(data.total_item);
            }
        });
    }

    load_cart_data();

    $('#currency').on('change', function () {
        const currency = $(this).val();
        $.ajax({
            url: "currency-update.php",
            method: "POST",
            data: {currency: currency},
            success: function (data) {
                if (data === 'ok') {
                    location.reload();
                }
            }
        });
    })

    $('#language').on('change', function () {
        const language = $(this).val();
        $.ajax({
            url: "language-update.php",
            method: "POST",
            data: {
                language: language
            },
            success: function (data) {
                if (data === 'ok') {
                    location.reload();
                }
            }
        });
    })

    $('#logout').on('click', function () {
        $.ajax({
            url: "logout.php",
            method: "POST",
            data: {
                logout: 1
            },
            success: function (data) {
                if (data === 'ok') {
                    location.reload();
                }
            }
        });
    })


    let products = $('.products-list');

    if (products.length > 0) {
        let count = 1;
        $('#product-load-more').on('click', function () {
            const search = $('.product-search').val();
            $.ajax({
                type: "POST",
                url: "get-product.php",
                data: {
                    page: count,
                    search: search ?? ''
                },
                success: function (data) {
                    products.append(data);
                    var el = $(".products-list").children().length;
                    if (el < 20) {
                        $('#product-load-more').prop("disabled", true);
                    } else {
                        $('#product-load-more').prop("disabled", false);
                    }
                    count++;
                },
                error: function (req, status, error) {
                    products.append("Error try again");
                }
            });
        })

        $('.filter').on('click', filter)

        $('#filter-form').on('input', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(filter, 1000);
        })
    }

    function filter() {
        const search = $('.product-search').val();

        const catIDs = new Array();

        $('#filter-form .categories .form-check input[name="categories"]:checked').each(function() {
            catIDs.push({
                "0": Number($(this).val())
            });
        });

        const brandIDs = new Array();

        $('#filter-form .brands .form-check input[name="brands"]:checked').each(function() {
            brandIDs.push({
                "0": Number($(this).val())
            });
        });
        
        toggleLoadingScreen();

        $body.trigger('close-overlay', ['open-mobile-filter']);

        $.ajax({
            type: "POST",
            url: "get-product.php",
            data: {
                search: search,
                cats: JSON.stringify(catIDs),
                bids: JSON.stringify(brandIDs),
            },
            success: function (data) {
                products.html(data);
                var el = $(".products-list").children().length;
                if (el < 20) {
                    $('#product-load-more').prop("disabled", true);
                } else {
                    $('#product-load-more').prop("disabled", false);
                }
                // console.log(window.location.pathname)
                change_url(window.location.pathname, true);
            },
            error: function (req, status, error) {
                products.append("Error try again");
            },
            complete: function () {
                toggleLoadingScreen();
            }
        });
    }

    function toggleLoadingScreen() {
        $('.loading-overlay').toggleClass('show');
    }

    $('.is-different-address').on('change', function () {
        let remember = document.querySelector(".is-different-address")
        if (remember.checked) {
            $(".billing-address").show();
            document.getElementById("shipping-address").required = true;
            document.getElementById("shipping-city").required = true;
            document.getElementById("shipping-country").required = true;
            document.getElementById("shipping-postal").required = true;
            document.getElementById("shipping-state").required = true;
            document.getElementById("delivery_contact_person").required = true;
        } else {
            $(".billing-address").hide();
            document.getElementById("shipping-address").required = false;
            document.getElementById("shipping-city").required = false;
            document.getElementById("shipping-country").required = false;
            document.getElementById("shipping-postal").required = false;
            document.getElementById("shipping-state").required = false;
            document.getElementById("delivery_contact_person").required = false;
        }
    });

    function change_url(urlPath, replace){
        if(typeof replace=='undefined'){
            // c(document.title);
            window.history.pushState({page: document.title},document.title, urlPath);
        }else{
            // c(document.title);
            window.history.replaceState({page: document.title},document.title, urlPath);
        }
    }
    function change_url_new(urlPath){
        if ("undefined" !== typeof history.pushState) {
            history.pushState({page: document.title}, document.title, urlPath);
        } else {
            window.location.assign(urlPath);
        }
    }

    $('#tiles-4-btn').on('click', function(e){
        const products = document.querySelector('.products-list');
        products.classList.remove('row-cols-xl-4', 'row-cols-xl-3');
        products.classList.add('row-cols-xl-2');
        
        makeActiveTile('#tiles-4-btn');
    })

    $('#tiles-9-btn').on('click', function(){
        const products = document.querySelector('.products-list');
        products.classList.remove('row-cols-xl-4', 'row-cols-xl-2');
        products.classList.add('row-cols-xl-3');

        makeActiveTile('#tiles-9-btn');
    })

    $('#tiles-16-btn').on('click', function(){
        const products = document.querySelector('.products-list');
        products.classList.remove('row-cols-xl-3', 'row-cols-xl-2');
        products.classList.add('row-cols-xl-4');

        makeActiveTile('#tiles-16-btn');
    })

    function removeAllActiveTiles() {
        const btns = document.querySelectorAll('#tiles-4-btn, #tiles-9-btn, #tiles-16-btn');
        btns.forEach(btn => { btn.classList.remove('active') })
    }

    function makeActiveTile(id){
        removeAllActiveTiles()

        const btn = document.querySelector(id);
        btn.classList.add('active')
    }

    $('.quantity-selector #pd-q-up').on('click', function(e){
        e.preventDefault();

        const quantity = e.target.parentElement.querySelector('.input-element');
        quantity.stepUp()
    })

    $('.quantity-selector #pd-q-down').on('click', function(e){
        e.preventDefault();
        
        const quantity = e.target.parentElement.querySelector('.input-element');
        quantity.stepDown()
    })

    $('#mobile-filter-toggle').on('click', function() {
        $('body').trigger('open-overlay', ['open-mobile-filter']);
    })

    // open single product overlay
    $('.single-product-images .biolife-carousel.slider-for').on('click', function() {
        $('.single-product-images').addClass("overlay");
    })
    $('.single-product-images .btn-close').on('click', function() {
        $('.single-product-images').removeClass("overlay");
    })

})(jQuery);
</script>