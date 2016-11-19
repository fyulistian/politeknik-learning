<!DOCTYPE html>
<!--[if IE 9]>
         <html class="ie9 no-focus"> <![endif]-->
<!--[if gt IE 9]><!--> 
<html class="no-focus"> 
<!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->session->userdata('nama_user')?></title>
        <meta name="description" content="Tugas Akhir &amp; Tugas untuk memenuhi persyaratan Diploma III Politeknik Sukabumi">
        <meta name="author" content="fyulistian">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
        <!-- Icons -->
        <link rel="shortcut icon" href="<?php echo base_url('template/img/favicons/favicon.png') ?>">
        <link rel="icon" type="image/png" href="<?php echo base_url('template/img/favicons/favicon-16x16.png') ?>" sizes="16x16">
        <link rel="icon" type="image/png" href="<?php echo base_url('template/img/favicons/favicon-32x32.png') ?>" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php echo base_url('template/img/favicons/favicon-96x96.png') ?>" sizes="96x96">
        <link rel="icon" type="image/png" href="<?php echo base_url('template/img/favicons/favicon-160x160.png') ?>" sizes="160x160">
        <link rel="icon" type="image/png" href="<?php echo base_url('template/img/favicons/favicon-192x192.png') ?>" sizes="192x192">
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('template/img/favicons/apple-touch-icon-57x57.png') ?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('template/img/favicons/apple-touch-icon-60x60.png') ?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('template/img/favicons/apple-touch-icon-72x72.png') ?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('template/img/favicons/apple-touch-icon-76x76.png') ?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('template/img/favicons/apple-touch-icon-114x114.png') ?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('template/img/favicons/apple-touch-icon-120x120.png') ?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('template/img/favicons/apple-touch-icon-144x144.png') ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('template/img/favicons/apple-touch-icon-152x152.png') ?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('template/img/favicons/apple-touch-icon-180x180.png') ?>">
        <!-- END Icons -->
        <!-- Stylesheets -->
        <!-- Web fonts -->
        <link rel='stylesheet' href="<?php echo base_url('template/css/sourcesanspro.css') ?>">
        <!-- Bootstrap and OneUI CSS framework -->
        <link rel="stylesheet" href="<?php echo base_url('template/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('template/css/sweetalert2.css') ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo base_url('template/css/oneui.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('template/css/themes/flat.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('template/css/constellation/normalize.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('template/css/constellation/component.css') ?>">

        <!-- END Stylesheets -->
    </head>
    <body>
        <!-- Page Container -->
        <!--
            Available Classes:

            'enable-cookies'             Remembers active color theme between pages (when set through color theme list)

            'sidebar-l'                  Left Sidebar and right Side Overlay
            'sidebar-r'                  Right Sidebar and left Side Overlay
            'sidebar-mini'               Mini hoverable Sidebar (> 991px)
            'sidebar-o'                  Visible Sidebar by default (> 991px)
            'sidebar-o-xs'               Visible Sidebar by default (< 992px)

            'side-overlay-hover'         Hoverable Side Overlay (> 991px)
            'side-overlay-o'             Visible Side Overlay by default (> 991px)

            'side-scroll'                Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (> 991px)

            'header-navbar-fixed'        Enables fixed header
            'header-navbar-transparent'  Enables a transparent header (if also fixed, it will get a solid dark background color on scrolling)
        -->
        <div id="page-container" class="header-navbar-fixed header-navbar-transparent">

            <!-- Header -->
            <header id="header-navbar" class="content-mini content-mini-full">
                <div class="content-boxed">
                    <ul class="nav-header pull-right">
                        <li>
                            <div class="btn-group">
                                 <button class="btn btn-link text-white dropdown-toggle" data-toggle="dropdown" type="button">
                                    <i class="si si-grid"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right sidebar-mini-hide font-s13">
                                    <li>
                                        <a tabindex="-1" id="setting" href="javascript:void(0)">
                                            <i class="fa fa-gears pull-right"></i> <span class="font-w600">Change Password</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" id="logout" href="javascript:void(0)">
                                            <i class="si si-logout pull-right"></i> <span class="font-w600">Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="hidden-md hidden-lg">
                            <button class="btn btn-link text-white pull-right" data-toggle="class-toggle" data-target=".js-nav-main-header" data-class="nav-main-header-o" type="button">
                                <i class="fa fa-navicon"></i>
                            </button>
                        </li>
                    </ul>
                    <!-- END Header Navigation Right -->

                    <!-- Main Header Navigation -->
                    <ul class="js-nav-main-header nav-main-header pull-right">
                        <li class="text-right hidden-md hidden-lg">
                            <button class="btn btn-link text-white" data-toggle="class-toggle" data-target=".js-nav-main-header" data-class="nav-main-header-o" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                        </li>
                        <li>
                            <a class="<?= $home ?>" id="home" href="javascript:void(0)">Home</a>
                        </li>
                        <li>
                            <a class="<?= $course ?>" id="course" href="javascript:void(0)">Course</a>
                        </li>
                        <li>
                            <a class="<?= $group ?>" id="group" href="javascript:void(0)">Group</a>
                        </li>
                        <li>
                            <a class="<?= $forum ?>" id="forum" href="javascript:void(0)">Forum</a>
                        </li>
                    </ul>
                    <!-- END Main Header Navigation -->

                    <!-- Header Navigation Left -->
                    <ul class="nav-header pull-left">
                        <li class="header-content">
                            <a class="h5 home" href="javascript:void(0)">
                                <i class="fa fa-circle-o-notch text-primary"></i> <span class="h4 font-w600 text-white">ne</span>
                            </a>
                        </li>
                    </ul>
                    <!-- END Header Navigation Left -->
                </div>
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                <div class="banner">
                    <div id="large-header" class="large-header">
                        <canvas id="demo-canvas"></canvas>
                        <div class="inside-canvas">
                            <h1 class="h2 text-white push-10 visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">Online Lecture Politeknik Sukabumi</h1>
                            <h2 class="h4 text-white-op push visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">Lectures Online allows students to learn without limits of time and place.</h2>
                            <span class="fa fa-leanpub text-white animated fadeInDown"></span>
                            <h3 class="h6 text-white-op push visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">Learning Without Limits.</h3>
                        </div>
                    </div>
                </div>
                <?php echo $contents ?>
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="bg-white">
                <div class="content content-boxed">
                    <!-- Footer Navigation -->
                    <div class="row push-30-t items-push-2x">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3 pull-right">
                            <div class="block">
                                <div class="block-content block-content-full">
                                    <h3 class="h5 font-w600 text-uppercase push-20">Get In Touch</h3>
                                    <div class="font-s13 push">
                                        <strong>Politeknik, Sukabumi.</strong><br>
                                        Jl. Babakan Sirna No.25, Sukabumi<br>
                                        Sukabumi, Jawa Barat 94107<br>
                                        <abbr title="Phone">P:</abbr> (0266) 215-417</br>
                                        <abbr title="Fax">F:</abbr> (0266) 215-417</br></br>
                                        <i class="si si-envelope-open"></i> politeknik@polteksmi.ac.id
                                    </div>
                                    <div class="font-s13">
                                        
                                    </div>
                                    <strong>Follow Us</strong><br>
                                    <div class="btn-group pull-right">
                                        <a class="btn btn-default" href="javascript:void(0)" data-toggle="tooltip" title="" data-original-title="Follow us on Twitter"><i class="fa fa-fw fa-twitter"></i></a>
                                        <a class="btn btn-default" href="javascript:void(0)" data-toggle="tooltip" title="" data-original-title="Like our Facebook page"><i class="fa fa-fw fa-facebook"></i></a>
                                        <a class="btn btn-default" href="javascript:void(0)" data-toggle="tooltip" title="" data-original-title="Follow us on Google Plus"><i class="fa fa-fw fa-google-plus"></i></a>
                                        <a class="btn btn-default" href="javascript:void(0)" data-toggle="tooltip" title="" data-original-title="Subscribe on Youtube"><i class="fa fa-fw fa-youtube"></i></a>
                                    </div>
                                    <ul class="list list-simple-mini font-s13">
                                        <li>
                                            <a class="font-w600 pull-right" href="javascript:void(0)">Support Center</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Footer Navigation -->

                    <!-- Copyright Info -->
                    <div class="font-s12 push-20 clearfix">
                        <hr class="remove-margin-t">
                        <div class="pull-right">
                            Crafted with <i class="fa fa-heart text-city"></i> by <a class="font-w600" href="http://goo.gl/xxaoSd" target="_blank">fyulistian</a>
                        </div>
                    </div>
                    <!-- END Copyright Info -->
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
        <script src="<?php echo base_url('template/js/constellation/TweenLite.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/constellation/EasePack.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/constellation/rAF.js') ?>"></script>
        <script src="<?php echo base_url('template/js/constellation/banner.js') ?>"></script>
        <script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/core/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/core/jquery.slimscroll.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/core/jquery.scrollLock.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/core/jquery.appear.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/core/jquery.countTo.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/core/jquery.placeholder.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/core/js.cookie.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/app.js') ?>"></script>
        <script src="<?php echo base_url('template/js/sweetalert2.min.js') ?>"></script>

        <!-- Page JS Code -->
        <script>
            jQuery(function () {
                // Init page helpers (Appear + CountTo plugins)
                App.initHelpers(['appear', 'appear-countTo']);
            });

            $(function(){
                $('#home').on('click',function(){
                    window.location.href = "<?php echo site_url(); ?>";
                 });
                 $('.home').on('click',function(){
                    window.location.href = "<?php echo site_url(); ?>";
                 });
                 $('#setting').on('click',function(){
                    window.location.href = "<?php echo site_url('home/setting'); ?>";
                 });
                 $('#logout').on('click',function(){
                    window.location.href = "<?php echo site_url('auth/logout'); ?>";
                 });
                 $('#course').on('click',function(){
                    window.location.href = "<?php echo site_url('home/course'); ?>";
                 });
                 $('#forum').on('click',function(){
                    window.location.href = "<?php echo site_url('home/forum'); ?>";
                 });
                 $('#group').on('click',function(){
                    window.location.href = "<?php echo site_url('home/group'); ?>";
                 });
                });
        </script>
    </body>
</html>