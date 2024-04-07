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
<div class="container-fluid h-100 my-5 py-5" style="background:#F0F0F0;height: 89vh !important;overflow-y:scroll;">
    <div class="card mb-3 border border-0" style="border-radius: 15px;">
        <div class="card-body p-2">
            <?php for ($i = 0; $i < 2; $i++) : ?>
                <div class="row my-2">
                    <div class="col-2">
                        <img src="public/assets/images/card.webp" class="d-block" style="border-radius: 8px;width:60px; height:60px;" alt="...">
                    </div>
                    <div class="col-7 pr-0">
                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <h6 class="fw-bold mb-0">Xerox Print</h6>
                                </li>
                                <li class="breadcrumb-item" aria-current="page"><i class="fa-regular fa-newspaper"></i> <small class=" fw-lighter mt-1">22 Pages</small></li>
                            </ol>
                        </nav>
                        <h6 class="fw-bold mb-1" style="font-size: 10px;">Normal Paper , Black & White...</h6>
                        <button type="button" class="btn btn-transparent btn-sm py-0 ps-0 fw-bold" style="color:#9F88FF;" data-bs-toggle="modal" data-bs-target="#exampleModal">Customize <i class="fa-solid fa-chevron-right fa-xs"></i></button>
                    </div>
                    <div class="col-3 px-0">
                        <div class="input-group border border-1 border" style="border-radius:10px;width: 85% !important;">
                            <button class="btn btn-transparent p-1" type="button"><i class="fa fa-minus text-dark"></i></button>
                            <input type="text" name="item_qty" class="form-control shadow-none bg-transparent border-0 text-center px-0" value="0" readonly>
                            <button class="btn btn-transparent p-1" type="button"><i class="fa fa-plus text-dark"></i></button>
                        </div>
                        <h6 class="text-end pe-3 mt-2 fw-bold mb-0">₹ 230</h6>
                    </div>
                </div>
            <?php endfor ?>
        </div>
    </div>

    <div class="card mb-3 border border-0" style="border-radius: 15px;">
        <div class="card-body">
            <h5 class="card-title fw-bold mb-4" style="font-size:0.9rem;">Apply Coupons</h5>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php for ($i = 0; $i < 8; $i++) : ?>
                        <div class="swiper-slide">
                            <div class="card border border-0" style="background:#DBDBDB;">
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
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
                <div class="col-1">
                    <i class="fa-solid fa-house-user"></i>
                </div>
                <div class="col-8">
                    <h6 class="mb-1 fs-6">Delivery Address</h6>
                    <p class="lh-1" style="font-size: 0.6em;">
                        401 Rimo, Dynamic Crest, Kalyan - Shilphata Rd, Dombivli East, Nilje Gaon, Khidkali, Maharashtra 421204
                    </p>
                </div>
                <div class="col-3">
                    <button type="button border border-0" class="btn btn-transparent btn-sm pt-3 ps-0 fw-bold" style="color:#9F88FF;" data-bs-toggle="modal" data-bs-target="#change_add">Change</button>
                </div>
            </div>
            <h6 class="mb-1 fs-6 text-secondary fw-bold">Bill Summary</h6>
            <div class="row">
                <div class="col-8">
                    <h6 class="fw-light fs-6">Item Total</h6>
                </div>
                <div class="col-4 text-end">
                    <h6 class="fw-light fs-6">₹ 230</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <h6 class="fw-light fs-6">GST Charges</h6>
                </div>
                <div class="col-4 text-end">
                    <h6 class="fw-light fs-6">₹ 30.5</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <h6 class="fw-light fs-6">Delivery Charges</h6>
                </div>
                <div class="col-4 text-end">
                    <h6 class="fw-light fs-6">₹ 30</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <h6 class="fw-light fs-6">Platform Fee</h6>
                </div>
                <div class="col-4 text-end">
                    <h6 class="fw-light fs-6">₹ 0.50</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <h6 class="fw-bold fs-6">Grand Total</h6>
                </div>
                <div class="col-4 text-end">
                    <h6 class="fw-bold fs-6">₹ 295.5</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container shadow bg-white fixed-bottom py-2">
    <button type="button" class="btn btn-block btn-lg w-100 text-light" style="background-color: #9F88FF;border-radius:15px;">CHECKOUT</button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down h-75">
        <div class="modal-content animate-bottom" style="border-radius: 25px 25px 0px 0px;background:#F0F0F0;">
            <div class="modal-body p-0" style="display: flex !important;align-items: flex-start;justify-content: center;overflow: hidden;">
                <button type="button" class="btn bg-light btn-close p-2 cart_close" data-bs-dismiss="modal" aria-label="Close" style="border-radius: 20px;position: fixed;top: 20%;background-color:chocolate;"></button>
                <div class="container-fluid bg-white shadow px-0" style="border-radius: 25px 25px 0px 0px;">
                    <div class="row px-4">
                        <div class="col-2 px-2 pt-2 pb-0">
                            <img src="public/assets/images/card.webp" class="d-block" style="border-radius: 15px;width:50px; height:50px;" alt="...">
                        </div>
                        <div class="col-10 py-4 ps-0">
                            <h6 class="fw-bold"> Xerox </h6>
                        </div>
                    </div>
                    <div class="container-fluid shadow-none py-3" style="height:59vh;overflow-y: scroll;background:#F0F0F0;">
                        <?php for ($i = 0; $i < 2; $i++) : ?>
                            <div class="card mb-3 border border-0" style="border-radius: 15px;">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold" style="font-size:0.9rem;">Choose Your Paper</h5>
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 pb-0">
                                            <i class="fa-solid fa-square fa-xl" style="color: #dbdbdb;"></i>
                                            <label class="form-check-label" for="firstRadio">First radio</label>
                                            <input class="form-check-input me-1 float-end" type="radio" name="listGroupRadio<?= $i ?>" value="" id="firstRadio" checked>
                                        </li>
                                        <li class="list-group-item border-0 pb-0">
                                            <i class="fa-solid fa-square fa-xl" style="color: #dbdbdb;"></i>
                                            <label class="form-check-label" for="secondRadio">Second radio</label>
                                            <input class="form-check-input me-1 float-end" type="radio" name="listGroupRadio<?= $i ?>" value="" id="secondRadio">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php endfor ?>
                        <div class="card mb-3 border border-0" style="border-radius: 15px;">
                            <div class="card-body">
                                <h5 class="card-title fw-bold" style="font-size:0.9rem;">Upload your file</h5>
                                <div class="mt-3 mb-2">
                                    <input class="form-control" type="file" id="formFile" style="border-radius: 14px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid h-100 bg-white">
                        <div class="row fixed-bottom bg-white" style="height: 72px;">
                            <div class="col-4 py-0 px-3 text-center">
                                <label class="form-check-label fw-bold" for="secondRadio" style="font-size: 10px;">ADD COPIES</label>
                                <div class="input-group border border-1 border" style="border-radius:10px;width: 100% !important;">
                                    <button class="btn btn-transparent" type="button"><i class="fa fa-minus text-dark"></i></button>
                                    <input type="text" name="item_qty" class="form-control shadow-none bg-transparent border-0 text-center" value="0" readonly>
                                    <button class="btn btn-transparent" type="button"><i class="fa fa-plus text-dark"></i></button>
                                </div>
                            </div>
                            <div class="col-8 px-4 pt-3">
                                <button type="button" class="btn btn-block btn-lg w-100 text-light" style="background-color: #9F88FF;border-radius:10px;">ADD TO CART</button>
                            </div>
                        </div>
                    </div>
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
        slidesPerView: 3,
        spaceBetween: 30,
        freeMode: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>