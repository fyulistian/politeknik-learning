<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>
                    <h3 class='box-title'>
                        <button class="btn btn-danger btn-sm btn-square" onclick="add_file()" data-toggle="tooltip" data-placement="bottom"data-original-title="Upload File"><i class="si si-cloud-upload"></i>&nbsp;&nbsp;&nbsp;Upload File</button>
                        &nbsp;
                    </h3>
                </div>
                <br/>
                <div class='box-body'>
                    <table class="table" id="mytable">
                    <thead>
                        <tr>
                            <th width="80px">No</th>
                            <th>Course</th>
                            <th>Title</th>
                            <th>Name File</th>
                            <th>Upload Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $start = 0;
                        foreach ($upload_data as $upload)
                        { ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $upload->nama_course ?></td>
                                <td><?php echo $upload->judul_materi ?></td>
                                <td><?php echo $upload->nama_materi ?></td>
                                <td><?php echo $upload->tanggal_upload ?></td>
                                <td style="text-align:center" width="160px">
                                    <?php
                                        // echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="download_file('."'".$upload->nama_materi."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Download File"><i class="si si-cloud-download"></i></a>'; 
                                        // echo '  ';
                                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="detail_file('."'".$upload->id_materi."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Detail File"><i class="fa fa-eye"></i></a>';
                                        echo '  ';
                                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="edit_file('."'".$upload->id_materi."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Edit File"><i class="fa fa-pencil-square-o"></i></a>';
                                        echo '  ';
                                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="delete_file('."'".$upload->id_materi."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Delete Course"><i class="fa fa-trash-o"></i></a>'; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal animated fadeInRight" id="modal_edit" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title modal-title">Upload Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                            <form action="#" id="form_edit" name="form" class="form-horizontal">
                            <input type="hidden" name="id_materi"/>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <label for="material-select">Title</label>
                                            <input class="form-control" type="text" name="judul_materi" maxlength="35">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12"></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <label id="label-file">Upload File</label>
                                            <input type="file" name="file"/>
                                            <small class="text-muted">.docx .xlsx .pptx .pdf MAX 2MB</small>
                                            <span class="help-block"></span><br/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-5"></div>
                                    <div class="col-sm-5" id="remove-file">
                                        <div class="form-material">
                                            <input class="form-control" type="text" name="tanggal_upload" disabled="">
                                            <label for="material-disabled">Upload Date</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
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
                        <h3 class="block-title modal-title">Upload Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                            <form action="#" id="form" name="form" class="form-horizontal">
                            <input type="hidden" name="id_materi"/>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="form-material form-material-primary">
                                        <label for="material-select">Course</label>
                                        <select class='form-control' size='1' name="id_course">
                                            <?php foreach ($course_data as $course) { ?>
                                                <?php echo '<option value='.$course->id_course.'>'.ucwords($course->nama_course).'</option>' ?>
                                            <?php } ?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="form-material">
                                        <label for="material-select">Title</label>
                                        <input class="form-control" type="text" name="judul_materi" maxlength="35">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="form-material">
                                        <label>Upload File <small class="text-muted">.docx .xlsx .pptx .pdf</small></label>
                                        <input type="file" name="file"/>
                                        <span class="help-block"></span><br/>
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
    <div class="modal animated zoomIn" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title modal-title">Upload Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <input class="form-control" type="text" name="judul_materi" disabled="">
                                            <label for="material-disabled">Title</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <input class="form-control" type="text" name="nama_matakuliah" disabled="">
                                            <label for="material-disabled">Subjects</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <input class="form-control" type="text" name="nama_course" disabled="">
                                            <label for="material-disabled">Course Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <input class="form-control" type="text" name="nama_materi" disabled="">
                                            <label for="material-disabled">File Name</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <input class="form-control" type="text" name="tanggal_upload" disabled="">
                                            <label for="material-disabled">Upload Date</label>
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
<script src="<?php echo base_url('template/js/sweetalert2.min.js') ?>"></script>
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

    function download_file(id)
    {
        window.location.href = "<?php echo site_url('uploads/file/')?>/" + id;
    }

    function add_file()
    {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        $('.modal-title').text('Add File Course');
    }

    function save()
    {
        var url;
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled',true);
        url = "<?php echo site_url('upload/ajax_add')?>";
        var formData = new FormData($('#form')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) {
                    $('#modal_form').modal('hide');
                    reload_table();
                } else  {
                    for (var i = 0; i < data.inputerror.length; i++) {
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
        url = "<?php echo site_url('upload/ajax_update')?>";
        var formData = new FormData($('#form_edit')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
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
                $('#btnEdit').text('save'); 
                $('#btnEdit').attr('disabled',false); 
     
            }
        });
    }

    function detail_file(id) {
        $.ajax({
            url : "<?php echo site_url('upload/ajax_detail/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="nama_course"]').val(data.nama_course);
                $('[name="nama_matakuliah"]').val(data.nama_matakuliah);
                $('[name="tanggal_upload"]').val(data.tanggal_upload);
                $('[name="judul_materi"]').val(data.judul_materi);
                $('[name="nama_materi"]').val(data.nama_materi);
                $('#modal-detail').modal('show');
                $('.modal-title').text('Detail Data File');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops", "We couldn't connect to the server !", "error");
            }
        });
    }

    function edit_file(id)
    {
        save_method = 'update';
        $('#form_edit')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url : "<?php echo site_url('upload/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {   
                $('[name="id_materi"]').val(data.id_materi);
                $('[name="nama_materi"]').val(data.nama_materi);
                $('[name="judul_materi"]').val(data.judul_materi);
                $('[name="tanggal_upload"]').val(data.tanggal_upload);
                $('#modal_edit').modal('show');
                $('.modal-title').text('Edit Data File');
                if(data.nama_materi) {
                    $('#label-file').text('Change File');
                    $('#remove-file div').append('<input type="checkbox" name="remove_file" value="'+data.nama_materi+'"/> Remove file when saving');
                } else {
                    $('#label-file').text('Upload File');
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops", "We couldn't connect to the server !", "error");
            }
        });
    }

    function delete_file(id) {
        swal({
          title: "Are you sure ?", 
          text: "You can not retrieve this file once it is removed !", 
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Yes, Delete it !",
          confirmButtonColor: "#ec6c62"
          }, function() {
                $.ajax(
                    {
                        type: "POST",
                        url: "<?php echo site_url('upload/ajax_delete')?>/" + id,
                        dataType: "JSON",
                        success: function(data){
                            $('#modal_form').modal('hide');
                            window.setTimeout(
                            function() {
                                reload_table();
                            } ,1300);
                        }
                    }
                )
              .done(function(data) {
                swal("Deleted !", "File was successfully deleted !", "success");
              })
              .error(function(data) {
                swal("Oops", "We couldn't connect to the server !", "error");
              });
        });
    }

    $('.sweetdelete').on("click", function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      swal({
          title: "Are you sure ?",
          text: "You can not retrieve the file once it is removed !",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, Remove it !",
          cancelButtonText: "No, Cancel it !",
          confirmButtonClass: "btn-danger",
          closeOnConfirm: false,
          closeOnCancel: false,
        },
        function(isConfirm) {
          if (isConfirm) {
            swal("Deleted ! ","Your File has been Removed !","success");
            window.setTimeout(
                function() {
                    window.location.replace(url);
                } ,1200);
          } else {
            swal("Cancelled"," Your File is Safe :)","error");
          }
        });
    });
</script>