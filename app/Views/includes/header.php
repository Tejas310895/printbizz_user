<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, target-densityDpi=device-dpi, minimal-ui' />
    <link rel=" icon" type="image/x-icon" href="public/assets/images/logo.jpg">
    <?php echo link_tag('public/assets/css/bootstrap.css?v=' . fileatime('public/assets/css/bootstrap.css')); ?>
    <?php echo link_tag('public/assets/css/bootstrap.min.css?v=' . fileatime('public/assets/css/bootstrap.min.css')); ?>
    <?php echo link_tag('public/assets/css/styles.css?v=' . filemtime('public/assets/css/styles.css')); ?>
    <?php echo link_tag('public/assets/fontawsm/css/all.css?v=' . fileatime('public/assets/fontawsm/css/all.css')); ?>
    <?php echo link_tag('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css'); ?>
    <?php echo link_tag('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css'); ?>
    <?php echo script_tag('public/assets/js/bootstrap.js?v=' . fileatime('public/assets/js/bootstrap.js')); ?>
    <?php echo script_tag('public/assets/js/bootstrap.min.js?v=' . fileatime('public/assets/js/bootstrap.min.js')); ?>
    <?php echo script_tag('public/assets/js/custom.js?v=' . fileatime('public/assets/js/custom.js')); ?>
    <?php echo script_tag('public/assets/fontawsm/js/all.js?v=' . fileatime('public/assets/fontawsm/js/all.js')); ?>
    <?php echo script_tag('public/assets/jquery/jquery.js?v=' . fileatime('public/assets/jquery/jquery.js')); ?>
    <?php echo script_tag('public/assets/jquery/corner.js?v=' . fileatime('public/assets/jquery/corner.js')); ?>
    <?php echo script_tag('https://cdn.jsdelivr.net/npm/sweetalert2@11'); ?>
    <title>Printbizz</title>
</head>

<body>