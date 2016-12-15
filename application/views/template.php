<!DOCTYPE html>
<!--[if IE 9]><html class="ie9 no-focus"><![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-focus">
<!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo ucfirst($this->session->userdata('level'))?></title>
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

        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="<?php echo base_url('template/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('template/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('template/js/plugins/slick/slick.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('template/js/plugins/slick/slick-theme.min.css') ?>">

        <!-- Bootstrap and OneUI CSS framework -->
        <link rel="stylesheet" href="<?php echo base_url('template/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('template/css/material.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('template/css/dataTables.material.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('template/css/sweetalert2.css') ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo base_url('template/css/oneui.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('template/css/themes/city.min.css') ?>">
        <!-- END Stylesheets -->
        
    </head>
    <body>
    <!-- Page Container -->
    <!--Available Classes:
        'enable-cookies'             Remembers active color theme between pages (when set through color theme list)
        'sidebar-l'                  Left Sidebar and right Side Overlay
        'sidebar-r'                  Right Sidebar and left Side Overlay
        'sidebar-mini'               Mini hoverable Sidebar (> 991px)
        'sidebar-o'                  Visible Sidebar by default (> 991px)
        'sidebar-o-xs'               Visible Sidebar by default (< 992px)
        'side-overlay-hover'         Hoverable Side Overlay (> 991px)
        'side-overlay-o'             Visible Side Overlay by default (> 991px)
        'side-scroll'                Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (> 991px)
        'header-navbar-fixed'        Enables fixed header-->
        <div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">
            <nav id="sidebar">
                <div id="sidebar-scroll">
                    <div class="sidebar-content">
                        <div class="side-header side-content bg-white-op">
                            <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close"><i class="fa fa-times"></i></button>
                            <a class="h5 text-white" href="<?php echo base_url() ?>">
                                <i class="fa fa-circle-o-notch text-primary"></i> <span class="h4 font-w600 sidebar-mini-hide">ne</span>
                            </a>
                        </div>
                        <div class="side-content">
                            <ul class="nav-main">
                    			<?php if ($this->session->userdata('level')=="administrator") { ?>
                                <li>
                                    <a class="<?= $dashboard ?>" href="<?php echo base_url() ?>" ><i class="si si-speedometer fa-lg"></i><span class="sidebar-mini-hide"> Dashboard</span></a>
                                </li>
                                <li class="nav-main-heading"><span class="sidebar-mini-hide">Group</span></li>
	                            <li>
	                                <a class="<?= $user ?>"  href="<?php echo base_url('login') ?>"><i class="si si-users fa-lg"></i><span class="sidebar-mini-hide"> User</span></a>
	                            </li>
                                <li>
                                    <a class="<?= $matakuliah ?>" href="<?php echo base_url('matakuliah') ?>"><i class="si si-list fa-lg"></i><span class="sidebar-mini-hide"> Course</span></a>
                                </li>
                                <li>
                                    <a class="<?= $mahasiswa ?>" href="<?php echo base_url('mahasiswa') ?>"><i class="si si-note fa-lg"></i><span class="sidebar-mini-hide"> Colleger</span></a>
                                </li>
                                <li>
                                    <a class="<?= $dosen ?>" href="<?php echo base_url('dosen') ?>"><i class="si si-graduation fa-lg"></i><span class="sidebar-mini-hide"> Lecturer</span></a>
                                </li>
                                <li class="nav-main-heading"><span class="sidebar-mini-hide">Pages</span></li>
                                <li>
                                    <a class="<?= $kelas ?>" href="<?php echo base_url('kelas') ?>"><i class="si si-calendar fa-lg"></i><span class="sidebar-mini-hide"> Class</span></a>
                                </li>
                                <li>
                                    <a class="<?= $jurusan ?>" href="<?php echo base_url('jurusan') ?>"><i class="si si-book-open fa-lg"></i><span class="sidebar-mini-hide"> Major</span></a>
                                </li>
                                <li>
                                    <a class="<?= $angkatan ?>" href="<?php echo base_url('period') ?>"><i class="glyphicon glyphicon-time fa-lg"></i><span class="sidebar-mini-hide"> Period</span></a>
                                </li>
                                <li>
                                    <a class="<?= $mengajar ?>" href="<?php echo base_url('mengajar') ?>"><i class="si si-notebook fa-lg"></i><span class="sidebar-mini-hide"> Teaching</span></a>
                                </li>
                                <!-- <li>
                                    <a class="<?= $diajar ?>" href="<?php echo base_url('diajar') ?>"><i class="si si-book-open fa-lg"></i><span class="sidebar-mini-hide"> Studying</span></a>
                                </li> -->
        						<?php } elseif ($this->session->userdata('level')=="mahasiswa") { ?>
                                <li>
                                    <a class="course" href="<?php echo base_url('matakuliah') ?>"><i class="si si-book-open fa-lg"></i><span class="sidebar-mini-hide"> Courses</span></a>
                                </li>
                                <li class="nav-main-heading"><span class="sidebar-mini-hide">Pages</span></li>
                                <li>
                                    <a class="task" href="#"><i class="fa fa-tasks fa-lg"></i><span class="sidebar-mini-hide"> Tasks</span></a>
                                </li>
	                            <li class="nav-main-heading"><span class="sidebar-mini-hide">Apps</span></li>
	                            <li>
	                                <a href="<?php echo base_url('home') ?>" target="_blank"><i class="si si-rocket fa-lg"></i><span class="sidebar-mini-hide"> Frontend</span></a>
	                            </li>
            					<?php } else { ?>
                                <li>
                                    <a class="<?= $dashboard ?>" href="<?php echo base_url() ?>" ><i class="si si-speedometer fa-lg"></i><span class="sidebar-mini-hide"> Dashboard</span></a>
                                </li>
                                <li class="nav-main-heading"><span class="sidebar-mini-hide">Pages</span></li>
                                <li>
                                    <a class="<?= $soal ?>" href="<?php echo base_url('soal') ?>"><i class="fa fa-edit fa-lg"></i><span class="sidebar-mini-hide"> Create Task</span></a>
                                </li>
                                <li>
                                    <a class="<?= $upload ?>" href="<?php echo base_url('upload') ?>"><i class="si si-cloud-upload fa-lg"></i><span class="sidebar-mini-hide"> Upload File</span></a>
                                </li>
                                <li class="nav-main-heading"><span class="sidebar-mini-hide">Apps</span></li>
                                <li>
                                    <a class="<?= $forum ?>" href="<?php echo base_url('forum'); ?>"><i class="si si-share fa-lg"></i><span class="sidebar-mini-hide"> Forums</span></a>
                                </li>
                                <li>
                                    <a class="<?= $group ?>" href="<?php echo base_url('group'); ?>"><i class="si si-users fa-lg"></i><span class="sidebar-mini-hide"> Groups</span></a>
                                </li>
        						<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</nav>
            <header id="header-navbar" class="content-mini content-mini-full">
                <ul class="nav-header pull-right">
                    <li>
                        <div class="btn-group">
                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">
                                <i class="si si-grid"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-header">Actions</li>
                                <li>
                                    <a tabindex="-1" href="<?php echo base_url('auth/setting') ?>">
                                        <i class="fa fa-gears pull-right"></i>Change Password
                                    </a>
                                    <a tabindex="-1" href="<?php echo base_url('auth/logout') ?>">
                                        <i class="si si-logout pull-right"></i>Log out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul class="nav-header pull-left">
                    <li class="hidden-md hidden-lg">
                        <button class="btn btn-default" data-toggle="layout" data-action="sidebar_toggle" type="button">
                            <i class="fa fa-navicon"></i>
                        </button>
                    </li>
                    <li class="hidden-xs hidden-sm">
                        <button class="btn btn-default" data-toggle="layout" data-action="sidebar_mini_toggle" type="button">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                    </li>
                </ul>
            </header>
            <!-- Main Container -->
            <main id="main-container">
				<?php echo $contents; ?>
            </main>
            <!-- END Main Container -->
            <footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix navbar-fixed-bottom">
                <div class="pull-right">
                    Crafted with <i class="fa fa-heart text-city"></i> by <a class="font-w600" href="http://goo.gl/xxaoSd" target="_blank">fyulistian</a>
                </div>
            </footer>
        </div>
        
        <!-- OneUI Core JS -->
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

        <!-- Page Plugins -->
        <script src="<?php echo base_url('template/js/plugins/slick/slick.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/plugins/bootstrap-datetimepicker/moment.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') ?>"></script>

        <!-- Page JS Code -->
        <script src="<?php echo base_url('template/js/pages/base_pages_dashboard.js') ?>"></script>
        <script src="<?php echo base_url('template/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
        <script src="<?php echo base_url('template/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/pages/base_forms_pickers_more.js') ?>"></script>
        <script>
            jQuery(function () {
                App.initHelpers(['datepicker', 'datetimepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider', 'tags-inputs', 'slick']);
            });
        </script>
    </body>
</html>
