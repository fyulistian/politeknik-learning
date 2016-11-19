<div class="content content-narrow">
    <ol class="breadcrumb push-15">
        <li><a class="link-effect" href="javascript:void()" onclick="forum_page()">Forums</a></li>
        <li class="text-muted"><?php echo $topic; ?></li>
    </ol>
    <div class="block">
        <div class="block-header bg-gray-lighter">
            <ul class="block-options">
                <li>
                    <button data-toggle="scroll-to" data-target="#forum-reply-form" type="button"><i class="fa fa-reply"></i> Reply</button>
                </li>
                <li>
                    <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                </li>
                <li>
                    <button type="button" id="refresh" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                </li>
            </ul>
            <h3 class="block-title"><?php echo $topic; ?></h3>
        </div>
        <div class="block-content">
            <table class="table table-striped table-borderless">
                <tbody>
                <?php foreach ($data_forum as $forum) { ?>
                    <tr>
                        <td class="ribbon ribbon-bookmark ribbon-primary ribbon-left ribbon-bottom">
                            <div class="ribbon-box font-w600">
                                <i class="glyphicon glyphicon-pushpin"></i>
                            </div>
                        </td>
                        <td class="font-s13 text-muted">
                        <span class="pull-left">
                            <span class="text-primary"><?php echo ucwords($forum->nama_depan).', '.ucwords($forum->nama_belakang) ?></span>&nbsp;<small><?php echo date('F d, Y - H:i', strtotime($forum->tanggal_post)); ?></small>
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center hidden-xs" style="width: 140px;">
                            <div class="push-10">
                                <img class="img-avatar" src="<?php echo base_url($forum->gambar) ?>" alt="">
                            </div>
                        </td>
                        <td>
                            <p style="text-align: justify;"><?php echo $forum->forum_content ?></p>
                            <hr>
                        </td>
                    </tr>
                <?php } ?>
                <?php foreach ($data_discussion as $key) { ?>
                    <tr>
                        <td class="hidden-xs"></td>
                        <td class="font-s13 text-muted">
                        <span class="pull-left">
                            <span class="text-primary"><?php echo ucwords($key->mhs_nama_depan).', '.ucwords($key->mhs_nama_belakang) ?></span>&nbsp;<small><?php echo date('F d, Y - H:i', strtotime($key->replies_date)); ?></small>
                        </span>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center hidden-xs" style="width: 140px;">
                            <div class="push-10">
                                <img class="img-avatar" src="<?php echo base_url($key->mhs_gambar) ?>" alt="">
                            </div>
                        </td>
                        <td>
                            <p style="text-align: justify;"><?php echo $key->replies_content ?></p>
                            <hr>
                        </td>
                    </tr>
                <?php } ?>
                <?php foreach ($data_replies as $reply) { ?> 
                    <tr>
                        <td class="hidden-xs"></td>
                        <td class="font-s13 text-muted">
                        <span class="pull-left">
                            <span class="text-primary"><?php echo ucwords($reply->nama_depan).', '.ucwords($reply->nama_belakang) ?></span>&nbsp;<small><?php echo date('F d, Y - H:i', strtotime($reply->date_replies)); ?></small>
                        </span>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center hidden-xs" style="width: 140px;">
                            <div class="push-10">
                                <img class="img-avatar" src="<?php echo base_url($reply->gambar) ?>" alt="">
                            </div>
                        </td>
                        <td>
                            <p style="text-align: justify;"><?php echo $reply->content_replies ?></p>
                            <hr>
                        </td>
                    </tr>
                <?php } ?>
                    <tr id="forum-reply-form">
                        <td class="hidden-xs"></td>
                        <td class="font-s13 text-muted">
                            <span class="text-primary"><?php echo $nama_mhs ?></span> Just now
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center hidden-xs">
                            <div class="push-10">
                                <a href="base_pages_profile.html">
                                    <img class="img-avatar" src="<?php echo base_url($gambar); ?>" alt="">
                                </a>
                            </div>
                        </td>
                        <td>                        
                            <form action="#" id="form" name="form" class="form-horizontal">
                            <input type="hidden" name="id_forum" value="<?php echo $this->uri->segment(3) ?>" />
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <textarea id="ckeditor" name="ckeditor"></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group pull-right">
                                    <div class="col-xs-12">
                                        <submit class="btn btn-sm btn-primary btn-square" id="btnSave" onclick="save()"><i class="fa fa-reply"></i> Reply</submit>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('template/js/plugins/ckeditor/ckeditor.js') ?>"></script>

<script type="text/javascript">
    // var editor = CKEDITOR.replace( 'ckeditor' );
    // editor.on( 'change', function( evt ) {
    // console.log( 'Total bytes: ' + editor.getData() );
    // });
    
    jQuery(function () {
                App.initHelpers('ckeditor');
            });

    function forum_page() {
        window.location.href = "<?php echo site_url('home/forum')?>";
    }

    function save()
    {
        var url;
        $('#btnSave').attr('disabled',true);
        url = "<?php echo site_url('home/ajax_save')?>";
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
            CKEDITOR.instances[instance].setData('');
        }
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                // console.log(data);
                if(data.status) 
                {
                    console.log(data);
                    for ( instance in CKEDITOR.instances ){
                        CKEDITOR.instances[instance].updateElement();
                        CKEDITOR.instances[instance].setData('');
                    }
                    document.getElementById('refresh').click();
                } else  {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnSave').attr('disabled',false);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                // console.log(jqXHR, textStatus, errorThrown);
                swal("Oops", "We couldn't connect to the server !", "error");
                $('#btnSave').attr('disabled',false);
            }
        });
    }

</script>