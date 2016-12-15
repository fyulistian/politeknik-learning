<div class="content content-narrow">
    <ol class="breadcrumb push-15">
        <li class="text-muted">My Groups</li>
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
        </div>
        <div class="block-content block-content-full">
            <table class="table table-striped table-borderless table-vcenter">
                <thead>
                    <tr>
                        <th colspan="2">Group</th>
                        <th class="text-center hidden-xs hidden-sm" style="width: 100px;"></th>
                        <th class="text-center hidden-xs hidden-sm" style="width: 100px;"></th>
                        <th class="hidden-xs hidden-sm" style="width: 200px;">Created In</th>
                        <th class="hidden-xs hidden-sm" style="width: 100px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_group as $group) { ?>
                    <tr>
                        <td class="text-center" style="width: 75px;">
                            <i class="si si-badge fa-2x"></i>
                        </td>
                        <td>
                            <h4 class="h5 font-w600 push-5">
                                <a href="<?php echo base_url('group/details/'.$group->id_group); ?>"><?php echo $group->nama_group ?></a>
                            </h4>
                        </td>
                        <td class="text-center hidden-xs hidden-sm">
                            <a class="font-w600"></a>
                        </td>
                        <td class="text-center hidden-xs hidden-sm">
                            <a class="font-w600"></a>
                        </td>
                        <td class="hidden-xs hidden-sm">
                            <span class="font-s13">
								<?php echo date('F ', strtotime($group->pembuatan_group)).date('d, ', strtotime($group->pembuatan_group)).date('Y', strtotime($group->pembuatan_group)); ?>
                            </span>
                        </td>
                        <td class="text-center hidden-xs hidden-sm">
                            <?php echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="edit_group('."'".$group->id_group."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Edit Group"><i class="fa fa-pencil-square-o"></i></a>'; ?>
                        </td>
                    </tr>
                	<?php } ?>
                </tbody>
         	</table>
        </div>
    </div>
</div>

<div class="modal animated zoomIn" id="modal_form" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title modal-title">Group Form</h3>
                </div>
                <div class="block-content">
                    <div class="modal-body form">
                        <div class="block-content block-content-narrow form-horizontal push-10-t">
                        <form action="#" id="form" name="form" class="form-horizontal">
                        <input type="hidden" name="nip" value="<?php echo $nip ?>" />
                        <input type="hidden" name="id_group"/>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="form-material form-material-primary">
                                        <label for="material-color-primary">Title</label>
                                        <input class="form-control" type="text" name="nama_group" maxlength="35">
                                        <span class="help-block"></span>
                                    </div>    
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary btn-square" type="button" id="btnSave" onclick="save()" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
                <button class="btn btn-sm btn-default btn-square" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
<script type="text/javascript">
    var save_method;
    
    function reload_table()
    {
        location.reload();
    }

    function edit_group(id)
    {
        save_method = 'update';
        $('#form')[0].reset();
        $('#course').hide();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url : "<?php echo site_url('group/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id_group"]').val(data.id_group);
                $('[name="nama_group"]').val(data.nama_group);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data Group');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops", "We couldn't connect to the server !", "error");
            }
        });
    }

    function save()
    {
        var url;
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled',true);
        url = "<?php echo site_url('group/ajax_update')?>";
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
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
                swal("Oops", "We couldn't connect to the server !", "error");
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
     
            }
        });
    }

</script>