<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <div class='box-body'>
                <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th width="80px">No</th>
                        <th>NIP</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $start = 0;
                foreach ($dosen_data as $dosen) { ?>
                    <tr>
                        <td><?php echo ++$start ?></td>
                        <td><?php echo $dosen->nip ?></td>
                        <td><?php echo ucfirst($dosen->nama_depan).' '.ucfirst($dosen->nama_belakang) ?></td>
                        <td><?php echo $dosen->email ?></td>
                        <td><?php echo ucfirst($dosen->gender) ?></td>
                        <td style="text-align:center" width="140px">
                        <?php 
                        echo '<a class="btn btn-xs btn-default btn-square new_page" href="javascript:void(0)" onclick="view_page('."'".$dosen->nip."'".')" data-toggle="tooltip" data-placement="bottom"data-original-title="Open Page"><i class="fa fa-folder-open-o"></i></a>'; ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('template/js/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('template/js/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $("#mytable").dataTable();
    });

    function view_page (nip) {
        window.location.href = "<?php echo site_url('mengajar/teach/')?>/" + nip;
    }
    
</script>