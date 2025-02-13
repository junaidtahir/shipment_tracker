<?php
 include './includes/db.php';

// Get Tracking ID from URL
$tracking_id = isset($_GET['tracking_id']) ? $_GET['tracking_id'] : '';

if ($tracking_id) {
    // Fetch Parcel Data
    $stmt = $conn->prepare("SELECT * FROM parcels WHERE tracking_id = ?");
    $stmt->bind_param("s", $tracking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if Data Exists
    if ($result->num_rows > 0) {
        $parcel = $result->fetch_assoc();
        $parcel_id = $parcel['id'];  // Get parcel ID

        // Fetch Parcel Tracking History (Using parcel_id, NOT tracking_id)
        $history_stmt = $conn->prepare("SELECT * FROM parcel_locations WHERE parcel_id = ? ORDER BY updated_at ASC");
        $history_stmt->bind_param("i", $parcel_id);
        $history_stmt->execute();
        $history_result = $history_stmt->get_result();
    } else {
        $error = "No tracking data found for ID: <b>$tracking_id</b>";
    }
} else {
    $error = "Invalid tracking ID.";
}
?>


<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>

        Track US0220430064NG - Nationwide Express Delivery and Security

    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">




    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon"
        href="https://www.nationwidexpressdeliverysecurity.com/static/img/favicon.ico">
    <!-- Place favicon.ico in the root directory -->


    <!-- CSS here -->
    <link rel="stylesheet" href="https://www.nationwidexpressdeliverysecurity.com/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.nationwidexpressdeliverysecurity.com/static/css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://www.nationwidexpressdeliverysecurity.com/static/css/magnific-popup.css">
    <link rel="stylesheet" href="https://www.nationwidexpressdeliverysecurity.com/static/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.nationwidexpressdeliverysecurity.com/static/css/themify-icons.css">
    <link rel="stylesheet" href="https://www.nationwidexpressdeliverysecurity.com/static/css/nice-select.css">
    <link rel="stylesheet" href="https://www.nationwidexpressdeliverysecurity.com/static/css/flaticon.css">
    <link rel="stylesheet" href="https://www.nationwidexpressdeliverysecurity.com/static/css/gijgo.css">
    <link rel="stylesheet" href="https://www.nationwidexpressdeliverysecurity.com/static/css/animate.css">
    <link rel="stylesheet" href="https://www.nationwidexpressdeliverysecurity.com/static/css/slick.css">
    <link rel="stylesheet" href="https://www.nationwidexpressdeliverysecurity.com/static/css/slicknav.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">

    <link rel="stylesheet" href="https://www.nationwidexpressdeliverysecurity.com/static/css/style.css">
    <link href="https://www.nationwidexpressdeliverysecurity.com/static/css/jquery.contactus.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://www.nationwidexpressdeliverysecurity.com/static/css/custom_navbar.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://www.nationwidexpressdeliverysecurity.com/static/css/responsive.css">
    <style>
        .home_header {
            color: #fff;
            font-size: 2.5em;
            line-height: 1.4;
            text-transform: capitalize;
            /*width: 50%;*/
            font-weight: 700;
            word-spacing: 4px;
            letter-spacing: 1px;
        }

        /*PRELOADING------------ */
        .preloader {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-image: url('../../../static/Internet.gif');
            background-repeat: no-repeat;
            background-color: #FFF;
            background-position: center;
        }
    </style>

</head>

<body>
    <link rel="stylesheet" href="https://www.nationwidexpressdeliverysecurity.com/static/css/bootstrap.min.css">
    <link href="https://www.nationwidexpressdeliverysecurity.com/static/css/progress-wizard.min.css" rel="stylesheet">
    <style>
        .marquee {
            width: 80.5%;
            margin: 0 auto;
            white-space: nowrap;
            overflow: hidden;
            box-sizing: border-box;
        }

        .marquee span {
            display: inline-block;
            padding-left: 100%;
            /* show the marquee just outside the paragraph */
            animation: marquee 25s linear infinite;
        }

        .marquee span:hover {
            animation-play-state: paused
        }

        .wthree_pvt_title {
            margin-bottom: 4em;
        }

        h4.w3pvt-title {
            color: #000;
            text-transform: capitalize;
            font-size: 2.3em;
            font-weight: 600;
        }

        p.sub-title {
            color: #999;
            text-transform: capitalize;
            width: 60%;
            margin: 1em auto 0;
        }

        /* Make it move */

        @keyframes marquee {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(-100%, 0);
            }
        }
    </style>

    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Track <?= htmlspecialchars($tracking_id) ?></h3>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb d-flex justify-content-center">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($tracking_id) ?></li>
        </ol>
    </nav>
    <!-- //breadcrumbs -->
    <section>
        <div class="container">

            <div class="toast float-right" data-autohide="false">
                <div class="toast-body">
                    <div class="mr-auto" id="date-part">Current Date: <kbd></kbd></div>
                    <div id="time-part">Current Time: <kbd></kbd></div>
                </div>
            </div>
        </div>
        <br><br>
    </section>
    <br><br>
    <!-- contact -->
    <div class="container">
        <div class="wthree_pvt_title text-center">
            <h4 class="w3pvt-title">Parcel Details
            </h4>
            <p class="sub-title" id="pack_status">Your Package is on the way.</p>
        </div>

        <div class="row">
            <h4 class="mx-auto">
                <small><span class="spinner-grow text-primary"></span></small> Real-Time Location
            </h4>
            <div class="col-md-12 col-sm-12">
                <ul class="progress-indicator custom-complex">
                    <?php if (isset($history_result) && $history_result->num_rows > 0): ?>
                        <?php while ($location = $history_result->fetch_assoc()): ?>
                            <li name="route_path" details_attr="<?= htmlspecialchars($location['id']) ?>">
                                <span class="bubble"></span> <?= htmlspecialchars($location['location']) ?>
                                <span class="bubble"></span> <?= htmlspecialchars($location['delivered']) ?>

                            </li>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <li><span class="bubble"></span> No tracking history available.</li>
                    <?php endif; ?>

                    <li name="route_path" details_attr="receiver_destination">
                        <span class="bubble"></span><?= htmlspecialchars($parcel['receiver_address'] ?? 'N/A') ?>
                    </li>
                </ul>
                <h5 class="text-center" id="status">Status: <?= isset($parcel['status']) ? htmlspecialchars($parcel['status']) : 'Unknown' ?></h5>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-lg-1 col-md-1 col-sm-1"></div>
            <div class="col-lg-10 col-md-10 col-sm-10">
                <div class="card border border-top-0 shadow" style="border-color: #1064B3;">
                    <div class="row">
                        <div class="col-sm-3 col-md-3"></div>
                        <div class="col-sm-9 col-md-9 pb-4 ml-3" style="margin-top: 1em;">
                            <dl class="row">
                                <dt class="col-5">Date of Arrival</dt>
                                <dd class="col-7 pl-1"><?= htmlspecialchars($parcel['arrival_date'] ?? 'N/A') ?></dd>
                            </dl>
                            <dl class="row">
                                <dt class="col-5">Estimated Time of Arrival</dt>
                                <dd class="col-7 pl-1"><?= htmlspecialchars($parcel['estimated_time'] ?? 'N/A') ?></dd>
                            </dl>

                            <div class="row">
                                <div class="col-sm-5 col-md-5 col-xs-12">
                                    <button class="btn btn-info btn-sm" data-toggle="collapse" data-target="#more_info">View More Information</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="more_info" class="collapse">
                        <hr>
                        <!-- Sender's Information -->
                        <div class="row">
                            <div class="col-sm-1 col-md-1"></div>
                            <div class="col-sm-10 col-md-10 ml-3">
                                <h6 class="collapse-header">
                                    <span class="badge badge-secondary">Sender's Information</span>
                                </h6>
                                <br>
                                <div class="card-text">
                                    <dl class="row">
                                        <dt class="col-4">Full Name</dt>
                                        <dd class="col-8"><?= htmlspecialchars($parcel['sender_name'] ?? 'N/A') ?></dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-4">Phone Number</dt>
                                        <dd class="col-8"><?= htmlspecialchars($parcel['sender_phone'] ?? 'N/A') ?></dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-4">Country</dt>
                                        <dd class="col-8"><?= htmlspecialchars($parcel['sender_country'] ?? 'N/A') ?></dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-4">Address</dt>
                                        <dd class="col-8"><?= htmlspecialchars($parcel['sender_address'] ?? 'N/A') ?></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="col-sm-1 col-md-1"></div>
                        </div>

                        <hr>
                        <!-- Receiver's Information -->
                        <div class="row">
                            <div class="col-sm-1 col-md-1"></div>
                            <div class="col-sm-10 col-md-10 ml-3">
                                <h6 class="collapse-header">
                                    <span class="badge badge-secondary">Receiver's Information</span>
                                </h6>
                                <br>
                                <div class="card-text">
                                    <dl class="row">
                                        <dt class="col-4">Full Name</dt>
                                        <dd class="col-8"><?= htmlspecialchars($parcel['receiver_name'] ?? 'N/A') ?></dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-4">Phone Number</dt>
                                        <dd class="col-8"><?= htmlspecialchars($parcel['receiver_phone'] ?? 'N/A') ?></dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-4">Country</dt>
                                        <dd class="col-8"><?= htmlspecialchars($parcel['receiver_country'] ?? 'N/A') ?></dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-4">Address</dt>
                                        <dd class="col-8"><?= htmlspecialchars($parcel['receiver_address'] ?? 'N/A') ?></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="col-sm-1 col-md-1"></div>
                        </div>

                        <hr>
                        <!-- Consignment Information -->
                        <div class="row">
                            <div class="col-sm-1 col-md-1"></div>
                            <div class="col-sm-10 col-md-10 ml-3">
                                <h6 class="collapse-header">
                                    <span class="badge badge-secondary">Consignment Information</span>
                                </h6>
                                <br>
                                <div class="card-text">
                                    <dl class="row">
                                        <dt class="col-4">Parcel No</dt>
                                        <dd class="col-8"><?= htmlspecialchars($tracking_id) ?></dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-4">Mode of Transport</dt>
                                        <dd class="col-8"><?= htmlspecialchars($parcel['mode_of_transport'] ?? 'N/A') ?></dd>
                                    </dl>
                                    <dl class="row">
                                        <dt class="col-4">Sent Date</dt>
                                        <dd class="col-8"><?= htmlspecialchars($parcel['sent_date'] ?? 'N/A') ?></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="col-sm-1 col-md-1"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1"></div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.27/moment-timezone-with-data.min.js"></script>
        <script type="text/javascript"
            src="https://www.nationwidexpressdeliverysecurity.com/static/js/my_translation_text.js"></script>


        <div id="contact"></div>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Select Language</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="list-group list-group-flush">



                            <a class="list-group-item list-group-item-action" name="lang_list" id="id_en"
                                href="/en/show/track-item-US0220430064NG/" style="cursor: pointer;" data_lang="en"><img src="" width="30">
                                English <i class="fa fa-check-circle"></i></a>



                            <a class="list-group-item list-group-item-action" name="lang_list" id="id_zh-hans"
                                href="/zh-hans/show/track-item-US0220430064NG/" style="cursor: pointer;" data_lang="zh-hans"><img src=""
                                    width="30"> Chinese</a>



                            <a class="list-group-item list-group-item-action" name="lang_list" id="id_ja"
                                href="/ja/show/track-item-US0220430064NG/" style="cursor: pointer;" data_lang="ja"><img src="" width="30">
                                Japanese</a>



                            <a class="list-group-item list-group-item-action" name="lang_list" id="id_ko"
                                href="/ko/show/track-item-US0220430064NG/" style="cursor: pointer;" data_lang="ko"><img src="" width="30">
                                Korean</a>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JS here -->
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/popper.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/bootstrap.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/owl.carousel.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/isotope.pkgd.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/ajax-form.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/waypoints.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/jquery.counterup.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/imagesloaded.pkgd.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/scrollIt.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/jquery.scrollUp.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/wow.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/nice-select.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/jquery.slicknav.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/jquery.magnific-popup.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/plugins.js"></script>
        <!-- <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/gijgo.min.js"></script> -->
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/slick.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/custom_navbar.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/jquery.contactus.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/jquery.countdown.min.js"></script>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.27/moment-timezone-with-data.min.js"></script>
        <script type="text/javascript"
            src="https://www.nationwidexpressdeliverysecurity.com/static/js/my_translation_text.js"></script>


        <!--contact js-->
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/contact.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/jquery.ajaxchimp.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/jquery.form.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/jquery.validate.min.js"></script>
        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/mail-script.js"></script>


        <script src="https://www.nationwidexpressdeliverysecurity.com/static/js/main.js"></script>


</body>

</html>