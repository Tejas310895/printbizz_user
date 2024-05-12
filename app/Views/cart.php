<?php

use App\Models\ProductItemnaryGroup;
?>
<div class="container bg-white shadow fixed-top py-2">
    <div class="row">
        <div class="col-1">
            <button class="btn btn-transparent" type="button" onclick="history.go(-1)">
                <i class="fa-solid fa-arrow-left fa-xl" style="color: #747474;"></i>
            </button>
        </div>
        <div class="col-11 ps-5 pt-2">
            <h5>Your Cart</h5>
        </div>
    </div>
</div>
<div class="container-fluid h-100 my-5 py-4" id="main_body" style="background:#F0F0F0;height: 89vh !important;overflow-y:scroll;">
    <div class="card mb-3 border border-0" style="border-radius: 15px;">
        <div class="card-body p-2" id="itemnary_container">

        </div>
    </div>

    <div class="card mb-3 border border-0" style="border-radius: 15px;">
        <div class="card-body">
            <h5 class="card-title fw-bold mb-2" style="font-size:0.9rem;">Apply Coupons</h5>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php for ($i = 0; $i < 8; $i++) : ?>
                        <div class="swiper-slide">
                            <div class="row">
                                <div class="col-8 pe-0">
                                    <div class="card cou_left bg-danger" style="height:55px;">
                                        <div class="card-body text-white px-2 py-1 text-center" style="display: flex;flex-direction: column;">
                                            <h5 class="card-title mb-0 mt-1 fw-bolder"> 10% OFF</h5>
                                            <small style="font-size: 0.7rem;">Order above 200</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 ps-0">
                                    <div class="card cou_right bg-danger" style="height:55px;">
                                        <div class="card-body px-0 pt-2">
                                            <button type="button" class="btn btn-transparent btn-sm btn btn-trans btn-sm p-0 text-white fw-bold" style="font-size: 0.8rem;line-height: normal;">Apply Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endfor ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3 border border-0" style="border-radius: 15px;">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white border border-right-0" id="basic-addon1"><i class="fa-solid fa-house-user"></i></span>
                        <select class="form-select form-select-sm" id="address_details" aria-label="Small select example">
                            <option selected disabled value="">Select Delivery Address</option>
                            <?php foreach ($institutes as $value) : ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            <div id="billing_container">

            </div>
        </div>
    </div>
</div>
<div class="container shadow bg-white fixed-bottom py-2" id="order_checkout">
    <?php if (auth()->user()) : ?>
        <button type="button" class="btn btn-block btn-lg w-100 text-light" style="background-color: #9F88FF;border-radius:15px;" onclick="checkout($(this))">CHECKOUT</button>
    <?php else : ?>
        <button type="button" class="btn btn-block btn-lg w-100 text-light" style="background-color: #9F88FF;border-radius:15px;" onclick="login_call()">Login & Checkout</button>
    <?php endif ?>
