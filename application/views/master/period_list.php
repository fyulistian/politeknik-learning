<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>
                    <button class="btn btn-danger btn-sm btn-square" onclick="add_period()" data-toggle="tooltip" data-placement="bottom"data-original-title="Add Period"><i class="glyphicon glyphicon-plus"></i> Add Period</button>
                    <button class="btn btn-default btn-sm btn-square" onclick="report()" data-toggle="tooltip" data-placement="bottom"data-original-title="PDF"><i class="fa fa-file-pdf-o"></i> PDF</button>
                </div><br/>
                <div class='box-body'>
                <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th width="80px">No</th>
                        <th>Period</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $start = 0;
                foreach ($period_data as $period) { ?>
                    <tr>
                        <td><?php echo ++$start ?></td>
                        <td><?php echo $period->tahun_masuk.' / '.$period->tahun_keluar ?></td>
                        <td style="text-align:center" width="140px">
                        <?php
                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="view_period('."'".$period->id_tahun_ajaran."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="View Period"><i class="fa fa-eye"></i></a>'; 
                        echo '  '; 
                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="edit_period('."'".$period->id_tahun_ajaran."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="Edit Period"><i class="fa fa-pencil-square-o"></i></a>';
                        echo '  '; 
                        echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="delete_period('."'".$period->id_tahun_ajaran."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="Delete Period"><i class="fa fa-trash-o"></i></a>'; ?>
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
        <div class="modal-dialog modal-dialog-top modal-sm">
            <div class="modal-content">
                <div class="block block-themed block-transparent remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                            </li>
                        </ul>
                        <h3 class="block-title modal-title">Period Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <form action="#" id="form" name="form" class="form-horizontal">
                            <input type="hidden" name="id_tahun_ajaran"/> 
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="js-datetimepicker form-material input-group date">
                                            <label for="example-datepicker5">Period</label>
                                            <input type="text" placeholder="yyyy" data-date-format="yyyy" class="form-control datepicker" name="tahun_masuk" >
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
                    <button class="btn btn-sm btn-primary" type="button" id="btnSave" onclick="save()" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Close</button>
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
                        <h3 class="block-title modal-title">Period Form</h3>
                    </div>
                    <div class="block-content">
                        <div class="modal-body form">
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <input class="form-control" type="text" id="material-disabled" name="tahun_masuk" disabled="">
                                            <label for="material-disabled">Period</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <input class="form-control" type="text" id="material-disabled" name="tahun_keluar" disabled="">
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
        format: " yyyy",
        viewMode: "years", 
        minViewMode: "years"
    });

    function reload_table()
    {
        location.reload();
    }
    
    function view_period(id) {
        $.ajax({
            url : "<?php echo site_url('period/ajax_detail/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="tahun_masuk"]').val(data.tahun_masuk);
                $('[name="tahun_keluar"]').val(data.tahun_keluar);
                $('#modal-detail').modal('show');
                $('.modal-title').text('Detail Period');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops", "We couldn't connect to the server !", "error");
            }
        });
    }

    function report() {
        window.location.href = "<?php echo site_url('period/report/')?>/";
    }

    function add_period()
    {
        save_method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        $('.modal-title').text('Add Data Period');
    }

    function save()
    {
        var url;
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled',true);

        if(save_method == 'add') {
            url = "<?php echo site_url('period/ajax_add')?>";
        } else {
            url = "<?php echo site_url('period/ajax_update')?>";
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

    function edit_period(id)
    {
        save_method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url : "<?php echo site_url('period/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id_tahun_ajaran"]').val(data.id_tahun_ajaran);
                $('[name="tahun_masuk"]').val(data.tahun_masuk);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data Period');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops", "We couldn't connect to the server !", "error");
            }
        });
    }

    function delete_period(id) {
        swal({
          title: "Are you sure ?", 
          text: "You can not retrieve this period once it is removed !", 
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Yes, Delete it !",
          confirmButtonColor: "#ec6c62"
          }, function() {
                $.ajax(
                    {
                        type: "POST",
                        url: "<?php echo site_url('period/ajax_delete')?>/" + id,
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
                swal("Deleted !", "Period was successfully deleted !", "success");
              })
              .error(function(data) {
                swal("Oops", "We couldn't connect to the server !", "error");
              });
        });
    }
</script>