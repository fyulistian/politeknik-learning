<div class="content content-narrow">
    <ol class="breadcrumb push-15">
        <li><a class="link-effect forum" href="javascript:void()" onclick="group_page()">My Groups</a></li>
        <li class="text-muted"><?php echo $group_title; ?></li>
    </ol>

    <div class="block">
        <div class="block-header bg-gray-lighter">
            <ul class="block-options">
                <li>
                    <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                </li>
                <li>
                    <button type="button" id="refresh" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                </li>
            </ul>
            <ul class="block-options block-options-left">
                <li>
                    <button onclick="publish_group()" data-toggle="tooltip" data-placement="right"data-original-title="Publish"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Publish</button>
                </li>
            </ul>
        </div>
        <div class="block-header bg-gray-lighter">
            <ul class="block-options">
                <ul class="block-options">
                    <li>
                        <h3 class="block-title"><?php echo $group_title ?></h3>
                    </li>
                </ul>
            </ul>
        </div>
        <div class="block-content">
            <table class="table table-striped table-borderless">
                <tbody>
                <?php foreach ($detail_group as $group) { ?>
                    <tr>
                        <td></td>
                        <td class="font-s13 text-muted">
                        <span class="pull-left"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center hidden-xs" style="width: 140px;">
                            <div class="push-10">
                                <img class="img-avatar" src="<?php echo base_url($group->gambar) ?>" alt="">
                            </div>
                        </td>
                        <td>
                            <p style="text-align: justify;"><span><?php echo ucwords($group->nama_depan).', '.ucwords($group->nama_belakang) ?></span></p>
                            <hr>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title modal-title">Groups Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <form action="#" id="form" name="form" class="form-horizontal">
                            <input type="hidden" name="id_group" value="<?php echo $id_group ?>" />
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <label id="label-file">Upload File</label>
                                            <input type="file" name="file"/>
                                            <small class="text-muted">only .pdf MAX 2MB</small>
                                            <span class="help-block"></span><br/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="product-customer-notes">Note</label>
                                            <textarea class="form-control" name="group_content" rows="3"></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="alert alert-info text-center"><i class="fa fa-fw fa-info push-5-r"></i> This note will not be displayed to the member.</p><br/>
                    <button class="btn btn-sm btn-primary btn-square" type="button" id="btnSave" onclick="save()" data-dismiss="modal"><i class="si si-action-redo"></i> Add Note</button>
                    <button class="btn btn-sm btn-default btn-square" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>

<script type="text/javascript">
    function group_page() {
        window.location.href = "<?php echo site_url('group')?>";
    }

    function publish_group()
    {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#course').show();
        $('#modal_form').modal('show');
        $('.modal-title').text('Publish');
    }

    function save()
    {
        var url;
        var formData = new FormData($('#form')[0]);
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled',true);
        url = "<?php echo site_url('group/ajax_post')?>";
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                // console.log(data);
                if(data.status) 
                {
                    $('#modal_form').modal('hide');
                    document.getElementById('refresh').click();
                } else  {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                // console.log(jqXHR, textStatus, errorThrown);
                swal("Oops", "We couldn't connect to the server !", "error");
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false);
            }
        });
    }

</script>