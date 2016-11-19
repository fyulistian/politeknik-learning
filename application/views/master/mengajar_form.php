<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>
                    <?php $id = $this->uri->segment(3);
                    echo '<a class="btn btn-danger btn-sm btn-square" href="javascript:void(0)" onclick="add_classroom('."'".$id."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="Add Classroom"><i class="glyphicon glyphicon-plus"></i> Add Lesson</a>';
                    echo "    ";
                    echo '<button class="btn btn-default btn-sm btn-square" onclick="report('."'".$id."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="PDF"><i class="fa fa-file-pdf-o"></i> PDF</button>'; ?>
                </div><br/>
                <div class='box-body'>
                <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th width="80px">No</th>
                        <th>Course Code</th>
                        <th>Lesson</th>
                        <th>Classroom</th>
                        <th>Semester</th>
                        <th style="text-align:center">Action</th>
                </thead>
                <tbody>
                <?php $start = 0;
                foreach ($ajar as $mengajar) { ?>
                    <tr>
                        <td><?php echo ++$start ?></td>
                        <td><?php echo $mengajar->kode_matakuliah ?></td>
                        <td><?php echo $mengajar->nama_matakuliah ?></td>
                        <td><?php echo $mengajar->nama_kode.' '.$mengajar->tahun_masuk.' '.$mengajar->nama_kelas ?></td>
                        <td><?php echo $mengajar->semester ?></td>
                        <td style="text-align:center" >
                        <?php
                         echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="delete_classroom('."'".$mengajar->id_mengajar."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Delete Data"><i class="fa fa-trash-o"></i></a>';?>
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
                        <h3 class="block-title modal-title">Course Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <form action="#" id="form" name="form" class="form-horizontal">
                            <input type="hidden" name="nip"/>
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="material-select">Classroom</label>
                                            <select class='form-control' id='classroom' size='1'>
                                                <?php foreach ($data_class as $classroom) { ?>
                                                    <?php echo '<option name='.$classroom->id_kelas.' id='.$classroom->semester.' value='.$classroom->id_jurusan.'>'.$classroom->nama_kode.' '.$classroom->tahun_masuk.' '.$classroom->nama_kelas.'</option>' ?>
                                                <?php } ?>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="lesson_section">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="material-select">Lesson</label>
                                            <select class='form-control' id='lesson' name="id_matakuliah" size='1'></select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div id="id_kelas"></div>
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

</section>
<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('template/plugins/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('template/plugins/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    var save_method;
    var base_url = '<?php echo base_url();?>';

    $(document).ready(function () {
        $("#mytable").dataTable();
        $('#lesson_section').hide();
    });

    $("#classroom").change(function(){
        var value = $(this).val();
        var semester = $(this).children(":selected").attr("id");
        var idk = $(this).children(":selected").attr("name");
        $.ajax({
            type:"POST",
            url: "<?php echo site_url('mengajar/get_lesson') ?>",
            dataType: "JSON",
            data:{ id:value, sid:semester, tid:idk },
            success: function(data) {
                if (!$.trim(data)) {
                    swal("Oops", "We couldn't find the lesson !", "error");
                    window.setTimeout(
                            function() {
                                reload_table();
                            } ,1500);
                } else {
                    $('#lesson').html('');
                    $.each(data, function(i, data){
                        $('#lesson').append("<option value='"+data.id_matakuliah+"'>"+data.nama_matakuliah+"</option>");
                    });
                    $('#id_kelas').append("<input name='id_kelas' type='hidden' value='"+idk+"'/>");
                    $('#lesson_section').fadeIn(993);
                }
            }
        })
    });

    function reload_table()
    {
        location.reload();
    }

    function view_page (nip) {
        window.location.href = "<?php echo site_url('mengajar/edit/')?>/" + nip;
    }

    function report(id) {
        window.location.href = "<?php echo site_url('mengajar/report/')?>/" + id;
    }

    function add_classroom(id)
    {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url : "<?php echo site_url('mengajar/ajax_classroom/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="nip"]').val(data.nip);
                $('#lesson_section').hide();
                $('#modal_form').modal('show');
                $('.modal-title').text('Add Lesson');
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
        url = "<?php echo site_url('mengajar/ajax_add_classroom')?>";
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                console.log(data);
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
                console.log(jqXHR, textStatus, errorThrown);
                swal("Oops", "We couldn't connect to the server !", "error");
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
     
            }
        });
    }

    function delete_classroom(id) {
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
                        url : "<?php echo site_url('mengajar/ajax_delete_classroom')?>/" + id,
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