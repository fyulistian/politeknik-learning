<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>
                  <button class="btn btn-danger btn-sm btn-square" onclick="add_kelas()" data-toggle="tooltip" data-placement="bottom"data-original-title="Add Classroom"><i class="glyphicon glyphicon-plus"></i> Add Classroom</button>
                  <button class="btn btn-default btn-sm btn-square" onclick="report()" data-toggle="tooltip" data-placement="bottom"data-original-title="PDF"><i class="fa fa-file-pdf-o"></i> PDF</button>
                </div><br/>
                <div class='box-body'>
                <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th width="80px">No</th>
                        <th>Classroom</th>
                        <th>Major</th>
                        <th>Semester</th>
                        <th>Period</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $start = 0;
                foreach ($kelas_data as $kelas) { ?>
                <tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo $kelas->nama_kode.' '.$kelas->tahun_masuk.' '.$kelas->nama_kelas ?></td>
                    <td><?php echo $kelas->nama_jurusan ?></td>
                    <td><?php echo $kelas->semester ?></td>
                    <td><?php echo $kelas->tahun_masuk.' / '.$kelas->tahun_keluar ?></td>
                    <td style="text-align:center" width="140px">
                    <?php 
                    echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="view_kelas('."'".$kelas->id_kelas."'".')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Detailed View"><i class="fa fa-eye"></i></a>'; 
                    echo '  ';
                    echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="add_collager('."'".$kelas->id_kelas."'".')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add Colleger"><i class="glyphicon glyphicon-plus"></i></a>';
                        echo '  '; 
                    echo '<a class="btn btn-xs btn-default btn-square new_page" href="javascript:void(0)" onclick="view_page('."'".$kelas->id_kelas."'".')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add Lessons"><i class="fa fa-folder-open-o"></i></a>';
                    echo '  ';
                    echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="delete_kelas('."'".$kelas->id_kelas."'".')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete Classroom"><i class="fa fa-trash-o"></i></a>'; 
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

    <div class="modal animated fadeInLeft" id="modal_form" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title modal-title">Classroom Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <form action="#" id="form" name="form" class="form-horizontal">
                            <input type="hidden" name="id_kelas"/> 
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="form-material form-material-primary">
                                            <label for="material-color-primary">Classroom</label>
                                            <input class="form-control" type="text" id="material-color-primary" name="nama_kelas" maxlength="1">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material form-material-primary">
                                            <label for="material-color-primary">Semester</label>
                                            <input class="form-control" type="text" id="material-color-primary" name="semester" maxlength="1">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="form-material form-material-primary">
                                            <label for="material-select">Major</label>
                                            <?= cmb_dinamis('id_jurusan','jurusan','nama_jurusan','id_jurusan','nama_jurusan') ?>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material form-material-primary">
                                            <label for="material-select">Period</label>
                                            <?= cmb_dinamis('id_tahun_ajaran','tahun_ajaran','tahun_masuk','id_tahun_ajaran','tahun_masuk') ?>
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
                        <h3 class="block-title modal-title">Classroom Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="material-disabled" name="nama_jurusan" disabled="">
                                        <label for="material-disabled">Major</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="material-disabled" name="nama_kelas" disabled="">
                                        <label for="material-disabled">Classroom</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="material-disabled" name="tahun_masuk" disabled="">
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
<script src="<?php echo base_url('template/plugins/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('template/plugins/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $("#mytable").dataTable();
    });

    function reload_table()
    {
        location.reload();
    }

    function view_page(id) {
        window.location.href = "<?php echo site_url('decide/open/')?>/" + id;
    }

    function add_collager(id) {
        window.location.href = "<?php echo site_url('kelas/open/')?>/" + id;
    }

    function report() {
        window.location.href = "<?php echo site_url('kelas/report/')?>/";
    }

    function view_kelas(id) {
        $.ajax({
            url : "<?php echo site_url('kelas/ajax_detail/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="nama_kelas"]').val(data.nama_kelas);
                $('[name="semester"]').val(data.semester);
                $('[name="nama_jurusan"]').val(data.nama_jurusan);
                $('[name="tahun_masuk"]').val(data.tahun_masuk);
                $('#modal-detail').modal('show');
                $('.modal-title').text('Detail Classroom');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops", "We couldn't connect to the server !", "error");
            }
        });
    }

    function add_kelas()
    {
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        $('.modal-title').text('Add Classroom');
    }

    function save()
    {
        var url;
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled',true);

        url = "<?php echo site_url('kelas/ajax_add')?>";
        
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

    function delete_kelas(id) {
        swal({
          title: "Are you sure ?", 
          text: "You can not retrieve this class once it is removed !", 
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Yes, Delete it !",
          confirmButtonColor: "#ec6c62"
          }, function() {
                $.ajax(
                    {
                        type: "POST",
                        url: "<?php echo site_url('kelas/ajax_delete')?>/" + id,
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
                swal("Deleted !", "Classroom was successfully deleted !", "success");
              })
              .error(function(data) {
                swal("Oops", "We couldn't connect to the server !", "error");
              });
        });
    }
</script>