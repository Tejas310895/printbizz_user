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
            <div class="row">
                <div class="col-4">
                    <img src="https://www.bhmpics.com/downloads/solid-grey-wallpaper/42.12343168.jpg" class="img img-thumbnail border border-0 rounded-circle" alt="...">
                </div>
                <div class="col-7 pt-3 ps-0">
                    <h6>Tejas Shirsat</h6>
                    <h6 class="mb-0 text-black-50">+91 9867765397</h6>
                    <h6 class="mb-0 text-black-50">tshirsat700@gmail.com</h6>
                </div>
                <div class="col-1 text-start">
                    <button class="btn btn-transparent ps-0 pe-4" style="display: contents;" type="button">
                        <i class="fa-solid fa-pencil fa-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3 border border-0" style="border-radius: 15px;">
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
        </div>
    </div>
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