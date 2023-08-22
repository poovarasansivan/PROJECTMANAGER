<?php

$path = $GLOBALS['_path'];
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project Manager</title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $path ?>/assets/img/favicons/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $path ?>/assets/img/favicons/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $path ?>/assets/img/favicons/logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $path ?>/assets/img/favicons/logo.ico">
    <link rel="manifest" href="<?php echo $path ?>/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="<?php echo $path ?>/assets/img/favicons/logo.png">
    <meta name="theme-color" content="#ffffff">
    <script src="<?php echo $path ?>/assets/vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo $path ?>/assets/vendors/simplebar/simplebar.min.js"></script>
    <script src="<?php echo $path ?>/assets/js/config.js"></script>

    <!--    Stylesheets-->
    <link href="<?php echo $path ?>/assets/vendors/dropzone/dropzone.min.css" rel="stylesheet">
    <link href="<?php echo $path ?>/assets/vendors/prism/prism-okaidia.css" rel="stylesheet">

    <link href="<?php echo $path ?>/assets/vendors/choices/choices.min.css" rel="stylesheet">
    <link href="<?php echo $path ?>/assets/css/custom.css" rel="stylesheet">
    <link href="<?php echo $path ?>/assets/vendors/dhtmlx-gantt/dhtmlxgantt.css" rel="stylesheet">
    <link href="<?php echo $path ?>/assets/vendors/flatpickr/flatpickr.min.css" rel="stylesheet">
    <link rel="preconnect" href="../../../fonts.googleapis.com/index.html">
    <link rel="preconnect" href="../../../../fonts.gstatic.com/index.html" crossorigin="">
    <link
        href="../../../fonts.googleapis.com/css275fb.css?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link href="<?php echo $path ?>/assets/vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $path ?>/../../../unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="<?php echo $path ?>/assets/css/theme-rtl.min.css" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="<?php echo $path ?>/assets/css/theme.min.css" type="text/css" rel="stylesheet" id="style-default">
    <link href="<?php echo $path ?>/assets/css/user-rtl.min.css" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="<?php echo $path ?>/assets/css/user.min.css" type="text/css" rel="stylesheet" id="user-style-default">
    <link href="<?php echo $path ?>/assets/css/alert.css" type="text/css" rel="stylesheet" id="user-style-default">
    
    <!-- filter links -->
    
    <script>
        var phoenixIsRTL = window.config.config.phoenixIsRTL;
        if (phoenixIsRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>