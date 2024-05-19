<div class="container">
    <div class="row">
        <div class="col-4 p-1">
            <?php

            use App\Models\ProductItemnaryGroup;

            echo img('public/assets/images/logo.jpg', false, ['class' => 'img-thumbnail w-50 border-0']); ?>
        </div>
        <div class="col-4 p-1 text-center">
            <h5 class="fw-semibold mt-2 mb-0 fs-6"><i class="fa-solid fa-location-dot" style="color: #FFD43B;"></i> Where am I <i class="fa-solid fa-chevron-down fa-2xs"></i></h5>
            <small class="text-body-secondary" style="font-size:0.8rem;">Vashi Station Road</small>

        </div>
        <div class="col-4 text-end p-1">
            <a href="profile">
                <?php echo img('public/assets/images/user_icon.png', false, ['class' => 'img-thumbnail w-50 border-0']); ?>
            </a>
        </div>
    </div>
</div>
<div class="container">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php for ($i = 0; $i < 4; $i++) : ?>
                <div class="carousel-item active">
                    <img src="public/assets/images/banner.png" class="d-block w-100" style="border-radius: 25px;max-height: 23vh !important;" alt="...">
                </div>
            <?php endfor ?>
        </div>
    </div>
</div>
<h2 class="hr-lines mx-5 mt-3 mb-0" style="color:darkgray;font-size:small;">WE PRINT</h2>
<div class="container-fluid px-4 pt-1 mb-3">
    <div class="row">
        <?php foreach ($products as $product) : ?>
            <div class="col-4 g-3">
                <div class="card border border-0 shadow-lg" style="border-radius:20px;">
                    <img src="https://admin.printbizz.in/writable/<?= json_decode($product['img'], true)[0] ?>" class="card-img-top" style="border-radius:20px;" alt="...">
                    <?= csrf_field('prod_csrf') ?>
                    <button type="button" class="btn btn-light shadow w-100 py-1" style="border-radius:20px;position: absolute;bottom: -1px;" onclick="product_modal($(this),<?= $product['id'] ?>)">ADD</button>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<div class="container-fluid fixed-bottom" id="cart_foot" style="<?= (get_cookie('inventory')) ? ' ' : 'display:none;' ?>">
    <div class="alert alert-white shadow-lg mb-2 py-2" role="alert" style="border-radius:15px;">
        <div class="row">
            <div class="col-6">
                <h6 class="mb-0 mt-2 fw-bold" id="item_count_text"><?= (get_cookie('inventory')) ? count(json_decode(get_cookie('inventory'))) : ' ' ?> Items Added</h6>
            </div>
            <div class="col-5 text-end px-0">
                <a href="cart" type="button" class="btn btn-danger" style="border-radius:10px;">View Cart</a>
            </div>
            <div class="col-1 px-0">
                <button type="button" class="btn btn-transparent rounded-circle" onclick="clear_cart($(this))" style="border-radius:10px;"><i class="fa-solid fa-xmark fa-lg"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
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

