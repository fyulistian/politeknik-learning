<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-body'>
                <div class="box-header">
                    <ol class="breadcrumb pull-right">
                        <li>
                            <a href="<?php echo base_url('kelas'); ?>">Classroom</a>
                        </li>
                        <li class="active"><?php echo $classroom; ?></li>
                    </ol>
                </div>
                <div class='box-header'>
                    <button class="btn btn-danger btn-sm btn-square" onclick="add_lessons()" data-toggle="tooltip" data-placement="bottom"data-original-title="Add Lessons"><i class="glyphicon glyphicon-plus"></i> Add Lesson</button>
                    <?php echo '<button class="btn btn-default btn-sm btn-square" onclick="report('."'".$id_kelas."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="PDF"><i class="fa fa-file-pdf-o"></i> PDF</button>'; ?>
                </div><br/>
                <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th width="80px">No</th>
                        <th>Lesson Name</th>
                        <th>SKS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $start = 0;
                foreach ($value as $value) { ?>
                    <tr>
                        <td><?php echo ++$start ?></td>
                        <td><?php echo $value->nama_matakuliah ?></td>
                        <td><?php echo $value->sks ?></td>
                        <td style="text-align:center" width="140px">
                        <?php
                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="view_lesson('."'".$value->id_diajar."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="View Lessons"><i class="fa fa-eye"></i></a>'; 
                        echo '  ';
                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="delete_lesson('."'".$value->id_diajar."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Delete Lessons"><i class="fa fa-trash-o"></i></a>'; ?>
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
                        <h3 class="block-title modal-title">Mahasiswa Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                            <form action="#" id="form" name="form" class="form-horizontal">
                            <input type="hidden" name="semester" value="<?php echo $semester; ?>" />
                            <input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="material-select">Courses</label>
                                            <select class='form-control' name='id_matakuliah' size='1'>
                                                <?php foreach ($value1 as $key) { ?>
                                                    <?php echo '<option name='.$key->id_matakuliah.' value='.$key->id_matakuliah.'>'.$key->nama_matakuliah.'</option>' ?>
                                                <?php } ?>
                                            </select>
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
                        <h3 class="block-title modal-title">Mahasiswa Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <input class="form-control" type="text" name="nama_matakuliah" disabled="">
                                            <label for="material-disabled">Lesson Name</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material form-material-primary">
                                            <label for="material-color-primary">SKS</label>
                                            <input class="form-control" type="text" name="sks" disabled="">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <input class="form-control" type="text" name="nama_kelas" value="<?php echo $classroom; ?>" disabled="">
                                            <label for="material-disabled">Classroom</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <input class="form-control" type="text" name="semester" disabled="">
                                            <label for="material-disabled">Semester</label>
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

    $(document).ready(function () {
        $("#mytable").DataTable();
    });

    function reload_table()
    {
        location.reload();
    }

    function report(id) {
        window.location.href = "<?php echo site_url('decide/report_course/')?>/" + id;
    }
    
    function view_lesson(id) {
        $.ajax({
            url : "<?php echo site_url('decide/ajax_detail/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="nama_matakuliah"]').val(data.nama_matakuliah);
                $('[name="semester"]').val(data.semester);
                $('[name="sks"]').val(data.sks);
                $('#modal-detail').modal('show');
                $('.modal-title').text('Detail Data Lesson');

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops", "We couldn't connect to the server !", "error");
            }
        });
    }

    function add_lessons()
    {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        $('.modal-title').text('Add Data Lesson');
    }

    function save()
    {
        var url;
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled',true);
        url = "<?php echo site_url('decide/ajax_add')?>";
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

    function delete_lesson(id) {
        swal({
          title: "Are you sure ?", 
          text: "You can not retrieve this lesson once it is removed !", 
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Yes, Delete it !",
          confirmButtonColor: "#ec6c62"
          }, function() {
                $.ajax(
                    {
                        type: "POST",
                        url : "<?php echo site_url('decide/ajax_delete')?>/" + id,
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
                swal("Deleted !", "Lesson was successfully deleted !", "success");
              })
              .error(function(data) {
                swal("Oops", "We couldn't connect to the server !", "error");
              });
        });
    }
</script>