<div class="col-sm-9">
    <div class="block">
        <div class="block-content">
            <div class="font-w600 font-s12 text-uppercase text-muted push-10">Course</div>
            <?php //echo $smt ?>
            <?php //echo $jur ?>
            <section class='content'>
                <div class='row'>
                    <div class='col-xs-12'>
                        <div class='box'>
                            <div class='box-header'>
                                <?php if ($this->session->flashdata('notification')) { ?>
                                    <div class="alert alert-info" id="error-alert"> 
                                        <i class="si si-info fa-lg"></i> &nbsp;<?= $this->session->flashdata('notification') ?> 
                                    </div> 
                                <?php } ?>
                                <button class="btn btn-danger btn-sm btn-square" onclick="add_matakuliah()" data-toggle="tooltip" data-placement="bottom"data-original-title="Add Course"><i class="glyphicon glyphicon-plus"></i> Add Course</button>
                                <button class="btn btn-default btn-sm btn-square" onclick="report()" data-toggle="tooltip" data-placement="bottom"data-original-title="PDF"><i class="fa fa-file-pdf-o"></i> PDF</button>
                            </div><br/>
                            <div class='box-body'>
                            <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Course</th>
                                    <th>SKS</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($matakuliah_data as $matakuliah) { ?>
                            <tr>
                                <td><?php echo $matakuliah->kode_matakuliah ?></td>
                                <td><?php echo $matakuliah->nama_matakuliah ?></td>
                                <td><?php echo $matakuliah->sks ?></td>
                                <td style="text-align:center" width="140px">
                                <?php 
                                echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="view_matakuliah('."'".$matakuliah->id_matakuliah."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="View Course"><i class="fa fa-eye"></i></a>'; 
                                echo '  '; 
                                echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="edit_matakuliah('."'".$matakuliah->id_matakuliah."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="Edit Course"><i class="fa fa-pencil-square-o"></i></a>'; 
                                echo '  '; 
                                echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="delete_matakuliah('."'".$matakuliah->id_matakuliah."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="Delete Course"><i class="fa fa-trash-o"></i></a>'; ?>
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
                                        <input type="hidden" name="id_matakuliah"/> 
                                        <input type="hidden" name="smt"/> 
                                        <input type="hidden" name="jur"/> 
                                        <div class="block-content block-content-narrow form-horizontal push-10-t">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="form-material form-material-primary">
                                                        <label for="material-color-primary">Course Name</label>
                                                        <input class="form-control" type="text" id="material-color-primary" name="nama_matakuliah"maxlength="35">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="form-material form-material-primary">
                                                        <label for="material-color-primary">SKS</label>
                                                        <input class="form-control" type="text" name="sks" maxlength="1">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="seeIt">
                                                <div class="col-sm-8">
                                                    <div class="form-material form-material-primary">
                                                        <select class="form-control" name="kelompok_matakuliah" size="1">
                                                            <option value="MPK" selected="">MPK</option>
                                                            <option value="MKK">MKK</option>
                                                            <option value="MKB">MKB</option>
                                                            <option value="MPB">MPB</option>
                                                            <option value="MBB">MBB</option>
                                                        </select>
                                                        <label for="material-select2">Course Group</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-material form-material-primary">
                                                        <label for="material-color-primary">Serial Number</label>
                                                        <input class="form-control" type="text" name="seri_num" maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
                                    <h3 class="block-title modal-title">Matakuliah Form</h3>
                                </div>
                                <div class="block-content">
                                    <div class="modal-body form">
                                        <div class="block-content block-content-narrow form-horizontal push-10-t">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="form-material">
                                                    <input class="form-control" type="text" name="kode_matakuliah" disabled="">
                                                    <label for="material-disabled">Course Code</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <div class="form-material">
                                                    <input class="form-control" type="text" name="nama_matakuliah" disabled="">
                                                    <label for="material-disabled">Course Name</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-material form-material-primary">
                                                    <input class="form-control" type="text" name="sks" disabled="">
                                                    <label for="material-color-primary">SKS</label>
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
        </div>
    </div>
</div>
<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('template/js/core/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('template/plugins/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('template/plugins/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    var save_method;
    var smt = "<?php echo $smt ?>";
    var jur = "<?php echo $jur ?>";

    $(document).ready(function () {
        $("#mytable").dataTable();
        $("#" + jur).addClass('active');
    });

    $("#error-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#error-alert").slideUp(500);
    });

    function reload_table()
    {
        location.reload();
    }

    function report() {
        window.location.href = "<?php echo site_url('matakuliah/report/')?>/"+ smt +"/"+ jur;
    }

    function view_matakuliah(id) {
        $.ajax({
            url : "<?php echo site_url('matakuliah/ajax_detail/')?>/" + id +"/"+ smt +"/"+ jur,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="kode_matakuliah"]').val(data.kode_matakuliah);
                $('[name="nama_matakuliah"]').val(data.nama_matakuliah);
                $('[name="sks"]').val(data.sks);
                $('#modal-detail').modal('show');
                $('.modal-title').text('Detail Data Course');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops", "We couldn't connect to the server !", "error");
            }
        });
    }

    function add_matakuliah()
    {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#seeIt').show();
        $('#btnSave').attr('disabled',false);
        $('[name="smt"]').val(smt);
        $('[name="jur"]').val(jur);
        $('#modal_form').modal('show');
        $('.modal-title').text('Add Data Course');
    }

    function edit_matakuliah(id)
    {
        save_method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url : "<?php echo site_url('matakuliah/ajax_edit/')?>/" + id +"/"+ smt +"/"+ jur,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id_matakuliah"]').val(data.id_matakuliah);
                $('[name="nama_matakuliah"]').val(data.nama_matakuliah);
                $('[name="sks"]').val(data.sks);
                $('#seeIt').hide();
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data Course');
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
        $('#btnSave').attr('disabled',true);

        if(save_method == 'add') {
            url = "<?php echo site_url('matakuliah/ajax_add')?>";
        } else {
            url = "<?php echo site_url('matakuliah/ajax_update')?>";
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

    function delete_matakuliah(id) {
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
                        url: "<?php echo site_url('matakuliah/ajax_delete')?>/" + id,
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
                swal("Deleted !", "Course was successfully deleted !", "success");
              })
              .error(function(data) {
                swal("Oops", "We couldn't connect to the server !", "error");
              });
        });
    }
</script>