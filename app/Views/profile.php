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
            <button type="button" id="login_sweet_alert" class="btn btn-block btn-lg w-100 text-light" style="background-color: #9F88FF;border-radius:15px;">Login</button>
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
<script>
    $('#login_sweet_alert').click(function(e) {
        e.preventDefault();
        (async () => {
            /* inputOptions can be an object or Promise */
            const {
                value: formValues
            } = await Swal.fire({
                title: "Login / Sign up with your phone number",
                position: "bottom-end",
                showCancelButton: true,
                confirmButtonText: "Send Otp",
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                showClass: {
                    popup: `
      animate__animated
      animate__fadeInUp
      --animate-duration: 2s;
    `
                },
                hideClass: {
                    popup: `
      animate__animated
      animate__fadeOutDown
      --animate-duration: 2s;
    `
                },
                html: `
                <div class="input-group">
                    <span class="input-group-text bg-transparent border border-2 border-dark border-top-0 border-end-0 border-start-0" id="basic-addon1">+ 91</span>
                    <input type="number" class="form-control border border-2 border-dark border-top-0 border-end-0 border-start-0" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                `,
                // focusConfirm: false,
                preConfirm: () => {
                    Swal.fire({
                        title: "Enter the OTP",
                        position: "bottom-end",
                        showCancelButton: true,
                        confirmButtonText: "Verify Otp",
                        cancelButtonText: "Cancel",
                        showLoaderOnConfirm: true,
                        allowOutsideClick: false,
                        showClass: {
                            popup: `
      animate__animated
      animate__fadeInUp
      --animate-duration: 2s;
    `
                        },
                        hideClass: {
                            popup: `
      animate__animated
      animate__fadeOutDown
      --animate-duration: 2s;
    `
                        },
                        html: `
                <h6 class="text-start mb-2 fs-6">Sms sent to +91 ******5397<button type="button" class="btn btn-light text-danger py-0 to_back">Change</button></h6>
                <div class="row pt-0 pb-0 w-100" style="display: flex;justify-content: space-evenly;">
                    <div class="col-3 px-0" style="width: 70px;">
                        <input class="otp-letter-input" type="text">
                    </div>
                    <div class="col-3 px-0" style="width: 70px;">
                        <input class="otp-letter-input" type="text">
                    </div>
                    <div class="col-3 px-0" style="width: 70px;">
                        <input class="otp-letter-input" type="text">
                    </div>
                    <div class="col-3 px-0" style="width: 70px;">
                        <input class="otp-letter-input" type="text">
                    </div>
                </div>
                <h6 class="text-center mb-0 mt-2 fs-6">Didn't receive otp? <button type="button" class="btn btn-link text-danger py-0">Resend</button></h6>
                `,
                        // focusConfirm: false,
                        preConfirm: () => {

                            return [
                                document.getElementById("swal-input1").value,
                                document.getElementById("swal-input2").value
                            ];
                        }
                    });
                    $(".swal2-container").addClass('p-0');
                    $(".swal2-modal").css('border-radius', '30px 30px 0px 0px');
                    $(".swal2-title").addClass('fs-6 pt-5 text-start');
                    $(".swal2-html-container").addClass('mx-3 mt-0');
                    $(".swal2-styled").addClass('btn btn-block');
                    $(".swal2-actions").addClass('mt-1 w-100 px-3');
                    $(".swal2-actions").css('flex-direction', 'row-reverse');
                    $('.to_back').click(function(e) {
                        e.preventDefault();
                        $('#login_sweet_alert').trigger('click');
                    });
                    return [
                        document.getElementById("swal-input1").value,
                        document.getElementById("swal-input2").value
                    ];
                }
            });
            if (formValues) {
                Swal.fire(JSON.stringify(formValues));
            }
        })()
        $(".swal2-container").addClass('p-0');
        $(".swal2-modal").css('border-radius', '30px 30px 0px 0px');
        $(".swal2-title").addClass('fs-6 pt-5 text-start');
        $(".swal2-html-container").addClass('mx-3 mt-2');
        $(".swal2-styled").addClass('btn btn-block btn-lg');
        $(".swal2-actions").css('flex-direction', 'row-reverse');
    });
</script>