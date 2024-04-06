<div class="container">
    <div class="row">
        <div class="col-4 p-1">
            <?php echo img('public/assets/images/logo.jpg', false, ['class' => 'img-thumbnail w-50 border-0']); ?>
        </div>
        <div class="col-4 p-1 text-center">
            <h5 class="fw-semibold mt-2 mb-0 fs-6"><i class="fa-solid fa-location-dot" style="color: #FFD43B;"></i> Where am I <i class="fa-solid fa-chevron-down fa-2xs"></i></h5>
            <small class="text-body-secondary" style="font-size:0.8rem;">Vashi Station Road</small>
        </div>
        <div class="col-4 text-end p-1">
            <?php echo img('public/assets/images/user_icon.png', false, ['class' => 'img-thumbnail w-50 border-0']); ?>
        </div>
    </div>
</div>
<div class="container">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php for ($i = 0; $i < 4; $i++) : ?>
                <div class="carousel-item active">
                    <img src="public/assets/images/banner.jpg" class="d-block w-100" style="border-radius: 25px;height: 23vh !important;" alt="...">
                </div>
            <?php endfor ?>
        </div>
    </div>
</div>
<h2 class="hr-lines mx-5 mt-3 mb-0" style="color:darkgray;font-size:small;">WE PRINT</h2>
<div class="container-fluid px-4 pt-1 mb-3">
    <div class="row">
        <?php for ($i = 0; $i < 8; $i++) : ?>
            <div class="col-4 g-3">
                <div class="card" style="border-radius:20px;">
                    <img src="public/assets/images/card.webp" class="card-img-top" style="border-radius:20px;" alt="...">
                    <button type="button" class="btn btn-light shadow w-100 py-1" style="border-radius:20px;position: absolute;bottom: -1px;" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD</button>
                </div>
            </div>
        <?php endfor ?>
    </div>
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