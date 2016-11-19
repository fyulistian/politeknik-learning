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
        <link rel='stylesheet' href="<?php echo base_url('template/css/sourcesanspro.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('template/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo base_url('template/css/oneui.css') ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo base_url('template/css/themes/city.min.css') ?>">
    </head>
    <body>
        <div id="page-container" class="header-navbar-fixed header-navbar-transparent">
            <header></header>
            <main id="main-container" style="min-height: 280px;">
            <div class="bg-white">
                <section class="content content-mini content-mini-full content-boxed overflow-hidden">
                    <ol class="breadcrumb">
                        <li><a class="text-primary-dark" id="back" href="<?php echo base_url('home/course'); ?>">Course</a></li>
                        <li><a href="javascript:void(0)">Digital Report</a></li>
                    </ol>
                </section>
            </div>
            <?php 
                $total = $detail['0']->total_nilai;
                $salah = $detail['0']->salah;
                $benar = $detail['0']->benar;
             ?>
            <div class="bg-gray-lighter">
                <section class="content content-boxed">
                    <div class="row items-push push-20-t push-20 text-center">
                        <div class="col-sm-3">
                            <div class="h1 push-5" data-toggle="countTo" data-to="<?php echo $count; ?>" data-after=" "><?php echo $count; ?></div>
                            <div class="font-w600 text-uppercase text-muted">Question</div>
                        </div>
                        <div class="col-sm-3">
                            <div class="h1 push-5" data-toggle="countTo" data-to="<?php echo $benar; ?>" data-after=" "><?php echo $benar; ?></div>
                            <div class="font-w600 text-uppercase text-muted">Right</div>
                        </div>
                        <div class="col-sm-3">
                            <div class="h1 push-5" data-toggle="countTo" data-to="<?php echo $salah; ?>" data-after=" "><?php echo $salah; ?></div>
                            <div class="font-w600 text-uppercase text-muted">Wrong</div>
                        </div>
                        <div class="col-sm-3">
                            <div class="h1 push-5" data-toggle="countTo" data-to="<?php echo $total; ?>" data-after=" "><?php echo $total; ?></div>
                            <div class="font-w600 text-uppercase text-muted">Score</div>
                        </div>
                    </div>
                </section>
            </div>
                <?php $total=0; $no=0; foreach($nilai as $kon) { 
                $jawaban = strtolower($kon['jawaban']);
                $no++?>
                    <div class="bg-white">
                        <section class="content content-boxed">
                            <div class="row items-push-3x push-50-t nice-copy">
                                <div class="col-sm-4">
                                    
                                    <?php if($kon['jawaban'] == $kon['kunci']) { ?>
                                    <p><?php echo $no.". ".$kon['soal'];?> &nbsp;<span class='label label-success'>Answer</span></p>
                                    <h3 class="h5 font-w600 text-uppercase text-center push-10"><?php echo $kon['jawaban']." (".$kon[$jawaban].")  Kunci : ".$kon['kunci']." (".$kon[$jawaban].")";?></h3>
                                    <?php } else { ?>
                                    <p><?php echo $no.". ".$kon['soal'];?> &nbsp;<span class='label label-danger'>Answer</span></p>
                                    <h3 class="h5 font-w600 text-uppercase text-center push-10"><?php echo $kon['jawaban']." (".$kon[$jawaban].")  Kunci : ".$kon['kunci']." (".$kon[$jawaban].")";?></h3>
                                <?php } ?>
                                </div>
                            </div>
                        </section>
                    </div>
                <hr>
            <?php } ?>
            </main>
            <footer id="page-footer" class="bg-white">
                <div class="content content-boxed">
                    <div class="font-s12 push-20 clearfix">
                        <hr class="remove-margin-t">
                        <div class="pull-right">
                            Crafted with <i class="fa fa-heart text-city"></i> by <a class="font-w600" href="http://goo.gl/xxaoSd" target="_blank">fyulistian</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
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
        <script>
            jQuery(function () {
                App.initHelpers(['appear', 'appear-countTo']);
            });
        </script>
    </body>
</html>