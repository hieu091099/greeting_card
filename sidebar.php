<?php
header('Access-Control-Allow-Origin: *');
require("function.php");
if (!checkLogin()) {
    header('Location: login.php');
}
if (isset($_GET['lang']) && !empty($_GET['lang'])) {
    if ($_GET['lang'] != 'en' && $_GET['lang'] != 'tw' && $_GET['lang'] != 'vn') {
        $_SESSION['lang'] = 'en';
    } else {
        $_SESSION['lang'] = $_GET['lang'];
    }
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/greetingcard/language/language.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Greeting Card</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <base href="http://localhost/greetingcard/">
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Gabriela&display=swap" rel="stylesheet">

    <!-- vendor css -->
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="assets/css/mdb.min.css">
    <link rel="stylesheet" href="assets/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/DataTables/FixedHeader-3.2.1/css/fixedHeader.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar menupos-fixed menu-light brand-blue ">
        <div class="navbar-wrapper ">
            <div class="navbar-brand header-logo">
                <a href="index.php" class="b-brand">
                    <!-- <img src="./assets/images/logo.svg" alt="" class="logo images"> -->
                    <h5 class="logo images text-white mb-0"><?php echo $greeting_card; ?></h5>
                    <!-- <img style="width:30px;height:30px" src="./assets/images/logo_thumb2.png" alt="" class="logo-thumb images"> -->
                    <div class="logo-thumb images"><a href="#!"><i class="fa fa-align-justify text-w-info f-30"></i></a>
                    </div>
                </a>
                <a class="mobile-menu" id="mobile-collapse" style="cursor:pointer"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <!-- <li class="nav-item pcoded-menu-caption">
						<label>Navigation</label>
					</li> -->
                    <li class="nav-item">
                        <a href="index.php" class="nav-link"><span class="pcoded-micon"><i
                                    class="feather icon-home"></i></span><span
                                class="pcoded-mtext"><?php echo $dash_board; ?></span></a>
                    </li>
                    <li class="nav-item">
                        <a href="./modules/customer.php" class="nav-link"><span class="pcoded-micon"><i
                                    class="feather icon-users"></i></span><span
                                class="pcoded-mtext"><?php echo $customer; ?></span></a>
                    </li>
                    <!-- <li class="nav-item pcoded-menu-caption">
						<label>UI Element</label>
					</li> -->
                    <li class="nav-item pcoded-hasmenu">
                        <a class="nav-link"><span class="pcoded-micon"><i
                                    class="feather icon-file-text"></i></span><span
                                class="pcoded-mtext"><?php echo $greeting_card; ?></span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="./modules/card.php" class="">Card Background</a></li>
                            <li class=""><a href="./modules/card_setting.php" class="">Card Text</a></li>
                        </ul>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a class="nav-link"><span class="pcoded-micon"><i class="feather icon-mail"></i></span><span
                                class="pcoded-mtext"><?php echo $mail; ?></span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="./modules/mail_log.php" class="">Sending Log</a></li>
                            <li class=""><a href="./modules/mail_handle.php" class="">Send Card Manually</a></li>
                            <li class=""><a href="./modules/mail.php" class="">Mail Configuration</a></li>
                        </ul>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a class="nav-link"><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span
                                class="pcoded-mtext"><?php echo $system; ?></span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="./modules/user.php" class="">User Account</a></li>
                            <li class=""><a href="./modules/manager.php" class="">Managers</a></li>
                            <li class=""><a href="./modules/job_position.php" class="">Job Position</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" style="cursor:pointer"><span></span></a>
            <a href="index.php" class="b-brand">
                <!-- <img src="./assets/images/logo.svg" alt="" class="logo images"> -->
                <h5 class="logo images text-white mb-0"><?php echo $greeting_card; ?></h5>
                <img src="./assets/images/logo-icon.svg" alt="" class="logo-thumb images">
            </a>
        </div>
        <a class="mobile-menu" id="mobile-header" style="cursor:pointer">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <a href="#!" class="mob-toggler"></a>
            <!-- <ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<div class="main-search open">
						<div class="input-group">
							<input type="text" id="m-search" class="form-control" placeholder="Search . . .">
							<a href="#!" class="input-group-append search-close">
								<i class="feather icon-x input-group-text"></i>
							</a>
							<span class="input-group-append search-btn btn btn-primary">
								<i class="feather icon-search input-group-text"></i>
							</span>
						</div>
					</div>
				</li>
			</ul> -->
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                class="icon feather icon-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">Notifications</h6>
                                <div class="float-right">
                                    <a href="#!" class="m-r-10">mark as read</a>
                                    <a href="#!">clear all</a>
                                </div>
                            </div>
                            <ul class="noti-body">
                                <li class="n-title">
                                    <p class="m-b-0">NEW</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="./assets/images/user_avatar.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>John Doe</strong><span class="n-time text-muted"><i
                                                        class="icon feather icon-clock m-r-10"></i>5 min</span></p>
                                            <p>New ticket Added</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="n-title">
                                    <p class="m-b-0">EARLIER</p>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="./assets/images/user_avatar.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i
                                                        class="icon feather icon-clock m-r-10"></i>10 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="./assets/images/user_avatar.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i
                                                        class="icon feather icon-clock m-r-10"></i>12 min</span></p>
                                            <p>currently login</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="./assets/images/user_avatar.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i
                                                        class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="./assets/images/user_avatar.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i
                                                        class="icon feather icon-clock m-r-10"></i>1 hour</span></p>
                                            <p>currently login</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="notification">
                                    <div class="media">
                                        <img class="img-radius" src="./assets/images/user_avatar.jpg"
                                            alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>Joseph William</strong><span class="n-time text-muted"><i
                                                        class="icon feather icon-clock m-r-10"></i>2 hour</span></p>
                                            <p>Prchace New Theme and make payment</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="noti-footer">
                                <a href="#!">show all</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="./assets/images/user_avatar.jpg" class="img-radius" alt="User-Profile-Image">
                                <span><?php echo $_SESSION['displayName']; ?></span>
                                <a href="logout.php" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>

                            <ul class="pro-body">
                                <p class="mb-0 ml-3 text-bold">(*) <?php echo $choose; ?></p>
                                <li><a onclick="chooseLanguage('en')" class="dropdown-item clang"><img
                                            src="./assets/images/flags/gb.svg" class="icon-flag" alt="">
                                        <?php echo $english; ?></a></li>
                                <li><a onclick="chooseLanguage('tw')" class="dropdown-item clang"><img
                                            src="./assets/images/flags/tw.svg" class="icon-flag" alt="">
                                        <?php echo $taiwanese; ?></a></li>
                                <li><a onclick="chooseLanguage('vn')" class="dropdown-item clang"><img
                                            src="./assets/images/flags/vn.svg" class="feather icon-flag" alt="">
                                        <?php echo $vietnamese; ?></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">

                            <!-- [ Main Content ] start -->