<script>
    function increment_copy(element) {
        var input_ele = element.parent().find('input');
        var pre_val = input_ele.val();
        input_ele.val(parseInt(pre_val) + 1);
        element.parent().removeClass('border-danger');
    }

    function decrement_copy(element) {
        var input_ele = element.parent().find('input');
        var pre_val = input_ele.val();
        if (pre_val > 0) {
            input_ele.val(parseInt(pre_val) - 1);
            element.parent().removeClass('border-danger');
        }
    }

    function product_modal(element, prod_id) {
        var modal_body = '';
        var product_arr = <?= json_encode($products) ?>;
        modal_body += '<form onsubmit="modal_product_submit($(this));return false;" action="" method="post" enctype="multipart/form-data">';
        modal_body += '<div class="row px-4">';
        modal_body += '<div class="col-2 px-2 pt-2 pb-0">';
        modal_body += '<img src="https://admin.printbizz.in/writable/' + JSON.parse(product_arr[prod_id].img)[0] + '" class="d-block" style="border-radius: 15px;width:50px; height:50px;" alt="...">';
        modal_body += '</div>';
        modal_body += '<div class="col-10 py-3 ps-0 py-1">';
        modal_body += '<h6 class="fw-bold mb-0"> ' + product_arr[prod_id].name + ' </h6>';
        modal_body += '<small class="fw-bold d-block" style="font-size: 0.7rem;"> ₹ ' + product_arr[prod_id].default_price + ' / Page </small>';
        modal_body += '</div>';
        modal_body += '</div>';
        modal_body += '<div class="container-fluid shadow-none py-3" style="height:59vh;overflow-y: scroll;background:#F0F0F0;">';
        modal_body += '<input type="hidden" name="product_id" value="' + product_arr[prod_id].id + '" required>';
        modal_body += '<input type="hidden" name="default_price" value="' + product_arr[prod_id].default_price + '" required>';
        $.each(product_arr[prod_id].group, function(gi, gv) {
            modal_body += '<div class="card mb-3 border border-0" style="border-radius: 15px;">';
            modal_body += '<div class="card-body">';
            modal_body += '<h5 class="card-title fw-bold" style="font-size:0.9rem;">' + gv.name + '</h5>';
            modal_body += '<ul class="list-group">';
            if (gv.type == <?= ProductItemnaryGroup::TYPE_SINGLE_SELECT ?>) {
                $.each(gv.items, function(ti, tv) {
                    var is_checked = (ti == 0) ? 'checked' : ' ';
                    var item_value = JSON.stringify({
                        'g_id': gv.id,
                        'i_id': tv.id,
                        'price': tv.price
                    });
                    modal_body += '<li class="list-group-item border-0 pb-0">';
                    modal_body += '<i class="fa-solid fa-square fa-xl" style="color: #dbdbdb;"></i> ';
                    modal_body += '<label class="form-check-label" for="secondRadio">' + tv.name + ((tv.price > 0) ? ' + ₹' + tv.price : '') + '</label>';
                    modal_body += "<input class='form-check-input me-1 float-end' type='radio' name='itemnary_single[]' value='" + item_value + "' " + is_checked + " required>";
                    modal_body += '</li>';
                });
            } else if (gv.type == <?= ProductItemnaryGroup::TYPE_MULTI_SELECT ?>) {
                $.each(gv.items, function(ti, tv) {
                    var item_value = JSON.stringify({
                        'g_id': gv.id,
                        'i_id': tv.id,
                        'price': tv.price
                    });
                    modal_body += '<li class="list-group-item border-0 pb-0">';
                    modal_body += '<i class="fa-solid fa-square fa-xl" style="color: #dbdbdb;"></i> ';
                    modal_body += '<labelclass="form-check-label" for="flexCheckDefault">' + tv.name + ((tv.price > 0) ? ' + ₹' + tv.price : '') + '</label>';
                    modal_body += "<input class='form-check-input me-1 float-end' type='checkbox'n name='itemnary_multi[]' value='" + item_value + "'>";
                    modal_body += '</li>';
                });
            }
            modal_body += '</ul>';
            modal_body += '</div>';
            modal_body += '</div>';
        });
        modal_body += '<div class="card mb-3 border border-0" style="border-radius: 15px;">';
        modal_body += '<div class="card-body">';
        modal_body += '<h5 class="card-title fw-bold" style="font-size:0.9rem;">Upload your file</h5>';
        modal_body += '<div class="mt-3 mb-0">';
        modal_body += '<input class="form-control" type="file" id="formFileMultiple" name="print_file[]" style="border-radius: 14px;" multiple required>';
        modal_body += '<small>Ext allowed : pdf, jpg, png, jpeg, webp</small>';
        modal_body += '</div>';
        modal_body += '</div>';
        modal_body += '</div>';
        modal_body += '</div>';
        modal_body += '<div class="container-fluid h-100 bg-white">';
        modal_body += '<div class="row fixed-bottom bg-white" style="height: 72px;">';
        modal_body += '<div class="col-4 py-0 ps-2 pe-0 text-center">';
        modal_body += '<label class="form-check-label fw-bold ps-3" for="secondRadio" style="font-size: 10px;">ADD COPIES</label>';
        modal_body += '<div class="input-group border border-1 border float-end" style="border-radius:10px;width: 85% !important;">';
        modal_body += '<button class="btn btn-transparent px-2" type="button" onclick="decrement_copy($(this));"><i class="fa fa-minus text-dark"></i></button>';
        modal_body += '<input type="number" name="copies" class="form-control shadow-none bg-transparent border-0 text-center px-0" value="0" readonly required>';
        modal_body += '<button class="btn btn-transparent px-2" type="button" onclick="increment_copy($(this));"><i class="fa fa-plus text-dark"></i></button>';
        modal_body += '</div>';
        modal_body += '</div>';
        modal_body += '<div class="col-8 px-4 pt-3">';
        modal_body += '<button type="submit" class="btn btn-block btn-lg w-100 text-light" style="background-color: #9F88FF;border-radius:10px;">ADD TO CART</button>';
        modal_body += '</div>';
        modal_body += '</div>';
        modal_body += '</div>';
        modal_body += '</form>';
        $('#product_modal_body').html(modal_body);
        $('#productModal').modal('show');
    }

    function modal_product_submit(element) {
        var postData = [];
        var csrf = $('#prod_csrf');
        var formData = new FormData(element[0]);
        var is_valid = 1;
        var products_added = 0;
        for (let pair of formData.entries()) {
            if (pair[0] == 'copies' && pair[1] < 1) {
                $('input[name="copies"]').parent().addClass('border-danger');
                is_valid = 0;
            }
        }
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
                            inventory.push(response.postdata);
                            setCookie('inventory', JSON.stringify(inventory), 7);
                            element.find(':submit').addClass('bg-success');
                            element.find(':submit').text('ADDED');
                            setTimeout(() => {
                                $('#product_modal_body').empty();
                                $('#productModal').modal('hide');
                            }, 500);
                            if (getCookie('inventory') != '') {
                                $('#cart_foot').show();
                                $('#cart_foot').find('#item_count_text').text(JSON.parse(getCookie('inventory')).length + ' Items Added');
                            } else {
                                $('#cart_foot').hide();
                            }
                        } else {
                            setTimeout(() => {
                                element.find('input[name="print_file[]"]').after('<p class="text-danger fw-light mb-0">Invalid file</p>');
                            }, 200);
                            element.find(':submit').removeAttr('disabled');
                            element.find(':submit').text('ADD TO CART');
                        }
                    }, 500);
                }
            });
        }
    }

    function clear_cart(element) {
        setCookie('inventory', "", -1);
        element.parent().parent().parent().hide();
    }
</script>