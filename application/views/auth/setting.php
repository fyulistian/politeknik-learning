<div class="content content-boxed">
    <div class="block">
        <?php if ($this->session->flashdata('notification')) { ?>
            <div class="alert alert-info" id="error-alert"> 
                <i class="si si-info fa-lg"></i> &nbsp;<?= $this->session->flashdata('notification') ?> 
            </div>
        <?php } ?>
        <?php $a = base_url('template/img/photos/photo27@2x.jpg'); ?>
        <div class="bg-image" style="background-image: url('<?= $a ?>');">
            <div class="block-content text-center overflow-hidden">
                <?php foreach ($setting as $setting) { ?>
                    <?php if ($this->session->userdata('level')=="administrator") { ?>
                        <div class="push-30-t push animated fadeInDown">
                            <img class="img-avatar img-avatar96 img-avatar-thumb" src="<?php echo base_url('template/img/avatars/adm.jpg') ?>" alt="">
                        </div>
                        <div class="push-30 animated fadeInUp">
                            <h2 class="h4 font-w600 text-white push-5"><?php echo $setting->email ?></h2>
                        </div>
                    <?php } else { ?>
                        <div class="push-30-t push animated fadeInDown">
                            <img id="imagePreview" class="img-avatar img-avatar96 img-avatar-thumb" src="<?php echo base_url($setting->gambar) ?>" alt="">
                        </div>
                        <div class="push-30 animated fadeInUp">
                            <h2 class="h4 font-w600 text-white push-5"><?php echo ucfirst($setting->nama_belakang).', '.ucfirst($setting->nama_depan) ?></h2>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
    <?php if ($this->session->userdata('level') != "administrator") { ?>
        <a href="javascript:void(0)" type="file" onclick="document.getElementById('upload').click();" return false><i class="fa fa-camera fa-2x" style=" margin-top: -7px; margin-left: 983px;"></i></a>
    <?php } ?>
</div>
<form action="<?php echo base_url('auth/editpersonal') ?>" method="POST" enctype="multipart/form-data">
<?php if ($this->session->userdata('level')!="administrator") { ?>
    <input type="file" id="upload" class="example-file-input" name="userfile" style="visibility: hidden; width: 1px; height: 1px" >
    <input type="hidden" name="nama_depan" value="<?php echo strtolower($setting->nama_depan) ?>">
    <input type="hidden" name="nama_belakang" value="<?php echo strtolower($setting->nama_belakang) ?>">
    <input type="hidden" name="email" value="<?php echo $this->session->userdata('email') ?>">
<?php } ?>
    <div class="block">
        <ul class="nav nav-tabs nav-justified push-20" data-toggle="tabs">
            <li class="active">
                <a href="#tab-profile-password"><i class="fa fa-fw fa-asterisk"></i> Password</a>
            </li>
        </ul>
        <div class="tab-pane fade in active" id="tab-profile-password">
            <div class="row items-push">
                <div class="col-sm-6 col-sm-offset-3 form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="profile-password">Current Password</label>
                            <input class="form-control input-lg" type="password" id="profile-password" name="password">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="profile-password-new">New Password</label>
                            <input class="form-control input-lg" type="password" id="profile-password-new" name="passwordnew">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="profile-password-new-confirm">Confirm New Password</label>
                            <input class="form-control input-lg" type="password" id="profile-password-new-confirm" name="passwordconfirm">
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full bg-gray-lighter text-center">
                <button class="btn btn-sm btn-primary btn-square" type="submit" name="Submit" value="updatepassword"><i class="fa fa-check push-5-r"></i> Save Changes</button>
                <button class="btn btn-sm btn-warning btn-square" type="reset"><i class="fa fa-refresh push-5-r"></i> Reset</button>
            </div>
        </div>
    </div>
</form>
<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
<script type="text/javascript">
    $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#error-alert").slideUp(500);
    });

    $(function() {
        $(".example-file-input").on("change", function()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return;

            if (/^image/.test( files[0].type)) {
                var reader = new FileReader(); 
                reader.readAsDataURL(files[0]);

                reader.onloadend = function() {
                    $("#imagePreview").attr("src",this.result);
                }
            }
        });
    });
    </script>