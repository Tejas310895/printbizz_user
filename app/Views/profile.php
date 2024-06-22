<div class="container bg-white shadow fixed-top py-2">
    <div class="row">
        <div class="col-2">
            <a href="<?= base_url() ?>" class="btn btn-transparent" type="button">
                <i class="fa-solid fa-arrow-left fa-xl" style="color: #747474;"></i>
            </a>
        </div>
        <div class="col-10 ps-1 pt-2">
            <h5>Your Profile</h5>
        </div>
    </div>
</div>
<div class="container-fluid h-100" style="background:#F0F0F0;height: 100vh !important;overflow-y:scroll;padding-top: 82px !important;">
    <div class="card mb-3 border border-0" style="border-radius: 15px;">
        <div class="card-body">

            <?php

            use App\Models\Orders;

            if (auth()->user()) :
            ?>
                <div class="row">
                    <div class="col-4">
                        <p data-letters="<?= strtoupper(substr(auth()->user()->getEmailIdentity()->name, 0, 1)) ?>" class="mb-0"></p>
                    </div>
                    <div class="col-7 pt-3 ps-0">
                        <h6><?= auth()->user()->getEmailIdentity()->name ?></h6>
                        <h6 class="mb-0 text-black-50">+91 <?= auth()->user()->email ?></h6>
                        <h6 class="mb-0 text-black-50"><?= auth()->user()->getEmailIdentity()->email ?></h6>
                    </div>
                    <div class="col-1 text-start">
                        <button class="btn btn-transparent ps-0 pe-4" style="display: contents;" type="button" data-bs-toggle="modal" data-bs-target="#profile_edit">
                            <i class="fa-solid fa-pencil fa-sm"></i>
                        </button>
                    </div>
                </div>
            <?php else : ?>
                <div class="row">
                    <div class="col-12">
                        <h6 class=" fw-bold mb-2" style="font-size:0.9rem;">Create/Login the account</h6>
                        <button type="button" class="btn btn-block btn-lg w-100 text-light rounded-0" style="background-color: #9F88FF;font-size:1rem;" onclick="login_call()">Login / Sign up</button>
                        <p class="text-center mb-0">
                            <small style="font-size:0.7rem;">By clicking, I accept the <strong>Terms & Conditions</strong> and <strong>Privacy Policy</strong></small>
                        </p>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
    <?php
    if (auth()->user()) :
    ?>
        <div class="card mb-3 border border-0" style="border-radius: 15px;height: 40vh;overflow-y: scroll;">
            <div class="card-header bg-white text-center sticky-top border border-0 shadow">
                My Orders
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <?php foreach ($orders as $order) : ?>
                        <div class="card mb-3 border border-0 shadow-sm">
                            <div class="card-body py-1">
                                <div class="step_container d-flex justify-content-center align-items-center">

                                    <div class="progresses">
                                        <?php

                                        if ($order['status'] == Orders::STATUS_ORDER_PLACED) {
                                            $order_placed = 1;
                                        } else {
                                            $order_placed = 0;
                                        }
                                        if ($order['status'] == Orders::STATUS_ORDER_PROCESSING) {
                                            $order_process = 1;
                                            $order_placed = 1;
                                        } else {
                                            $order_process = 0;
                                        }
                                        if ($order['status'] == Orders::STATUS_ORDER_OUT_FOR_DELIVERY) {
                                            $order_out = 1;
                                            $order_placed = 1;
                                            $order_process = 1;
                                        } else {
                                            $order_out = 0;
                                        }
                                        if ($order['status'] == Orders::STATUS_ORDER_DELIVERED) {
                                            $order_delevered = 1;
                                            $order_placed = 1;
                                            $order_process = 1;
                                            $order_out = 1;
                                        } else {
                                            $order_delevered = 0;
                                        }


                                        ?>

                                        <div class="steps" style="background:<?= ($order_placed) ? '#4bb7ff' : '#D1D1D1' ?> ;">
                                            <p class="text-dark fw-bold text-uppercase" style="display:block;position:absolute;top:5vh;font-size:0.5rem;">Placed</p>
                                            <span><?= ($order_placed) ? '<i class="fa-solid fa-check"></i>' : '' ?></span>
                                        </div>

                                        <span class="line" style="background: <?= ($order_process) ? '#4bb7ff' : '#D1D1D1' ?>;"></span>

                                        <div class="steps" style="background: <?= ($order_process) ? '#4bb7ff' : '#D1D1D1' ?>;">
                                            <p class="text-dark fw-bold text-uppercase" style="display:block;position:absolute;top:5vh;font-size:0.5rem;">In Process</p>
                                            <span><?= ($order_process) ? '<i class="fa-solid fa-check"></i>' : '' ?></span>
                                        </div>

                                        <span class="line" style="background: <?= ($order_out) ? '#4bb7ff' : '#D1D1D1' ?>;"></span>

                                        <div class="steps" style="background: <?= ($order_out) ? '#4bb7ff' : '#D1D1D1' ?>;">
                                            <p class="text-dark fw-bold text-uppercase" style="display:block;position:absolute;top:5vh;font-size:0.5rem;">Out For Delivery</p>
                                            <span><?= ($order_out) ? '<i class="fa-solid fa-check"></i>' : '' ?></span>
                                        </div>


                                        <span class="line" style="background: <?= ($order_delevered) ? '#4bb7ff' : '#D1D1D1' ?>;"></span>

                                        <div class="steps" style="background: <?= ($order_delevered) ? '#4bb7ff' : '#D1D1D1' ?>;">
                                            <p class="text-dark fw-bold text-uppercase" style="display:block;position:absolute;top:5vh;font-size:0.5rem;">Delivered</p>
                                            <span class="font-weight-bold"><?= ($order_delevered) ? '<i class="fa-solid fa-check"></i>' : '' ?></span>
                                        </div>

                                    </div>

                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center border border-0 px-1">
                                        <figure class="mb-0 mt-2">
                                            <blockquote class="blockquote" style="font-size: 0.7rem;">
                                                <p class="text-dark fw-bold">Estimated Delivery time</p>
                                            </blockquote>
                                            <figcaption class="blockquote-footer mb-0" style="font-size:0.7rem;">
                                                <?php

                                                if (date('H', strtotime($order['created_at'])) > '20') {
                                                    $order_date = date('D, d-m-y 08:00 - 11:00 A', strtotime($order['created_at'] . ' +2 day'));
                                                } else {
                                                    $order_date = date('D, d-m-y 08:00 - 11:00 A', strtotime($order['created_at'] . ' +1 day'));
                                                }

                                                ?>
                                                <?= $order_date ?>
                                            </figcaption>
                                        </figure>
                                        <span class="badge bg-white rounded-pill">
                                            <a href="order_details/<?= $order['id'] ?>" class="btn btn-primary p-0 rounded-circle mt-2" type="button">
                                                <i class="fa-solid fa-circle-chevron-right fa-xl"></i>
                                            </a>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    <?php endif ?>
    <div class="card mb-3 border border-0" style="border-radius: 15px;">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="docs/about_us" class="text-decoration-none text-secondary">About Us</a></li>
                <li class="list-group-item"><a href="docs/payment_policy" class="text-decoration-none text-secondary">Payment Policy</a></li>
                <li class="list-group-item"><a href="docs/privacy_policy" class="text-decoration-none text-secondary">Privacy Policy</a></li>
                <li class="list-group-item"><a href="docs/terms_conditions" class="text-decoration-none text-secondary">Terms & Conditions</a></li>
            </ul>
        </div>
    </div>
    <div class="card mb-3 border border-0" style="border-radius: 15px;">
        <?php
        if (auth()->user()) :
        ?>
            <div class="card-body p-1">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center border border-0">
                        <h5 class="mb-0 fw-bold" style="font-size:1rem;">Logout</h5>
                        <a href="logout" class="btn btn-light p-3 badge text-bg-primary rounded-pill text-dark"><i class="fa-solid fa-arrow-right-from-bracket fa-xl"></i></a>
                    </li>
                </ul>
            </div>
    </div>
