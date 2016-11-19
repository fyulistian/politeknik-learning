<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-body'>
                <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th width="80px">No</th>
                        <th>NIM</th>
                        <th>Full Name</th>
                        <th>Major</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $start = 0;
                foreach ($data_study as $study) { ?>
                    <tr>
                        <td><?php echo ++$start ?></td>
                        <td><?php echo $study->nim ?></td>
                        <td><?php echo ucfirst($study->nama_depan).' '.ucfirst($study->nama_belakang) ?></td>
                        <td><?php echo $study->nama_jurusan ?></td>
                        <td style="text-align:center" width="140px">
                        <?php
                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="view_study('."'".$study->nim."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="View Lessons"><i class="fa fa-eye"></i></a>';
                        echo '  '; 
                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="add_study('."'".$study->nim."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="Add Study"><i class="glyphicon glyphicon-plus"></i></a>';
                        echo '  '; 
                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="edit_study('."'".$study->nim."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="Edit Study"><i class="fa fa-pencil-square-o"></i></a>';
                        echo '  '; 
                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="delete_study('."'".$study->nim."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="Delete Study"><i class="fa fa-trash-o"></i></a>'; ?>
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
                        <h3 class="block-title modal-title">Studying Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                        <div class="block-content block-content-narrow form-horizontal push-10-t">
                            <form action="#" id="form" name="form" class="form-horizontal">
                            <input type="hidden" name="nim"/>
                            <input type="hidden" name="id_detail_kelas"/>
                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <div class="form-material">
                                            <input class="form-control" type="text" id="material-disabled" name="nama_jurusan" disabled="">
                                            <label for="material-disabled">Major</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="form-material form-material-primary">
                                            <label for="material-select">Classroom</label>
                                            <?= cmb_dinamis('id_kelas','kelas','nama_kelas','id_kelas','nama_kelas') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="js-datetimepicker form-material input-group date">
                                            <label for="material-select">Period</label>
                                            <?= cmb_dinamis('id_tahun_ajaran','tahun_ajaran','tahun_masuk','id_tahun_ajaran','tahun_masuk') ?>
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
                        <h3 class="block-title modal-title">Studying Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="block-content text-center overflow-hidden">
                                        <div class="push-30-t push animated fadeInDown">
                                            <div id="preview"></div>
                                        </div>
                                        <div class="push-30 animated fadeInUp">
                                            <div id="fullName"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="material-disabled" name="nim" disabled="">
                                        <label for="material-disabled">NIM</label>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="material-disabled" name="nama_jurusan" disabled="">
                                        <label for="material-disabled">Major</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-material">
                                        <input class="form-control" type="text"  id="material-disabled" name="nama_kelas" disabled="">
                                        <label for="material-disabled">Classroom</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-material">
                                        <input class="form-control" type="text"  id="material-disabled" name="tahun_masuk" disabled="">
                                        <label for="material-disabled">Period</label>
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
<script src="<?php echo base_url('template/plugins/datatables/dataTables.bootstrap.js') ?>"></script>
<script src="<?php echo base_url('template/plugins/datatables/jquery.dataTables.js') ?>"></script>
<script type="text/javascript" >
    var save_method;
    var base_url = '<?php echo base_url();?>';
    var photo = './uploads/img/default.jpg';

    $(document).ready(function () {
        $("#mytable").DataTable();
    });

    function reload_table()
    {
        location.reload();
    }
    
    function view_study(nim) {
        $.ajax({
            url : "<?php echo site_url('diajar/ajax_view/')?>/" + nim,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#preview').html('<img src="'+base_url+data.gambar+'" class="img-avatar img-avatar96 img-avatar-thumb">');
                $('#fullName').html('<h2 class="h4 font-w600 text-brown push-5">'+data.nama_depan+", "+data.nama_belakang+'</h2>');
                $('[name="nim"]').val(data.nim);
                $('[name="nama_jurusan"]').val(data.nama_jurusan);
                $('[name="nama_kelas"]').val(data.nama_kelas);
                $('[name="tahun_masuk"]').val(data.tahun_masuk);
                $('#modal-detail').modal('show');
                $('.modal-title').text('Detail Data Study');

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops", "We couldn't connect to the server !", "error");
            }
        });
    }

    function add_study(nim)
    {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url : "<?php echo site_url('diajar/ajax_detail/')?>/" + nim,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="nim"]').val(data.nim);
                $('[name="nama_jurusan"]').val(data.nama_jurusan);
                $('#modal_form').modal('show');
                $('.modal-title').text('Add Data Studying');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops", "We couldn't connect to the server !", "error");
            }
        });
    }

    function edit_study(nim)
    {
        save_method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url : "<?php echo site_url('diajar/ajax_view/')?>/" + nim,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="nim"]').val(data.nim);
                $('[name="id_detail_kelas"]').val(data.id_detail_kelas);
                $('[name="nama_kelas"]').val(data.nama_kelas);
                $('[name="nama_jurusan"]').val(data.nama_jurusan);
                $('[name="tahun_masuk"]').val(data.tahun_masuk);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data Study');
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
            url = "<?php echo site_url('diajar/ajax_add')?>";
        } else {
            url = "<?php echo site_url('diajar/ajax_update')?>";
        }
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

    function delete_study(id) {
        swal({
          title: "Are you sure ?", 
          text: "You can not retrieve this action once it is removed !", 
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Yes, Delete it !",
          confirmButtonColor: "#ec6c62"
          }, function() {
                $.ajax(
                    {
                        type: "POST",
                        url : "<?php echo site_url('diajar/ajax_delete')?>/" + id,
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
                swal("Deleted !", "Data Study was successfully deleted !", "success");
              })
              .error(function(data) {
                swal("Oops", "We couldn't connect to the server !", "error");
              });
        });
    }
</script>