</div>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down h-75">
        <div class="modal-content animate-bottom" style="border-radius: 25px 25px 0px 0px;background:#F0F0F0;">
            <div class="modal-body p-0" style="display: flex !important;align-items: flex-start;justify-content: center;overflow: hidden;">
                <button type="button" class="btn bg-light btn-close p-2 cart_close" data-bs-dismiss="modal" aria-label="Close" style="border-radius: 20px;position: fixed;top: -5%;background-color:chocolate;"></button>
                <div class="container-fluid bg-white shadow px-0" id="product_modal_body" style="border-radius: 25px 25px 0px 0px;">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="change_add" tabindex="-1" aria-labelledby="change_add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 2,
        spaceBetween: 30,
        freeMode: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    function increment_copy(element, index = null) {
        element.attr('disabled', 'disabled');
        var input_ele = element.parent().find('input');
        var pre_val = input_ele.val();
        var post_val = parseInt(pre_val) + 1;
        input_ele.val(post_val);
        element.parent().removeClass('border-danger');
        add_cookies(index, post_val);
        element.removeAttr('disabled');
        element.parent().find('.minus').html('<i class="fa fa-minus text-dark"></i>');
    }

    function decrement_copy(element, index = null) {
        element.attr('disabled', 'disabled');
        var input_ele = element.parent().find('input');
        var pre_val = input_ele.val();
        var post_val = parseInt(pre_val) - 1;
        input_ele.val(parseInt(pre_val) - 1);
        element.parent().removeClass('border-danger');
        add_cookies(index, post_val);
        element.removeAttr('disabled');
    }

    function add_cookies(index, qty) {
        var pre_cookies = JSON.parse(getCookie('inventory'));
        var product = pre_cookies[index];
        if (qty > 0) {
            product['copies'] = qty;
            pre_cookies[index] = product;
        } else {
            var pre_cookies = JSON.parse(getCookie('inventory'));
            pre_cookies.splice(index, 1);
        }
        if (pre_cookies.length < 1) {
            setCookie('inventory', "", -1);
        } else {
            setCookie('inventory', JSON.stringify(pre_cookies), 7);
        }
        load_itemnary();
    }

    function checkout(element) {
        element.attr('disabled', 'disabled');
        $('#address_details').css('border-color', '');
        var address = $('#address_details').val();
        var cookie_products = JSON.parse(getCookie('inventory'));
        if (address != null) {
            element.html('<span role="status">Loading</span><span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span><span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span><span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>');
            $.ajax({
                type: "post",
                url: "checkout",
                data: {
                    'charges': {
                        'gst': $('.gst').data('gst'),
                        'del_charges': $('.del_charges').data('del_charges')
                    },
                    'address': address,
                    'itemnary': cookie_products
                },
                success: function(response) {
                    setTimeout(() => {
                        if (response.status == 1) {
                            setCookie('inventory', "", -1);
                            window.location.replace('order_success');
                        } else {
                            alert('Error occured! Try again');
                            element.removeAttr('disabled');
                            element.text('CHECKOUT');
                        }
                    }, 1000);
                }
            });
        } else {
            $('#address_details').css('border-color', 'red');
        }
        element.removeAttr('disabled');
    }

    function load_itemnary() {
        var itemnary_template = '';
        var billing_template = '';
        var db_products = <?= json_encode($products) ?>;
        if (getCookie('inventory')) {
            var cookie_products = JSON.parse(getCookie('inventory'));
            var cart_item_tot = 0;
            if (cookie_products.length > 0) {
                $.each(cookie_products, function(ci, cv) {
                    var cproduct = db_products[cv.product_id];
                    var price = parseInt(cproduct.default_price);
                    var items_added = [];
                    $.each(cv.itemnary_single, function(isi, isv) {
                        price += parseInt(JSON.parse(isv).price);
                    });
                    $.each(cv.itemnary_multi, function(imi, imv) {
                        price += parseInt(JSON.parse(imv).price);
                    });
                    item_tot = parseInt(price) * (parseInt(cv['copies']) * parseInt(cv['pages']));
                    itemnary_template += '<div class="row my-2">';
                    itemnary_template += '<div class="col-2">';
                    itemnary_template += '<img src="' + JSON.parse(cproduct['img'])[0] + '" class="d-block" style="border-radius: 8px;width:60px; height:60px;" alt="...">';
                    itemnary_template += '</div>';
                    itemnary_template += '<div class="col-7 pr-0">';
                    itemnary_template += '<nav style="--bs-breadcrumb-divider: \'\';" aria-label="breadcrumb">';
                    itemnary_template += '<ol class="breadcrumb mb-0">';
                    itemnary_template += '<li class="breadcrumb-item">';
                    itemnary_template += '<h6 class="fw-bold mb-0">' + cproduct['name'] + '</h6>';
                    itemnary_template += '</li>';
                    itemnary_template += '<li class="breadcrumb-item" aria-current="page"><i class="fa-regular fa-newspaper"></i> <small class=" fw-lighter mt-1">' + cv['pages'] + ' Pages</small></li>';
                    itemnary_template += '</ol>';
                    itemnary_template += '</nav>';
                    itemnary_template += '<h6 class="fw-bold mb-1 text-truncate" style="font-size: 10px;max-width: 150px;">' + items_added.join(',') + '</h6>';
                    itemnary_template += '<button type="button" class="btn btn-transparent btn-sm py-0 ps-0 fw-bold" style="color:#9F88FF;" onclick="product_modal($(this),' + ci + ')">Customize <i class="fa-solid fa-chevron-right fa-xs"></i></button>';
                    itemnary_template += '</div>';
                    itemnary_template += '<div class="col-3 px-0">';
                    itemnary_template += '<div class="input-group border border-1 border" style="border-radius:10px;width: 85% !important;">';
                    itemnary_template += '<button class="btn btn-transparent px-2" type="button" onclick="decrement_copy($(this),' + ci + ');">' + ((cv['copies'] > 1) ? '<i class="fa fa-minus text-dark"></i>' : '<i class="fa-solid fa-trash-can"></i>') + '</button>';
                    itemnary_template += '<input type="text" name="item_qty" class="form-control shadow-none bg-transparent border-0 text-center px-0" value="' + cv['copies'] + '" readonly>';
                    itemnary_template += '<button class="btn btn-transparent px-2" type="button" onclick="increment_copy($(this),' + ci + ');"><i class="fa fa-plus text-dark"></i></button>';
                    itemnary_template += '</div>';
                    itemnary_template += '<h6 class="text-end pe-3 mt-2 fw-bold mb-0">₹ ' + item_tot + '</h6>';
                    itemnary_template += '</div>';
                    itemnary_template += '</div>';

                    cart_item_tot += item_tot;
                });
                var gst = parseFloat((cart_item_tot * 0.05).toFixed(2));
                var del_charges = 30;
                var grand_total = cart_item_tot + gst + del_charges;
                billing_template += '<h6 class="mb-1 fs-6 text-secondary fw-bold mb-3">Bill Summary</h6>';
                billing_template += '<div class="row border border-top-0 border-start-0 border-end-0">';
                billing_template += '<div class="col-8">';
                billing_template += '<h6 class="fw-bold" style="font-size:1rem;">Item Total</h6>';
                billing_template += '</div>';
                billing_template += '<div class="col-4 text-end">';
                billing_template += '<h6 class="fw-bold" style="font-size:1rem;">₹ ' + cart_item_tot + '</h6>';
                billing_template += '</div>';
                billing_template += '</div>';
                billing_template += '<div class="row pt-2">';
                billing_template += '<div class="col-8">';
                billing_template += '<h6 class="fw-light" style="font-size:0.9rem;">GST Charges</h6>';
                billing_template += '</div>';
                billing_template += '<div class="col-4 text-end">';
                billing_template += '<h6 class="fw-light gst" style="font-size:0.9rem;" data-gst="' + gst + '">₹ ' + gst + '</h6>';
                billing_template += '</div>';
                billing_template += '</div>';
                billing_template += '<div class="row">';
                billing_template += '<div class="col-8">';
                billing_template += '<h6 class="fw-light" style="font-size:0.9rem;">Delivery Charges</h6>';
                billing_template += '</div>';
                billing_template += '<div class="col-4 text-end">';
                billing_template += '<h6 class="fw-light del_charges" style="font-size:0.9rem;" data-del_charges="' + del_charges + '">₹ ' + del_charges + '</h6>';
                billing_template += '</div>';
                billing_template += '</div>';
                billing_template += '<div class="row border border-bottom-0 border-start-0 border-end-0 pt-3">';
                billing_template += '<div class="col-8">';
                billing_template += '<h6 class="fw-bold fs-6">Grand Total</h6>';
                billing_template += '</div>';
                billing_template += '<div class="col-4 text-end">';
                billing_template += '<h6 class="fw-bold fs-6">₹ ' + (grand_total).toFixed(2) + '</h6>';
                billing_template += '</div>';
                billing_template += '</div>';

                $('#itemnary_container').html(itemnary_template);
                $('#billing_container').html(billing_template);
            }
        } else {
            itemnary_template += '<div class="card border border-0">';
            itemnary_template += '<div class="card-body text-center">';
            itemnary_template += '<img src="public/assets/images/empty-cart.png" alt="" class="img img-thumbnail w-50 border border-0 mx-auto d-block">';
            itemnary_template += '<h5 class="card-subtitle mb-2 text-body-secondary text-center fw-bold">Your cart is empty</h5>';
            itemnary_template += '<a href="<?= base_url() ?>" type="button" class="btn btn-outline-danger" style="border-radius:30px;">Add Now</a>';
            itemnary_template += '</div>';
            itemnary_template += '</div>';
            $('#main_body').css('background', '');
            $('#main_body').empty();
            $('#main_body').html(itemnary_template);
            $('#order_checkout').remove();
        }
    }

    $(document).ready(function() {
        load_itemnary();
        $('.cou_left').corner("bite tr br 10px");
        $('.cou_right').corner("bite tl bl 10px");
    });

    function product_modal(element, index_id) {
        var modal_body = '';
        var product_arr = <?= json_encode($products) ?>;
        var cookie_prod = JSON.parse(getCookie('inventory'))[index_id];
        var prod_id = cookie_prod.product_id;
        modal_body += '<form onsubmit="modal_product_submit($(this),' + index_id + ');return false;" action="" method="post" enctype="multipart/form-data">';
        modal_body += '<div class="row px-4">';
        modal_body += '<div class="col-2 px-2 pt-2 pb-0">';
        modal_body += '<img src="' + JSON.parse(product_arr[prod_id].img)[0] + '" class="d-block" style="border-radius: 15px;width:50px; height:50px;" alt="...">';
        modal_body += '</div>';
        modal_body += '<div class="col-10 pt-3 pb-2 ps-0">';
        modal_body += '<h6 class="fw-bold mb-0"> ' + product_arr[prod_id].name + ' </h6>';
        modal_body += '<small class="fw-bold d-block" style="font-size: 0.7rem;"> ₹ ' + product_arr[prod_id].default_price + ' / Page </small>';
        modal_body += '</div>';
        modal_body += '</div>';
        modal_body += '<div class="container-fluid shadow-none py-3" style="height:59vh;overflow-y: scroll;background:#F0F0F0;">';
        modal_body += '<input type="hidden" name="product_id" value="' + product_arr[prod_id].id + '" required>';
        $.each(product_arr[prod_id].group, function(gi, gv) {
            modal_body += '<div class="card mb-3 border border-0" style="border-radius: 15px;">';
            modal_body += '<div class="card-body">';
            modal_body += '<h5 class="card-title fw-bold" style="font-size:0.9rem;">' + gv.name + '</h5>';
            modal_body += '<ul class="list-group">';
            if (gv.type == <?= ProductItemnaryGroup::TYPE_SINGLE_SELECT ?>) {
                $.each(gv.items, function(ti, tv) {
                    var is_checked = ' ';
                    var item_value = JSON.stringify({
                        'g_id': gv.id,
                        'i_id': tv.id,
                        'price': tv.price
                    });
                    $.each(cookie_prod.itemnary_single, function(imi, imv) {
                        if (parseInt(JSON.parse(imv).g_id) == gv.id && parseInt(JSON.parse(imv).i_id) == tv.id) {
                            is_checked = 'checked';
                        }
                    });
                    modal_body += '<li class="list-group-item border-0 pb-0">';
                    modal_body += '<i class="fa-solid fa-square fa-xl" style="color: #dbdbdb;"></i> ';
                    modal_body += '<label class="form-check-label" for="secondRadio">' + tv.name + ((tv.price > 0) ? ' + ₹' + tv.price : '') + '</label>';
                    modal_body += "<input class='form-check-input me-1 float-end' type='radio' name='itemnary_single[]' value='" + item_value + "' " + is_checked + " required>";
                    modal_body += '</li>';
                });
            } else if (gv.type == <?= ProductItemnaryGroup::TYPE_MULTI_SELECT ?>) {
                $.each(gv.items, function(ti, tv) {
                    var is_checked = ' ';
                    var item_value = JSON.stringify({
                        'g_id': gv.id,
                        'i_id': tv.id,
                        'price': tv.price
                    });
                    $.each(cookie_prod.itemnary_multi, function(imi, imv) {
                        if (parseInt(JSON.parse(imv).g_id) == gv.id && parseInt(JSON.parse(imv).i_id) == tv.id) {
                            is_checked = 'checked';
                        }
                    });
                    modal_body += '<li class="list-group-item border-0 pb-0">';
                    modal_body += '<i class="fa-solid fa-square fa-xl" style="color: #dbdbdb;"></i> ';
                    modal_body += '<labelclass="form-check-label" for="flexCheckDefault">' + tv.name + ((tv.price > 0) ? ' + ₹' + tv.price : '') + '</label>';
                    modal_body += "<input class='form-check-input me-1 float-end' type='checkbox'n name='itemnary_multi[]' value='" + item_value + "'" + is_checked + ">";
                    modal_body += '</li>';
                });
            }
            modal_body += '</ul>';
            modal_body += '</div>';
            modal_body += '</div>';
        });
        modal_body += '<div class="card mb-3 border border-0" style="border-radius: 15px;">';
        modal_body += '<div class="card-body">';
        modal_body += '<h6 class="card-title mt-2" style="font-size:0.9rem;">You have uploaded <span class="fw-bold text-danger">' + cookie_prod.files.length + ' files </span> be rest assured, if want to change reupload all files again below</h6>';
        modal_body += '<div class="mt-3 mb-2">';
        modal_body += '<input class="form-control" type="file" id="formFileMultiple" name="print_file[]" style="border-radius: 14px;" multiple>';
        modal_body += '</div>';
        modal_body += '</div>';
        modal_body += '</div>';
        modal_body += '</div>';
        modal_body += '<div class="container-fluid h-100 bg-white">';
        modal_body += '<div class="row fixed-bottom bg-white" style="height: 72px;">';
        modal_body += '<div class="col-4 py-0 ps-2 pe-0 text-center">';
        modal_body += '<label class="form-check-label fw-bold ps-3" for="secondRadio" style="font-size: 10px;">ADD COPIES</label>';
        modal_body += '<div class="input-group border border-1 border float-end" style="border-radius:10px;width: 85% !important;">';
        modal_body += '<button class="btn btn-transparent p-1" type="button" onclick="decrement_copy($(this));"><i class="fa fa-minus text-dark"></i></button>';
        modal_body += '<input type="number" name="copies" class="form-control shadow-none bg-transparent border-0 text-center px-0" value="' + cookie_prod.copies + '" readonly required>';
        modal_body += '<button class="btn btn-transparent p-1" type="button" onclick="increment_copy($(this));"><i class="fa fa-plus text-dark"></i></button>';
        modal_body += '</div>';
        modal_body += '</div>';
        modal_body += '<div class="col-8 px-4 pt-3">';
        modal_body += '<button type="submit" class="btn btn-block btn-lg w-100 text-light" style="background-color: #9F88FF;border-radius:10px;">UPDATE CART</button>';
        modal_body += '</div>';
        modal_body += '</div>';
        modal_body += '</div>';
        modal_body += '</form>';
        $('#product_modal_body').html(modal_body);
        $('#productModal').modal('show');
    }

    function modal_product_submit(element, index) {
        var postData = [];
        var formData = new FormData(element[0]);
        var is_valid = 1;
        var products_added = 0;
        for (let pair of formData.entries()) {
            if (pair[0] == 'copies' && pair[1] < 1) {
                $('input[name="copies"]').parent().addClass('border-danger');
                is_valid = 0;
            }
        }
        formData.append('index', index);
        if (is_valid) {
            element.find(':submit').attr('disabled', 'disabled');
            element.find(':submit').html('<span role="status">Loading</span><span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span><span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span><span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>');
            $.ajax({
                type: "post",
                url: window.location.href,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    setTimeout(() => {
                        if (response.status == 1) {
                            if (getCookie('inventory') == '') {
                                var inventory = [];
                            } else {
                                var inventory = JSON.parse(getCookie('inventory'));
                            }
                            inventory[response.index] = response.postdata;
                            setCookie('inventory', JSON.stringify(inventory), 7);
                            element.find(':submit').addClass('bg-success');
                            element.find(':submit').text('UPDATED');
                            setTimeout(() => {
                                $('#product_modal_body').empty();
                                $('#productModal').modal('hide');
                                load_itemnary();
                            }, 500);
                        } else {
                            element.find(':submit').removeAttr('disabled');
                            element.find(':submit').text('UPDATE CART');
                        }
                    }, 500);
                }
            });
        }
    }
</script>