<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>
                  <button class="btn btn-danger btn-sm btn-square" onclick="add_course()" data-toggle="tooltip" data-placement="bottom"data-original-title="Add Course"><i class="glyphicon glyphicon-plus"></i> Add Course</button>
                </div><br/>
                <div class='box-body'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Course</th>
                                <th>Title</th>
                                <th>Description</th>
                    		    <th>Duration</th>
                                <th>Start Date</th>
                    		    <th>End Date</th>
                                <th>Status</th>
                    		    <th>Action</th>
                            </tr>
                        </thead>
            	    <tbody>
                        <?php
                        $start = 0;
                        foreach ($soal_data as $soal)
                        { ?>
                            <tr>
                    		    <td><?php echo ++$start ?></td>
                                <td><?php echo $soal->nama_matakuliah ?></td>
                                <td><?php echo $soal->nama_course ?></td>
                                <td><?php echo $soal->deskripsi ?></td>
                    		    <td><?php echo $soal->durasi ?></td>
                                <td><?php echo $soal->tanggal_course ?></td>
                    		    <td><?php echo $soal->end_course ?></td>
                                <td><?php echo $soal->status ?></td>
                    		    <td style="text-align:center" width="140px">
                    			<?php
                                echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="read_course('."'".$soal->id_course."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Detail Questions"><i class="fa fa-eye"></i></a>';
                    			echo '  '; 
                                echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="edit_course('."'".$soal->id_course."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Edit Course"><i class="fa fa-pencil-square-o"></i></a>';       
                    			echo '  ';
                                echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="delete_course('."'".$soal->id_course."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Delete Course"><i class="fa fa-trash-o"></i></a>'; ?>
                    		    </td>
            	           </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
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
                        <h3 class="block-title modal-title">Course Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                            <form action="#" id="form" name="form" class="form-horizontal">
                            <input type="hidden" name="id_course"/>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="material-select">Course</label>
                                            <select class='form-control' name='id_matakuliah' size='1'>
                                                <?php foreach ($soal_course as $key) { ?>
                                                    <?php echo '<option name='.$key->id_matakuliah.' value='.$key->id_matakuliah.'>'.$key->nama_matakuliah.'</option>' ?>
                                                <?php } ?>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <label for="material-color-primary">Title</label>
                                            <input class="form-control" type="text" name="nama_course" maxlength="35">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <label for="material-color-primary">Start Date</label>
                                            <input class="form-control datetimepicker1" type="text" name="tanggal_course" placeholder="yyyy-mm-dd" >
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <label for="material-color-primary">End Date</label>
                                            <input class="form-control datetimepicker2" type="text" name="end_course" placeholder="yyyy-mm-dd">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <label>Duration <small class="text-muted">in minutes</small></label>
                                            <input class="form-control" type="text" name="durasi" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <label for="material-select">Status</label>
                                            <select class="form-control" name="status" size="1">
                                                <option value="Not Available">Not Available</option>
                                                <option value="Available">Available</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <label for="material-color-primary">Description</label>
                                            <textarea class="form-control" name="deskripsi" rows="3"></textarea>
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

</section>

<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('template/plugins/datatables/dataTables.bootstrap.js') ?>"></script>
<script src="<?php echo base_url('template/plugins/datatables/jquery.dataTables.js') ?>"></script>
<script type="text/javascript">
    var save_method;

    $(document).ready(function () {
        $("#mytable").dataTable();

        $('.datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm'
        });
        $('.datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            useCurrent: false
        });
        $(".datetimepicker1").on("dp.change", function (e) {
            $('.datetimepicker2').data("DateTimePicker").minDate(e.date);
        });
        $(".datetimepicker2").on("dp.change", function (e) {
            $('.datetimepicker1').data("DateTimePicker").maxDate(e.date);
        });
    });

    function reload_table()
    {
        location.reload();
    }

    function read_course(id)
    {
        window.location.href = "<?php echo base_url('soal/read/')?>/" + id;
    }

    function add_course()
    {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        $('.modal-title').text('Add Data Course');
    }

    function edit_course(id)
    {
        save_method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url : "<?php echo site_url('soal/ajax_edit_course/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {   
                $('[name="id_course"]').val(data.id_course);
                $('[name="nama_course"]').val(data.nama_course);
                $('[name="id_matakuliah"]').val(data.id_matakuliah);
                $('[name="tanggal_course"]').val(data.tanggal_course);
                $('[name="end_course"]').val(data.end_course);
                $('[name="status"]').val(data.status);
                $('[name="deskripsi"]').val(data.deskripsi);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data Colleger');
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
            url = "<?php echo site_url('soal/ajax_add')?>";
        } else {
            url = "<?php echo site_url('soal/ajax_update_course')?>";
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
                    // console.log(data);
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

    function delete_course(id) {
        swal({
          title: "Are you sure ?", 
          text: "You can not retrieve this course once it is removed !", 
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Yes, Delete it !",
          confirmButtonColor: "#ec6c62"
          }, function() {
                $.ajax(
                    {
                        type: "POST",
                        url: "<?php echo site_url('soal/ajax_delete_course')?>/" + id,
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
                swal("Deleted !", "Course was successfully deleted !", "success");
              })
              .error(function(data) {
                swal("Oops", "We couldn't connect to the server !", "error");
              });
        });
    }

</script>
