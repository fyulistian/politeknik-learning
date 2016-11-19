<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>
                <?php if ($this->session->flashdata('file')) { ?>
                    <div class="alert alert-warning" id="error-alert"> <?= $this->session->flashdata('file') ?> </div>
                <?php } ?>
                <?php if ($this->session->flashdata('message')) { ?>
                    <div class="alert alert-danger" id="notif-alert"> <?= $this->session->flashdata('message') ?> </div> 
                <?php }
                      foreach ($QS as $key):  
                      $id    = $key->id_course;
                      $title = $key->nama_course;
                      endforeach ?>
                    <div class="form-group pull-left col-sm-12">
                        <div class="col-sm-3">
                            <form action="<?php echo base_url();?>soal/import_question/" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id_course" value="<?php echo $id; ?>" />
                                <label>Upload File <small class="text-muted">.xlxs .xls .csv</small></label>
                                <input type="file" name="file"/>
                                <span class="help-block"></span><br/>
                                <input type="submit" value="Upload file" class="btn btn-danger btn-sm btn-square" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Import Questions"/>
                            </form>  
                        </div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3">
                        </div>
                            <button class="btn btn-info btn-sm btn-square pull-right" onclick="download_format()" data-toggle="tooltip" data-placement="bottom"data-original-title="Download Format"><i class="si si-cloud-download"></i> Download Format</button>
                        </div>
                    </div>
                </div>
                </div><br/><br/><br/><br/><br/><br/><br/>
                <div class='box-body'>
                    <ol class="breadcrumb pull-right">
                        <li>
                            <a href="<?php echo base_url('soal'); ?>">Course</a>
                        </li>
                        <li class="active"><?php echo $title; ?></li>
                    </ol>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Questions</th>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th>
                                <th>E</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $start = 0;
                        foreach ($QS as $soal) { ?>
                        <tr>
                            <td><?php echo ++$start ?></td>
                            <td><?php echo $soal->soal ?></td>
                            <td><?php echo $soal->pilihan_1 ?></td>
                            <td><?php echo $soal->pilihan_2 ?></td>
                            <td><?php echo $soal->pilihan_3 ?></td>
                            <td><?php echo $soal->pilihan_4 ?></td>
                            <td><?php echo $soal->pilihan_5 ?></td>
                            <td><?php echo $soal->kunci_jawaban ?></td>
                            <td style="text-align:center" width="140px">
                              <?php 
                                echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="edit_question('."'".$soal->id_soal."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Edit Question"><i class="fa fa-pencil-square-o"></i></a>';
                                echo '  ';
                                echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="delete_question('."'".$soal->id_soal."'".')" data-toggle="tooltip" data-placement="bottom" data-original-title="Delete Question"><i class="fa fa-trash-o"></i></a>'; ?>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
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
                        <h3 class="block-title modal-title">Question Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                            <form action="#" id="form" name="form" class="form-horizontal">
                            <input type="hidden" name="id_soal"/>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <label for="material-color-primary">Question</label>
                                            <textarea class="form-control" name="soal" rows="3"></textarea>
                                            <span class="help-block"></span>
                                        </div>    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <label for="material-color-primary">Option A</label>
                                            <input class="form-control" type="text" name="pilihan_1" maxlength="35">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <label for="material-color-primary">Option D</label>
                                            <input class="form-control" type="text" name="pilihan_4" maxlength="35">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <label for="material-color-primary">Option B</label>
                                            <input class="form-control" type="text" name="pilihan_2" maxlength="35">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <label for="material-color-primary">Option E</label>
                                            <input class="form-control" type="text" name="pilihan_5" maxlength="35">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <label for="material-color-primary">Option C</label>
                                            <input class="form-control" type="text" name="pilihan_3" maxlength="35">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material ">
                                            <label for="material-color-primary">Answer</label>
                                            <select class="form-control" name="kunci_jawaban" size="1">
                                                <option value="pilihan_1">A</option>
                                                <option value="pilihan_2">B</option>
                                                <option value="pilihan_3">C</option>
                                                <option value="pilihan_4">D</option>
                                                <option value="pilihan_5">E</option>
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

</section>
<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('template/plugins/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    var save_method;

    $(document).ready(function () {
        $("#mytable").dataTable();
    });

    $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#error-alert").slideUp(500);
    });

     $("#notif-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#notif-alert").slideUp(500);
    });

    function reload_table()
    {
        location.reload();
    }

    function download_format()
    {
        window.location.href = "<?php echo base_url('uploads/question-format.xlsx')?>";
    }

    function edit_question(id)
    {
        save_method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url : "<?php echo site_url('soal/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {   
                $('[name="id_soal"]').val(data.id_soal);
                $('[name="soal"]').val(data.soal);
                $('[name="pilihan_1"]').val(data.pilihan_1);
                $('[name="pilihan_2"]').val(data.pilihan_2);
                $('[name="pilihan_3"]').val(data.pilihan_3);
                $('[name="pilihan_4"]').val(data.pilihan_4);
                $('[name="pilihan_5"]').val(data.pilihan_5);;
                $('[name="kunci_jawaban"]').val(data.kunci_jawaban);
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
        url = "<?php echo site_url('soal/ajax_save')?>";
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

    function delete_question(id) {
        swal({
          title: "Are you sure ?", 
          text: "You can not retrieve this question once it is removed !", 
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Yes, Delete it !",
          confirmButtonColor: "#ec6c62"
          }, function() {
                $.ajax(
                    {
                        type: "POST",
                        url: "<?php echo site_url('soal/ajax_delete')?>/" + id,
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
                swal("Deleted !", "Question was successfully deleted !", "success");
              })
              .error(function(data) {
                swal("Oops", "We couldn't connect to the server !", "error");
              });
        });
    }

</script>