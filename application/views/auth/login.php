<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <meta name="description" content="Tugas Akhir &amp; Tugas untuk memenuhi persyaratan Diploma III Politeknik Sukabumi">
        <meta name="author" content="fyulistian">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
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
        <link rel="stylesheet" id="css-main" href="<?php echo base_url('template/css/oneui.css') ?>">
        <link rel="stylesheet" id="css-main" href="<?php echo base_url('template/css/themes/city.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('template/css/sweetalert2.css') ?>">
        <!-- END Stylesheets -->
    </head>
    <body>
        <div class="bg-white pulldown">
            <div class="content content-boxed overflow-hidden">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                        <div class="push-30-t push-50 animated fadeIn">
                            <div class="text-center">
                                <i class="fa fa-2x fa-circle-o-notch text-primary"></i>
                                <!-- <p class="text-muted push-15-t">Online Lecture Politeknik Sukabumi</p> -->
                            </div>
                            <form class="js-validation-login form-horizontal push-30-t" id="login_form">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary floating">
                                            <input class="form-control" type="text" name="login_email">
                                            <label for="login-username">Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary floating">
                                            <input class="form-control" type="password" name="login_password">
                                            <label for="login-password">Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group push-30-t">
                                    <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                                        <button class="btn btn-sm btn-block btn-primary btn-square" type="submit" id="btn-login" value="Submit">Log in</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pulldown push-30-t text-center animated fadeInUp">
            <small class="text-muted">Crafted with <i class="fa fa-heart text-city"></i> by <a class="font-w600" href="http://goo.gl/xxaoSd" target="_blank">fyulistian</a></small>
        </div>
        <script src="<?php echo base_url('template/js/core/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/core/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/core/jquery.slimscroll.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/core/jquery.scrollLock.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/core/jquery.appear.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/core/jquery.countTo.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/core/jquery.placeholder.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/core/js.cookie.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/app.js') ?>"></script>
        <script src="<?php echo base_url('template/js/sweetalert2.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
        <script src="<?php echo base_url('template/js/pages/base_pages_login.js') ?>"></script>
        <script>
            $(document).ready(function() {
                $('#login_form').validate();
                $(document).on('click','#btn-login',function() {
                  var url = '<?= base_url('auth/login') ?>';
                    if($('#login_form').valid()){
                      $.ajax({
                        url: url,
                        type: 'POST',
                        data: $('#login_form').serialize(),
                        success: function(data) {
                            if(data==1) {
                                App.loader('show');
                                window.setTimeout(
                                    function() {
                                        App.loader('hide');
                                        window.location.href = '<?php echo site_url(); ?>';
                                    } ,3500);
                            } else {
                                App.loader('show');
                                window.setTimeout(
                                    function() {
                                        App.loader('hide');
                                        swal(
                                          'Oops...',
                                          'Something went wrong!',
                                          'error'
                                        );
                                    } ,3500);
                            }
                        }
                      });
                    }
                   return false;
                });
            });
        </script>
    </body>
</html>