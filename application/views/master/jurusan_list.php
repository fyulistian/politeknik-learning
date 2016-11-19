<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>
                  <button class="btn btn-danger btn-sm btn-square" onclick="add_jurusan()" data-toggle="tooltip" data-placement="bottom"data-original-title="Add Major"><i class="glyphicon glyphicon-plus"></i> Add Major</button>
                  <button class="btn btn-default btn-sm btn-square" onclick="report()" data-toggle="tooltip" data-placement="bottom"data-original-title="PDF"><i class="fa fa-file-pdf-o"></i> PDF</button>
                </div><br/>
                <div class='box-body'>
                <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th width="80px">No</th>
                        <th>Major</th>
                        <th>Major Code</th>
            		    <th>Code Name</th>
            		    <th>Action</th>
                    </tr>
                </thead>
        	    <tbody>
                <?php $start = 0;
                foreach ($jurusan_data as $jurusan) { ?>
                <tr>
        		    <td><?php echo ++$start ?></td>
                    <td><?php echo $jurusan->nama_jurusan ?></td>
                    <td><?php echo $jurusan->id_jurusan ?></td>
        		    <td><?php echo $jurusan->nama_kode ?></td>
        		    <td style="text-align:center" width="140px">
        			<?php 
        			echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="view_jurusan('."'".$jurusan->id_jurusan."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="View Major"><i class="fa fa-eye"></i></a>'; 
        			echo '  '; 
        			echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="edit_jurusan('."'".$jurusan->id_jurusan."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="Edit Major"><i class="fa fa-pencil-square-o"></i></a>'; 
        			echo '  '; 
        			echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="delete_jurusan('."'".$jurusan->id_jurusan."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="Delete Major"><i class="fa fa-trash-o"></i></a>'; 
        			?>
        		    </td>
    	        </tr>
                <?php } ?>
                </tbody>
                </table>
                </div>
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
                        <h3 class="block-title modal-title">Jurusan Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <form action="#" id="form" name="form" class="form-horizontal">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="material-color-primary">Major Code</label>
                                            <input class="form-control" type="text" name="id_jurusan" maxlength="2">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="material-color-primary">Code Name</label>
                                            <input class="form-control" type="text" name="nama_kode" maxlength="5">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="material-color-primary">Major Name</label>
                                            <input class="form-control" type="text" name="nama_jurusan" maxlength="25">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
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
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title modal-title">Major Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <form action="#" id="form_edit" name="form" class="form-horizontal">
                            <input type="hidden" name="id_jurusan">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="material-color-primary">Code Name</label>
                                            <input class="form-control" type="text" name="nama_kode" maxlength="2">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="material-color-primary">Major Name</label>
                                            <input class="form-control" type="text" name="nama_jurusan" maxlength="25">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary btn-square" type="button" id="btnEdit" onclick="edit()" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
                    <button class="btn btn-sm btn-default btn-square" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title modal-title">Jurusan Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="material-disabled" name="nama_jurusan" disabled="">
                                        <label for="material-disabled">Major</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="material-disabled" name="id_jurusan" disabled="">
                                        <label for="material-disabled">Major Code</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="material-disabled" name="nama_kode" disabled="">
                                        <label for="material-disabled">Code Name</label>
                                    </div>
                                </div>
                            </div>                        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary btn-square" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</section>
<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('template/plugins/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('template/plugins/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    var save_method;

    $(document).ready(function () {
        $("#mytable").dataTable();
    });

    function reload_table()
    {
        location.reload();
    }

    function report() {
        window.location.href = "<?php echo site_url('jurusan/report/')?>/";
    }

    function view_jurusan(id) {
        $.ajax({
            url : "<?php echo site_url('jurusan/ajax_detail/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id_jurusan"]').val(data.id_jurusan);
                $('[name="nama_jurusan"]').val(data.nama_jurusan);
                $('[name="nama_kode"]').val(data.nama_kode);
                $('#modal-detail').modal('show');
                $('.modal-title').text('Detail Data Jurusan');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops", "We couldn't connect to the server !", "error");
            }
        });
    }

    function add_jurusan()
    {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        $('.modal-title').text('Add Data Major');
    }

    function edit_jurusan(id)
    {
        save_method = 'update';
        $('#form_edit')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url : "<?php echo site_url('jurusan/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id_jurusan"]').val(data.id_jurusan);
                $('[name="nama_jurusan"]').val(data.nama_jurusan);
                $('[name="nama_kode"]').val(data.nama_kode);
                $('#modal_edit').modal('show');
                $('.modal-title').text('Edit Data Major');
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

        url = "<?php echo site_url('jurusan/ajax_add')?>";
        
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

    function edit()
    {
        var url;
        $('#btnEdit').text('saving...');
        $('#btnEdit').attr('disabled',true);

        url = "<?php echo site_url('jurusan/ajax_update')?>";
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form_edit').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) 
                {
                    $('#modal_edit').modal('hide');
                    reload_table();
                } else  {
                    for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                }
                }
                $('#btnEdit').text('save'); 
                $('#btnEdit').attr('disabled',false); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops", "We couldn't connect to the server !", "error");
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
     
            }
        });
    }

    function delete_jurusan(id) {
        swal({
          title: "Are you sure ?", 
          text: "You can not retrieve this major once it is removed !", 
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Yes, Delete it !",
          confirmButtonColor: "#ec6c62"
          }, function() {
                $.ajax(
                    {
                        type: "POST",
                        url: "<?php echo site_url('jurusan/ajax_delete')?>/" + id,
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
                swal("Deleted !", "Major was successfully deleted !", "success");
              })
              .error(function(data) {
                swal("Oops", "We couldn't connect to the server !", "error");
              });
        });
    }
</script>