<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class="box-header">
                    <ol class="breadcrumb pull-right">
                        <li>
                            <a href="<?php echo base_url('kelas'); ?>">Classroom</a>
                        </li>
                        <li class="active"><?php echo $classroom; ?></li>
                    </ol>
                </div>
                <div class='box-header'>
                  <button class="btn btn-danger btn-sm btn-square" onclick="add_kelas()" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add Colleger"><i class="glyphicon glyphicon-plus"></i> Add Colleger</button>
                  <?php echo '<button class="btn btn-default btn-sm btn-square" onclick="report('."'".$id_kelas."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="PDF"><i class="fa fa-file-pdf-o"></i> PDF</button>'; ?>
                </div><br/>
                <div class='box-body'>
                <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th width="80px">No</th>
                        <th>NIM</th>
                        <th>Full Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $start = 0;
                foreach ($mhs_data as $kelas) { ?>
                <tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo $kelas->nim ?></td>
                    <td><?php echo ucfirst($kelas->nama_depan).' '.ucfirst($kelas->nama_belakang) ?></td>
                    <td style="text-align:center" width="140px">
                    <?php
                    echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="delete_kelas('."'".$kelas->nim."'".')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete Colleger"><i class="fa fa-trash-o"></i></a>'; 
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
                            <input type="hidden" name="id_kelas" value="<?php echo $this->uri->segment(3);; ?>" />
                            <div class="block-content block-content-narrow form-horizontal push-10-t">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material form-material-primary">
                                            <label for="material-select">NIM</label>
                                            <?= cmb_dinamis('nim','mahasiswa','nim','nim','nim') ?>
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

    function report(id) {
        window.location.href = "<?php echo site_url('kelas/report_mahasiswa/')?>/" + id;
    }

    function add_kelas()
    {
        $('#form')[0].reset();
        $('#btnSave').attr('disabled',false);
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_form').modal('show');
        $('.modal-title').text('Add Colleger');
    }

    function save()
    {
        var url;
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled',true);

        url = "<?php echo site_url('kelas/ajax_in')?>";
        
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
                        url: "<?php echo site_url('kelas/ajax_del')?>/" + id,
                        dataType: "JSON",
                        success: function(data){
                            // console.log(data);
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