<?php endif ?>
<!-- <div class="card mb-3 border border-0" style="border-radius: 15px;">
        <div class="card-body">
            <h5 class="card-title fw-bold" style="font-size:0.9rem;">Your Addresses</h5>
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
                <div class="col-3 text-end">
                    <button type="button border border-0" class="btn btn-transparent btn-sm pt-3 ps-0 fw-bold" style="color:#9F88FF;" data-bs-toggle="modal" data-bs-target="#profile_add"><i class="fa-solid fa-pencil fa-lg"></i></button>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <i class="fa-solid fa-building"></i>
                </div>
                <div class="col-8">
                    <h6 class="mb-1 fs-6">Office Address</h6>
                    <p class="lh-1" style="font-size: 0.6em;">
                        Dombivli East, Nilje Gaon, Khidkali, Maharashtra 421204
                    </p>
                </div>
                <div class="col-3 text-end">
                    <button type="button border border-0" class="btn btn-transparent btn-sm pt-3 ps-0 fw-bold" style="color:#9F88FF;" data-bs-toggle="modal" data-bs-target="#profile_add"><i class="fa-solid fa-pencil fa-lg"></i></button>
                </div>
            </div>
            <button type="button" class="btn btn-block btn-lg w-100 text-light" style="background-color: #9F88FF;border-radius:15px;" data-bs-toggle="modal" data-bs-target="#profile_add">ADD NEW ADDRESS</button>
            <button type="button" id="login_sweet_alert" class="btn btn-block btn-lg w-100 text-light" style="background-color: #9F88FF;border-radius:15px;">Login</button>
        </div>
    </div> -->
</div>
<!-- Modal -->
<!-- <div class="modal fade" id="profile_add" tabindex="-1" aria-labelledby="profile_add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="display: contents;">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h6>Address Details Update</h6>
                <div class="input-group mb-3 border border-1" style="border-radius:12px;">
                    <input type="text" class="form-control border border-0 bg-transparent" placeholder="Search for area, street name">
                    <span class="input-group-text border border-0 bg-transparent" id="basic-addon1">
                        <i class="fa-solid fa-location-crosshairs" style="color: #cfcfcf;"></i>
                    </span>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter room and society details" style="border-radius:12px;">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter landmark" style="border-radius:12px;">
                </div>
                <button type="button" class="btn btn-block btn-lg w-100 text-light" style="background-color: #9F88FF;border-radius:15px;">Update Address</button>
            </div>
        </div>
    </div>
</div> -->
<!-- Modal -->
<div class="modal fade" id="profile_edit" tabindex="-1" aria-labelledby="profile_edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="display: contents;">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h6>Address Details Update</h6>
                <?= form_open('') ?>
                <div class="mb-3">
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Enter Name" value="<?= auth()->user()->getEmailIdentity()->name ?>" style="border-radius:12px;" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="Enter Email" value="<?= auth()->user()->getEmailIdentity()->email ?>" style="border-radius:12px;">
                </div>
                <button type="submit" class="btn btn-block btn-lg w-100 text-light" style="background-color: #9F88FF;border-radius:15px;">Update Address</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<script>
    $("form").submit(function(e) {
        e.preventDefault();
        var data = new FormData($(this)[0]);
        data.append("edit_user", "");
        $.ajax({
            type: "post",
            url: window.location.href,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response == 1) {
                    alert('Details Updated');
                } else {
                    alert('Update Failed');
                }
            }
        });
    });
</script>