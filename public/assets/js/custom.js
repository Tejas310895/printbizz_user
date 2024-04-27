function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function login_call() {
    (async () => {
        /* inputOptions can be an object or Promise */
        const {
            value: mobile_number
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
  --animate-duration: 1s;
`
            },
            hideClass: {
                popup: `
  animate__animated
  animate__fadeOutDown
  --animate-duration: 1s;
`
            },
            html: `
            <div class="input-group">
                <span class="input-group-text bg-transparent border border-2 border-dark border-top-0 border-end-0 border-start-0" id="basic-addon1">+ 91</span>
                <input id="mobile_no" type="number" onKeyPress="if(this.value.length==10) return false;" class="form-control border border-2 border-dark border-top-0 border-end-0 border-start-0" aria-describedby="basic-addon1">
            </div>
            `,
            // focusConfirm: false,
            preConfirm: () => {
                var mobile_no = document.getElementById('mobile_no').value;
                if (mobile_no.length == 10) {
                    return document.getElementById("mobile_no").value;
                } else {
                    Swal.showValidationMessage(`Invalid mobile Number`);
                    $(".swal2-validation-message").css('font-size', 'small');
                    $(".swal2-validation-message").css('justify-content', 'flex-start');
                    $(".swal2-validation-message").css('margin-top', '0');
                    $(".swal2-validation-message").css('background-color', 'transparent');
                }
            }
        });
        if (mobile_number) {
            $.ajax({
                type: "post",
                url: 'login',
                data: { mobile_number },
                success: function (response) {
                    if (response.status == 1) {
                        (async () => {
                            /* inputOptions can be an object or Promise */
                            const {
                                value: otp
                            } = await Swal.fire({
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
          --animate-duration: 1s;
        `
                                },
                                hideClass: {
                                    popup: `
          animate__animated
          animate__fadeOutDown
          --animate-duration: 1s;
        `
                                },
                                html: `
                    <h6 class="text-start mb-2 fs-6">Sms sent to +91 ******`+ (response.postdata.mobile_number).slice(6,) + `<button type="button" class="btn btn-light text-danger py-0 to_back">Change</button></h6>
                    <div id="otp_input" class="row pt-0 pb-0 w-100" style="display: flex;justify-content: space-evenly;">
                        <div class="col-3 px-0" style="width: 70px;">
                            <input class="otp-letter-input" type="number" onKeyPress="if(this.value.length==1) return false;">
                        </div>
                        <div class="col-3 px-0" style="width: 70px;">
                            <input class="otp-letter-input" type="number" onKeyPress="if(this.value.length==1) return false;">
                        </div>
                        <div class="col-3 px-0" style="width: 70px;">
                            <input class="otp-letter-input" type="number" onKeyPress="if(this.value.length==1) return false;">
                        </div>
                        <div class="col-3 px-0" style="width: 70px;">
                            <input class="otp-letter-input" type="number" onKeyPress="if(this.value.length==1) return false;">
                        </div>
                    </div>
                    <h6 class="text-center mb-0 mt-2 fs-6">Didn't receive otp? <button type="button" class="btn btn-link text-danger py-0" id="resend_otp">Resend</button></h6>
                    `,
                                focusConfirm: false,
                                preConfirm: () => {
                                    var otp_str = '';
                                    $('.otp-letter-input').each(function (i, v) {
                                        if (v.value != '') {
                                            otp_str += v.value;
                                            v.style.borderColor = 'green';
                                        } else {
                                            v.style.borderColor = 'red';
                                        }
                                    });
                                    if (otp_str.length == 4) {
                                        $.ajax({
                                            type: "post",
                                            url: "otp_verification",
                                            data: { 'otp': otp_str, 'mobile_number': response.postdata.mobile_number },
                                            success: function (response) {
                                                if (response.valid == 1) {
                                                    if (response.name == 0) {
                                                        (async () => {
                                                            const { value: full_name } = await Swal.fire({
                                                                title: "Enter your fullname",
                                                                position: "bottom-end",
                                                                showCancelButton: false,
                                                                confirmButtonText: "Submit",
                                                                showLoaderOnConfirm: true,
                                                                allowOutsideClick: false,
                                                                showClass: {
                                                                    popup: `
                                                                    animate__animated
                                                                    animate__fadeInUp
                                                                    --animate-duration: 1s;
        `
                                                                },
                                                                hideClass: {
                                                                    popup: `
                                                                animate__animated
                                                                animate__fadeOutDown
                                                                --animate-duration: 1s;
        `
                                                                },
                                                                html: `
                                                                <div class="input-group">
                                                                    <input id="full_name" type="text" class="form-control border border-2 border-dark border-top-0 border-end-0 border-start-0" aria-describedby="basic-addon1">
                                                                </div>
                                                                `,
                                                                focusConfirm: false,
                                                                preConfirm: () => {
                                                                    var full_name = document.getElementById('full_name').value;
                                                                    if (full_name.length > 1) {
                                                                        $.ajax({
                                                                            type: "post",
                                                                            url: "add_fullname",
                                                                            data: { 'name': full_name },
                                                                            success: function (response) {
                                                                                if (response == 1) {
                                                                                    Swal.fire({
                                                                                        position: "bottom-end",
                                                                                        icon: "success",
                                                                                        title: "Login Successful",
                                                                                        showConfirmButton: false,
                                                                                        showClass: {
                                                                                            popup: `
                                                                              animate__animated
                                                                              animate__fadeInUp
                                                                              --animate-duration: 1s;
                                                                            `
                                                                                        },
                                                                                        hideClass: {
                                                                                            popup: `
                                                                              animate__animated
                                                                              animate__fadeOutDown
                                                                              --animate-duration: 1s;
                                                                            `
                                                                                        },
                                                                                        timer: 2000
                                                                                    });
                                                                                    setTimeout(() => {
                                                                                        window.location.reload();
                                                                                    }, 2500);
                                                                                    $(".swal2-container").addClass('p-0');
                                                                                    $(".swal2-modal").css('border-radius', '30px 30px 0px 0px');
                                                                                    $(".swal2-title").addClass('pt-1');
                                                                                    $(".swal2-title").css('font-size', '1.3rem');
                                                                                } else {
                                                                                    Swal.showValidationMessage(`Entry Failed! Try Again`);
                                                                                    $(".swal2-validation-message").css('font-size', 'small');
                                                                                    $(".swal2-validation-message").css('justify-content', 'flex-start');
                                                                                    $(".swal2-validation-message").css('margin-top', '0');
                                                                                    $(".swal2-validation-message").css('background-color', 'transparent');
                                                                                }
                                                                            }
                                                                        });
                                                                        return document.getElementById("full_name").value;
                                                                    } else {
                                                                        Swal.showValidationMessage(`Field is mandatory`);
                                                                        $(".swal2-validation-message").css('font-size', 'small');
                                                                        $(".swal2-validation-message").css('justify-content', 'flex-start');
                                                                        $(".swal2-validation-message").css('margin-top', '0');
                                                                        $(".swal2-validation-message").css('background-color', 'transparent');
                                                                    }
                                                                }
                                                            });
                                                            $(".swal2-container").addClass('p-0');
                                                            $(".swal2-modal").css('border-radius', '30px 30px 0px 0px');
                                                            $(".swal2-title").addClass('fs-6 pt-5 text-start');
                                                            $(".swal2-html-container").addClass('mx-3 mt-2');
                                                            $(".swal2-styled").addClass('btn btn-block btn-lg');
                                                            $(".swal2-actions").css('flex-direction', 'row-reverse');
                                                        })()
                                                    } else {
                                                        Swal.fire({
                                                            position: "bottom-end",
                                                            icon: "success",
                                                            title: "Login Successful",
                                                            showConfirmButton: false,
                                                            showClass: {
                                                                popup: `
                                                  animate__animated
                                                  animate__fadeInUp
                                                  --animate-duration: 1s;
                                                `
                                                            },
                                                            hideClass: {
                                                                popup: `
                                                  animate__animated
                                                  animate__fadeOutDown
                                                  --animate-duration: 1s;
                                                `
                                                            },
                                                            timer: 2000
                                                        });
                                                        setTimeout(() => {
                                                            window.location.reload();
                                                        }, 2500);
                                                    }
                                                    $(".swal2-container").addClass('p-0');
                                                    $(".swal2-modal").css('border-radius', '30px 30px 0px 0px');
                                                    $(".swal2-title").addClass('fs-6 pt-5 text-start');
                                                    $(".swal2-html-container").addClass('mx-3 mt-2');
                                                    $(".swal2-styled").addClass('btn btn-block btn-lg');
                                                    $(".swal2-actions").css('flex-direction', 'row-reverse');
                                                    // setTimeout(() => {
                                                    //     window.location.reload();
                                                    // }, 2500);
                                                }
                                            }
                                        });
                                        $('.otp-letter-input').val('');
                                        Swal.showValidationMessage(`Invalid OTP`);
                                        $(".swal2-validation-message").css('font-size', 'small');
                                        $(".swal2-validation-message").css('margin-top', '0');
                                        $(".swal2-validation-message").css('background-color', 'transparent');
                                    } else {
                                        Swal.showValidationMessage(`Invalid OTP`);
                                        $(".swal2-validation-message").css('font-size', 'small');
                                        $(".swal2-validation-message").css('margin-top', '0');
                                        $(".swal2-validation-message").css('background-color', 'transparent');
                                    }
                                }
                            });
                            // if (otp) {
                            //     $.ajax({
                            //         type: "post",
                            //         url: "otp_verification",
                            //         data: { 'otp': otp },
                            //         success: function (result) {
                            //             Swal.showValidationMessage(`Invalid OTP`);
                            //             $(".swal2-validation-message").css('font-size', 'small');
                            //             $(".swal2-validation-message").css('margin-top', '0');
                            //             $(".swal2-validation-message").css('background-color', 'transparent');
                            //         }
                            //     });
                            // }
                        })()
                        $(".swal2-container").addClass('p-0');
                        $(".swal2-modal").css('border-radius', '30px 30px 0px 0px');
                        $(".swal2-title").addClass('fs-6 pt-5 text-start');
                        $(".swal2-html-container").addClass('mx-3 mt-0');
                        $(".swal2-styled").addClass('btn btn-block');
                        $(".swal2-actions").addClass('mt-1 w-100 px-3');
                        $(".swal2-actions").css('flex-direction', 'row-reverse');
                        $('.to_back').click(function (e) {
                            e.preventDefault();
                            login_call();
                        });
                        var elts = document.getElementsByClassName('otp-letter-input');
                        Array.from(elts).forEach(function (elt) {
                            elt.addEventListener("keyup", function (event) {
                                // Number 13 is the "Enter" key on the keyboard
                                if (event.keyCode === 13 || elt.value.length == 1) {
                                    // Focus on the next sibling
                                    elt.style.borderColor = 'green';
                                    elt.parentElement.nextElementSibling.firstElementChild.focus();
                                }
                            });
                        });
                        $('#resend_otp').click(function (e) {
                            e.preventDefault();
                            $.ajax({
                                type: "post",
                                url: "resend_otp",
                                success: function (response) {
                                    Swal.showValidationMessage(`Otp Sent Successfully`);
                                    if (response.status == 1) {
                                        var counter = 20;
                                        var interval = setInterval(function () {
                                            counter--;
                                            // Display 'counter' wherever you want to display it.
                                            if (counter <= 0) {
                                                clearInterval(interval);
                                                $('#resend_otp').removeAttr('disabled');
                                                $('#resend_otp').text("Resend");
                                                return;
                                            } else {
                                                $('#resend_otp').attr('disabled', 'disabled');
                                                $('#resend_otp').text('Resend otp in ' + counter + ' sec');
                                            }
                                        }, 1000);
                                    }
                                }
                            });
                        });
                        var counter = 10;
                        var interval = setInterval(function () {
                            counter--;
                            // Display 'counter' wherever you want to display it.
                            if (counter <= 0) {
                                clearInterval(interval);
                                $('#resend_otp').removeAttr('disabled');
                                $('#resend_otp').text("Resend");
                                return;
                            } else {
                                $('#resend_otp').attr('disabled', 'disabled');
                                $('#resend_otp').text('Resend otp in ' + counter + ' sec');
                            }
                        }, 1000);
                    } else if (response.status == 2) {
                        console.log('login');
                    } else {
                        console.log('failed');
                    }
                }
            });
        }
    })()
    $(".swal2-container").addClass('p-0');
    $(".swal2-modal").css('border-radius', '30px 30px 0px 0px');
    $(".swal2-title").addClass('fs-6 pt-5 text-start');
    $(".swal2-html-container").addClass('mx-3 mt-2');
    $(".swal2-styled").addClass('btn btn-block btn-lg');
    $(".swal2-actions").css('flex-direction', 'row-reverse');
};