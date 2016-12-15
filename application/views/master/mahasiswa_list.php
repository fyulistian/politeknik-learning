<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>
                    <button class="btn btn-danger btn-sm btn-square" onclick="add_mahasiswa()" data-toggle="tooltip" data-placement="bottom"data-original-title="Add Colleger"><i class="glyphicon glyphicon-plus"></i> Add Colleger</button>
                    <button class="btn btn-default btn-sm btn-square" onclick="report()" data-toggle="tooltip" data-placement="bottom"data-original-title="PDF"><i class="fa fa-file-pdf-o"></i> PDF</button>
                </div><br/>
                <div class='box-body'>
                <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th width="80px">No</th>
                        <th>Image</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>PoB</th>
                        <th>DoB</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $start = 0;
                foreach ($mahasiswa_data as $mahasiswa) { ?>
                    <tr>
                        <td><?php echo ++$start ?></td>
                        <td><img src="<?php echo base_url($mahasiswa->gambar) ?>" width="50px" height="50px"></td>
                        <td><?php echo ucfirst($mahasiswa->nama_depan).' '.ucfirst($mahasiswa->nama_belakang) ?></td>
                        <td><?php echo $mahasiswa->email ?></td>
                        <td><?php echo ucfirst($mahasiswa->gender) ?></td>
                        <td><?php echo ucfirst($mahasiswa->tempat_lahir) ?></td>
                        <td><?php echo $mahasiswa->tanggal_lahir ?></td>
                        <td style="text-align:center" width="140px">
                        <?php
                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="view_mahasiswa('."'".$mahasiswa->nim."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Detailed View"><i class="fa fa-eye"></i></a>';
                        echo '  ';
                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="edit_mahasiswa('."'".$mahasiswa->nim."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Edit Colleger"><i class="fa fa-pencil-square-o"></i></a>';
                        echo '  '; 
                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="delete_mahasiswa('."'".$mahasiswa->nim."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Delete Colleger"><i class="fa fa-trash-o"></i></a>'; ?>

                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal animated fadeInRight" id="modal_form" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-top ">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title modal-title">Colleger Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                            <form action="#" id="form" name="form" class="form-horizontal">
                            <input type="hidden" name="code"/>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="block-content text-center overflow-hidden">
                                            <div class="push-30-t push animated fadeInDown">
                                                <div id="imagePreview"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="material-color-primary">NIM</label>
                                            <input class="form-control" type="text" id="nim" name="nim" maxlength="9">
                                            <span class="help-block"></span>
                                        </div>    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <div class="form-material form-material-primary">
                                            <label for="material-color-primary">First Name</label>
                                            <input class="form-control" type="text" name="nama_depan" maxlength="25">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-material form-material-primary">
                                            <label for="material-color-primary">Last Name</label>
                                            <input class="form-control" type="text" name="nama_belakang" maxlength="25">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-material form-material-primary">
                                            <label for="material-select">Gender</label>
                                            <select class="form-control" name="gender" size="1">
                                                <option value="laki-laki">Male</option>
                                                <option value="perempuan">Female</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="material-color-primary">Email</label>
                                            <input class="form-control" type="text" name="email" maxlength="35">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <!-- <div id="level"></div> -->
                                </div>
                                <div class="form-group">
                                <div class="col-sm-6">
                                    <div class="form-material form-material-primary">
                                        <label for="material-color-primary">Place of Birth</label>
                                        <input class="form-control" type="text" name="tempat_lahir" maxlength="35">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-material form-material-primary">
                                        <label for="material-color-primary">Date of Birth</label>
                                        <input type="text" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" class="form-control datepicker" id="material-color-primary" name="tanggal_lahir" >
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
    <div class="modal animated fadeInRight" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title modal-title">Colleger Form</h3>
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
                                <div class="col-sm-6">
                                    <div class="form-material">
                                        <input class="form-control" type="text"  id="material-disabled" name="email" disabled="">
                                        <label for="material-disabled">Email</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-material">
                                        <input class="form-control" type="text"  id="material-disabled" name="gender" disabled="">
                                        <label for="material-disabled">Gender</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="col-sm-6">
                                <div class="form-material">
                                    <input class="form-control" type="text" id="material-disabled" name="tempat_lahir" disabled="">
                                    <label for="material-disabled">Place of Birth</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-material">
                                    <input class="form-control" type="text" id="material-disabled" name="tanggal_lahir" data-date-format="yyyy-mm-dd" disabled="">
                                    <label for="material-disabled">Date of Birth</label>
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
<script src="<?php echo base_url('template/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>
<script type="text/javascript" >
    var save_method;
    var base_url = '<?php echo base_url();?>';
    var photo = './uploads/img/default.jpg';

    $(document).ready(function () {
        $("#mytable").DataTable();
    });

    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
    });

    function reload_table()
    {
        location.reload();
    }
    
    function report() {
        window.location.href = "<?php echo site_url('mahasiswa/report/')?>/";
    }

    function view_mahasiswa(nim) {
        $.ajax({
            url : "<?php echo site_url('mahasiswa/ajax_detail/')?>/" + nim,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#preview').html('<img src="'+base_url+data.gambar+'" class="img-avatar img-avatar96 img-avatar-thumb">');
                $('#fullName').html('<h2 class="h4 font-w600 text-brown push-5">'+data.nama_depan+", "+data.nama_belakang+'</h2>');
                $('[name="email"]').val(data.email);
                $('[name="gender"]').val(data.gender);
                $('[name="tempat_lahir"]').val(data.tempat_lahir);
                $('[name="tanggal_lahir"]').datepicker('update',data.tanggal_lahir);
                $('#modal-detail').modal('show');
                $('.modal-title').text('Detail Data Colleger');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops", "We couldn't connect to the server !", "error");
            }
        });
    }

    function add_mahasiswa()
    {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#imagePreview').html('<img src="'+base_url+photo+'" class="img-avatar img-avatar96 img-avatar-thumb">');
        // $('#level').html('<div class="form-group"><div class="col-sm-6"><div class="form-material form-material-primary"><label for="material-color-primary">As</label><select class="form-control" id="material-color-primary" name="level" size="1"><option value="dosen">Dosen</option><option value="mahasiswa" selected>Mahasiswa</option></select><span class="help-block"></span></div></div></div>');
        $('#nim').attr('disabled',false);
        $('#modal_form').modal('show');
        $('.modal-title').text('Add Data Colleger');
    }

    function save()
    {
        var url;
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled',true);
        if(save_method == 'add') {
            url = "<?php echo site_url('mahasiswa/ajax_add')?>";
        } else {
            url = "<?php echo site_url('mahasiswa/ajax_update')?>";
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

    function edit_mahasiswa(nim)
    {
        save_method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url : "<?php echo site_url('mahasiswa/ajax_edit/')?>/" + nim,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {   
                $('#nim').attr('disabled',true);
                $('#imagePreview').html('<img src="'+base_url+data.gambar+'" class="img-avatar img-avatar96 img-avatar-thumb">');
                // $('#level').html('');
                $('[name="code"]').val(data.nim);
                $('[name="nim"]').val(data.nim);
                $('[name="nama_depan"]').val(data.nama_depan);
                $('[name="nama_belakang"]').val(data.nama_belakang);
                $('[name="gender"]').val(data.gender);
                $('[name="email"]').val(data.email);
                $('[name="id_jurusan"]').val(data.id_jurusan);
                $('[name="tempat_lahir"]').val(data.tempat_lahir);
                $('[name="tanggal_lahir"]').datepicker('update',data.tanggal_lahir);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data Colleger');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops", "We couldn't connect to the server !", "error");
            }
        });
    }

    function delete_mahasiswa(nim) {
        swal({
          title: "Are you sure ?", 
          text: "You can not retrieve this colleger once it is removed !", 
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Yes, Delete it !",
          confirmButtonColor: "#ec6c62"
          }, function() {
                $.ajax(
                    {
                        type: "POST",
                        url: "<?php echo site_url('mahasiswa/ajax_delete')?>/" + nim,
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
                swal("Deleted !", "Colleger was successfully deleted !", "success");
              })
              .error(function(data) {
                swal("Oops", "We couldn't connect to the server !", "error");
              });
        });
    }
</script>