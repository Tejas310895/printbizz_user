<div class="container bg-white shadow fixed-top py-2">
    <div class="row">
        <div class="col-1">
            <button class="btn btn-transparent" type="button" onclick="history.go(-1)">
                <i class="fa-solid fa-arrow-left fa-xl" style="color: #747474;"></i>
            </button>
        </div>
        <div class="col-11 ps-5 pt-2">
            <h5>Your Profile</h5>
        </div>
    </div>
</div>
<div class="container-fluid h-100" style="background:#F0F0F0;height: 100vh !important;overflow-y:scroll;padding-top: 82px !important;">
    <div class="card mb-3 border border-0" style="border-radius: 15px;">
        <div class="card-body">

            <?php
            if (auth()->user()) :
            ?>
                <div class="row">
                    <div class="col-4">
                        <p data-letters="<?= strtoupper(substr(auth()->user()->getEmailIdentity()->name, 0, 1)) ?>" class="mb-0"></p>
                    </div>
                    <div class="col-7 pt-3 ps-0">
                        <h6><?= auth()->user()->getEmailIdentity()->name ?></h6>
                        <h6 class="mb-0 text-black-50">+91 <?= auth()->user()->email ?></h6>
                        <h6 class="mb-0 text-black-50">tshirsat700@gmail.com</h6>
                    </div>
                    <div class="col-1 text-start">
                        <button class="btn btn-transparent ps-0 pe-4" style="display: contents;" type="button">
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
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <?php for ($i = 0; $i < 10; $i++) : ?>
                        <div class="card mb-3 border border-0 shadow-sm">
                            <div class="card-body py-1">
                                <div class="step_container d-flex justify-content-center align-items-center">

                                    <div class="progresses">

                                        <div class="steps" style="background: #4bb7ff;">
                                            <p class="text-dark fw-bold text-uppercase" style="display:block;position:absolute;top:5vh;font-size:0.5rem;">Placed</p>
                                            <span><i class="fa-solid fa-check"></i></span>
                                        </div>

                                        <span class="line" style="background: #4bb7ff;"></span>

                                        <div class="steps" style="background: #4bb7ff;">
                                            <p class="text-dark fw-bold text-uppercase" style="display:block;position:absolute;top:5vh;font-size:0.5rem;">In Process</p>
                                            <span><i class="fa-solid fa-check"></i></span>
                                        </div>

                                        <span class="line" style="background: #D1D1D1;"></span>

                                        <div class="steps" style="background: #D1D1D1;">
                                            <p class="text-dark fw-bold text-uppercase" style="display:block;position:absolute;top:5vh;font-size:0.5rem;">Out For Delivery</p>
                                            <span></span>
                                        </div>


                                        <span class="line" style="background: #D1D1D1;"></span>

                                        <div class="steps" style="background: #D1D1D1;">
                                            <p class="text-dark fw-bold text-uppercase" style="display:block;position:absolute;top:5vh;font-size:0.5rem;">Delivered</p>
                                            <span class="font-weight-bold"></span>
                                        </div>

                                    </div>

                                </div>
                                <!-- <ol class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-start border border-0">
                                    <div class="ms-2 me-auto"> -->
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center border border-0 px-1">
                                        <figure class="mb-0 mt-2">
                                            <blockquote class="blockquote" style="font-size: 0.7rem;">
                                                <p class="text-dark fw-bold">Estimated Delivery time</p>
                                            </blockquote>
                                            <figcaption class="blockquote-footer mb-0" style="font-size:0.7rem;">
                                                Fri, 26-04-2-24 09:00 - 11:00 PM
                                            </figcaption>
                                        </figure>
                                        <span class="badge bg-white rounded-pill">
                                            <button class="btn btn-primary p-0 rounded-circle mt-2" type="button">
                                                <i class="fa-solid fa-circle-chevron-right fa-xl"></i>
                                            </button>
                                        </span>
                                    </li>
                                </ul>
                                <!-- <div class="fw-light" style="font-size:0.6rem;">Arriving</div>
                                        <h6 class="fw-bold" style="font-size:0.7rem;"> <span><i class="fa-solid fa-person-biking fa-lg"></i></span> Fri, 26-04-2-24 09:00 - 11:00 PM</h6> -->
                                <!-- </div>
                                    <span class="badge bg-primary rounded-pill"><i class="fa-solid fa-chevron-right"></i></span>
                                </li>
                            </ol> -->
                            </div>
                        </div>
                    <?php endfor ?>
                </ul>
            </div>
        </div>
    <?php endif ?>
    <div class="card mb-3 border border-0" style="border-radius: 15px;">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="#" class="text-decoration-none text-secondary">About Us</a></li>
                <li class="list-group-item"><a href="#" class="text-decoration-none text-secondary">Payment Policy</a></li>
                <li class="list-group-item"><a href="#" class="text-decoration-none text-secondary">Privacy Policy</a></li>
                <li class="list-group-item"><a href="#" class="text-decoration-none text-secondary">Terms & Conditions</a></li>
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
<div class="modal fade" id="profile_add" tabindex="-1" aria-labelledby="profile_add" aria-hidden="true">
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
</div>