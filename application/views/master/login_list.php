<section class='content'>
    <div class='class="block-content block-content-narrow"'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-header'>
                  <button class="btn btn-default btn-sm btn-square" onclick="report()" data-toggle="tooltip" data-placement="bottom"data-original-title="PDF"><i class="fa fa-file-pdf-o"></i> PDF</button>
                </div><br/>
                <div class='box-body'>
                    <table class="table table-bordered table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th width="80px">No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $start = 0; 
                    foreach ($login_data as $login) { ?>
                        <tr>
                            <td><?php echo ++$start ?></td>
                            <td><?php echo $login->nama_user ?></td>
                            <td><?php echo $login->email ?></td>
                            <td><?php echo $login->level ?></td>
                            <td style="text-align:center" width="140px">
                            <?php 
                            echo '<a class="btn btn-xs btn-default btn-square" href="javascript:void(0)" onclick="view_user('."'".$login->nama_user."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="View User"><i class="fa fa-eye"></i></a>'; 
                            echo '  '; 
                            echo anchor(site_url('login/reset/'.$login->nama_user),'<i class="fa fa-pencil-square-o"></i>',array('title'=>'edit','class'=>'btn btn-xs btn-default btn-edit btn-square','data-toggle'=>'tooltip','data-placement'=>'bottom','data-original-title'=>'Reset Password')); 
                            echo '  '; 
                            echo anchor(site_url('login/delete/'.$login->nama_user),'<i class="fa fa-trash-o"></i>','title="delete" class="btn btn-xs btn-default btn-hapus btn-square" data-toggle="tooltip" data-placement="bottom" data-original-title="Delete User"'); 
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

    <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-dialog-top">
          <div class="modal-content">
              <div class="block block-themed block-transparent remove-margin-b">
                  <div class="block-header bg-primary-dark">
                      <ul class="block-options">
                          <li>
                              <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                          </li>
                      </ul>
                      <h3 class="block-title modal-title">User Form</h3>
                  </div>
                  <div class="block-content">
                      <div class="modal-body form">
                          <div class="block-content block-content-narrow form-horizontal push-10-t">
                          <div class="form-group">
                              <div class="col-sm-4">
                                  <div class="form-material">
                                      <input class="form-control" type="text" id="material-disabled" name="nama_user" disabled="">
                                      <label for="material-disabled">Username</label>
                                  </div>
                              </div>
                              <div class="col-sm-4">
                                  <div class="form-material">
                                      <input class="form-control" type="text"  id="material-disabled" name="email" disabled="">
                                      <label for="material-disabled">Email</label>
                                  </div>
                              </div>
                              <div class="col-sm-4">
                                  <div class="form-material">
                                      <input class="form-control" type="text"  id="material-disabled" name="level" disabled="">
                                      <label for="material-disabled">Level</label>
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
<script src="<?php echo base_url('template/js/plugins/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('template/js/plugins/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#mytable").dataTable();
    });

    function report() {
        window.location.href = "<?php echo site_url('login/report/')?>/";
    }

    function view_user(id) {
        $.ajax({
            url : "<?php echo site_url('login/ajax_detail/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="nama_user"]').val(data.nama_user);
                $('[name="level"]').val(data.level);
                $('[name="email"]').val(data.email);
                $('#modal-detail').modal('show');
                $('.modal-title').text('Detail Data User');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    $('.btn-hapus').on("click", function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      swal({
          title: "Are you sure ?",
          text: "You can not retrieve this user once it is removed !",
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
            swal("Deleted ! ","User has been Removed !","success");
            window.setTimeout(
                function() {
                    window.location.replace(url);
                } ,1500);
          } else {
            swal("Cancelled"," User is Safe...","error");
          }
        });
    });
    
    $('.btn-edit').on("click", function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      swal({
          title: "Are you sure ?",
          text: "Password will be reset..",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, Reset it !",
          cancelButtonText: "No, Cancel it !",
          confirmButtonClass: "btn-danger",
          closeOnConfirm: false,
          closeOnCancel: false,
        },
        function(isConfirm) {
          if (isConfirm) {
            swal("Reset ! "," Your Default Password is politeknik !","success");
            window.setTimeout(
                function() {
                    window.location.replace(url);
                } ,1500);
          } else {
            swal("Cancelled"," Your Password is Safe","error");
          }
        });
    });
</script>