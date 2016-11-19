<div class="content content-narrow">
    <ol class="breadcrumb push-15">
        <li><a class="text-muted" href="javascript:void()" onclick="window.location.reload()">Forums</a></li>
    </ol>
    <div class="block">
        <div class="block-header bg-gray-lighter">
            <ul class="block-options">
                <li>
                    <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                </li>
                <li>
                    <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                </li>
            </ul>
            <ul class="block-options block-options-left">
		        <li>
		            <button onclick="start_forum()" data-toggle="tooltip" data-placement="right"data-original-title="Start New One"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;New Topic</button>
		        </li>
		    </ul>
        </div>
        <div class="block-content block-content-full">
            <?php foreach ($data_course as $course) { ?>
            <table class="table table-striped table-borderless table-vcenter">
                <thead>
                    <tr>
                        <th colspan="2"><?php echo $course->nama_course ?></th>
                        <th class="text-center hidden-xs hidden-sm" style="width: 100px;"></th>
                        <th class="text-center hidden-xs hidden-sm" style="width: 100px;"></th>
                        <th class="hidden-xs hidden-sm" style="width: 200px;">Posted In</th>
                        <th class="hidden-xs hidden-sm" style="width: 100px;"></th>
                    </tr>
                </thead>
                <tbody>
				<?php $user = $this->session->userdata('email');
    			$nip = $this->Dosen_model->my_nip($user);
                $data_forum  = $this->Forum_model->get_all_query($course->id_course, $nip); ?>
                    <?php foreach ($data_forum as $forum) { ?>
                    <tr>
                        <td class="text-center" style="width: 75px;">
                            <i class="si si-badge fa-2x"></i>
                        </td>
                        <td>
                            <h4 class="h5 font-w600 push-5">
                                <a href="<?php echo base_url('forum/topics/'.$forum->id_forum); ?>"><?php echo $forum->forum_title ?></a>
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
								<?php echo date('F d, Y', strtotime($forum->tanggal_post)); ?>
                            </span>
                        </td>
                        <td class="text-center hidden-xs hidden-sm">
                            <?php echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="edit_forum('."'".$forum->id_forum."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Edit Forum"><i class="fa fa-pencil-square-o"></i></a>'; ?>
                            <?php echo '   ' ?>
                            <?php echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="end_forum('."'".$forum->id_forum."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Delete Forum"><i class="fa fa-trash-o"></i></a>'; ?>
                        </td>
                    </tr>
                	<?php } ?>
                </tbody>
         	</table>
            <?php } ?>
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
                        <h3 class="block-title modal-title">Forum Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                            <form action="#" id="form" name="form" class="form-horizontal">
                            <input type="hidden" name="id_forum"/>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="material-color-primary">Title</label>
                                            <input class="form-control" type="text" name="forum_title" maxlength="50">
                                            <span class="help-block"></span>
                                        </div>    
                                    </div>
                                </div>
                                <div class="form-group" id="course">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="material-select">Course</label>
                                            <?= cmb_dinamis('id_course','course','nama_course','id_course','nama_course') ?><br/>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12"><hr>
                                        <div class="form-material">
                                            <label for="material-color-primary">Description</label>
                                            <textarea class="form-control" name="forum_content" rows="5"></textarea>
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

    function start_forum()
    {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#course').show();
        $('#modal_form').modal('show');
        $('.modal-title').text('Start New Forum');
    }

    function edit_forum(id)
    {
        save_method = 'update';
        $('#form')[0].reset();
        $('#course').hide();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url : "<?php echo site_url('forum/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id_forum"]').val(data.id_forum);
                $('[name="forum_title"]').val(data.forum_title);
                $('[name="forum_content"]').val(data.forum_content);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data Forum');
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
        if(save_method == 'add') {
            url = "<?php echo site_url('forum/ajax_add')?>";
        } else {
            url = "<?php echo site_url('forum/ajax_update')?>";
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
                    $('#modal_form').modal('hide');
                    reload_table();
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

    function end_forum(id) {
        swal({
          title: "Are you sure ?", 
          text: "You can not cancel this action once it is ended !", 
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Yes, End it !",
          confirmButtonColor: "#ec6c62"
          }, function() {
                $.ajax(
                    {
                        type: "POST",
                        url: "<?php echo site_url('forum/ajax_delete')?>/" + id,
                        dataType: "JSON",
                        success: function(data){
                            $('#modal_form').modal('hide');
                            window.setTimeout(
                            function() {
                                reload_table();
                            } ,1500);
                        }
                    }
                )
              .done(function(data) {
                swal("Ended !", "Forum was successfully ended !", "success");
              })
              .error(function(data) {
                swal("Oops", "We couldn't connect to the server !", "error");
              });
        });
    }

</script>