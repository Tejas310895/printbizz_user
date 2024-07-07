<?php

use App\Models\Orders;
use Config\Params;

?>
<div class="container bg-white shadow fixed-top py-2">
    <div class="row">
        <div class="col-1">
            <button class="btn btn-transparent" type="button" onclick="history.go(-1)">
                <i class="fa-solid fa-arrow-left fa-xl" style="color: #747474;"></i>
            </button>
        </div>
        <div class="col-11 ps-4 pt-2">
            <h5>Order Summary</h5>
        </div>
    </div>
</div>
<div class="container-fluid p-3 mt-5">
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
                </li>
            </ul>
        </div>
    </div>
    <div class="card mb-3 shadow border border-0" style="border-radius: 15px;">
        <div class="card-body">
            <?php
            $charges = json_decode($order['charges'], true);
            $tot_price = 0;
            $gst = $charges['gst'];
            $del_charges = $charges['del_charges'];
            foreach ($products as $items) :
            ?>
                <div class="row my-2">
                    <div class="col-2">
                        <img src="<?= Params::$admin_img . json_decode($items['img'], true)[0] ?>" class="d-block" style="border-radius: 8px;width:60px; height:60px;" alt="...">
                    </div>
                    <div class="col-7 pr-0">
                        <nav style="--bs-breadcrumb-divider: \'\" aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <h6 class="fw-bold mb-0"><?= $items['name'] ?></h6>
                                </li>
                                <li class="breadcrumb-item" aria-current="page"><i class="fa-regular fa-newspaper"></i> <small class=" fw-lighter mt-1"><?= $items['order_data']['pages'] ?> Pages X <?= $items['order_data']['copies'] ?></small></li>
                            </ol>
                        </nav>
                        <?php
                        $itemnary_string = '';
                        $product_price = $items['default_price'];
                        foreach ($items['group'] as $mval) {
                            $sub_string = $mval['name'] . ' :';
                            $sub_price = 0;
                            $counter = 0;
                            foreach ($mval['data'] as $gval) {
                                $sub_price += $gval['items']['price'];
                                if ($counter != 0) {
                                    $sub_string .= ' |';
                                }
                                $sub_string .=  ' ' . $gval['items']['name'] . ' ';
                                ++$counter;
                            }
                            $product_price += $sub_price;
                            $itemnary_string .= $sub_string . '<br>';
                        }

                        $itemnary_string .= count($items['order_data']['files']) . ' Files uploaded';

                        ?>
                        <h6 class="fw-bold mb-1" style="font-size: 10px;"><?= $itemnary_string ?></h6>
                    </div>
                    <div class="col-3 px-0">
                        <?php $tot_price += $product_price * ($items['order_data']['copies'] * $items['order_data']['pages']);
                        ?>
                        <h6 class="text-end pe-3 mt-3 fw-bold mb-0">₹ <?= $product_price * ($items['order_data']['copies'] * $items['order_data']['pages']) ?></h6>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="card mb-3 shadow border border-0" style="border-radius: 15px;">
        <div class="card-body">
            <div id="billing_container">
                <h6 class="mb-1 fs-6 text-secondary fw-bold mb-3">Bill Summary</h6>
                <div class="row border border-top-0 border-start-0 border-end-0">
                    <div class="col-8">
                        <h6 class="fw-bold" style="font-size:1rem;">Item Total</h6>
                    </div>
                    <div class="col-4 text-end">
                        <h6 class="fw-bold" style="font-size:1rem;">₹ <?= $tot_price ?></h6>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-8">
                        <h6 class="fw-light" style="font-size:0.9rem;">GST Charges</h6>
                    </div>
                    <div class="col-4 text-end">
                        <h6 class="fw-light" style="font-size:0.9rem;">₹ <?= $gst ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <h6 class="fw-light" style="font-size:0.9rem;">Delivery Charges</h6>
                    </div>
                    <div class="col-4 text-end">
                        <h6 class="fw-light" style="font-size:0.9rem;">₹ <?= $del_charges ?></h6>
                    </div>
                </div>
                <div class="row border border-bottom-0 border-start-0 border-end-0 pt-3">
                    <div class="col-8">
                        <h6 class="fw-bold fs-6">Grand Total</h6>
                    </div>
                    <div class="col-4 text-end">
                        <h6 class="fw-bold fs-6">₹ <?= $tot_price + $gst + $del_charges ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3 shadow border border-0" style="border-radius: 15px;">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="#" class="text-decoration-none text-info"> <i class="fa-solid fa-download"></i> Download Invoice</a></li>
                <li class="list-group-item"><a href="#" class="text-decoration-none text-secondary"> <i class="fa-solid fa-headset"></i> Get Support</a></li>
                <?php if (auth()->user()->getEmailIdentity()->email) : ?>
                    <li class="list-group-item"><button class="btn btn-link px-0 text-decoration-none text-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i class="fa-solid fa-comment-dots"></i> Raise Complaint</button></li>
                <?php else : ?>
                    <li class="list-group-item"><a href="<?= base_url() ?>/profile">Update your email to raise complaint</a></li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog m-0" style="width: 100%;">
        <?= form_open() ?>
        <div class="modal-content">
            <div class="modal-header py-2 border border-0">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Raise Complaint</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="order_id" value="<?= $order_id ?>">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="subject" id="floatingInput" max="25" placeholder="Enter the subject" required>
                    <label for="floatingInput">Subject</label>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" name="comments" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" required></textarea>
                    <label for="floatingTextarea2">Comments</label>
                </div>
            </div>
            <div class="modal-footer py-2 border border-0">
                <button type="submit" name="submit_complaint" class="btn btn-primary btn-block w-100">Submit Complaint</button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>