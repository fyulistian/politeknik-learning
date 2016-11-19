<div id="group-page" class="content content-narrow">
    <ol class="breadcrumb push-15">
        <li class="text-muted">Groups</li>
    </ol>
    <div class="block">
        <div class="block-header bg-gray-lighter">
            <ul class="block-options">
                <li>
                    <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                </li>
                <li>
                    <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                </li>
            </ul>
        </div>
        <div class="block-content">
            <table class="table table-striped table-borderless table-vcenter">
                <thead>
                    <tr>
                        <th colspan="2">My Groups</th>
                        <th class="text-center hidden-xs hidden-sm" style="width: 100px;"></th>
                        <th class="text-center hidden-xs hidden-sm" style="width: 100px;"></th>
                        <th class="hidden-xs hidden-sm" style="width: 200px;">Posted In</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_group as $group) { ?>
                    <tr>
                        <td class="text-center" style="width: 75px;">
                            <i class="si si-badge fa-2x"></i>
                        </td>
                        <td>
                            <h4 class="h5 font-w600 push-5">
                                <!-- <a href="javascript:void(0)"><?php echo $group->nama_group ?></a> -->
                                <?php echo '<a href="javascript:void(0)" onclick="get_details('."'".$group->id_group."'".')">'.$group->nama_group.'</a>'; ?>
                            </h4>
                        </td>
                        <td class="text-center hidden-xs hidden-sm">
                            <a class="font-w600"></a>
                        </td>
                        <td class="text-center hidden-xs hidden-sm">
                            <a class="font-w600"></a>
                        </td>
                        <td class="hidden-xs hidden-sm">
                            <span class="font-s13">
                                <?php echo date('F d, Y', strtotime($group->pembuatan_group)); ?>
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
<script type="text/javascript">

    function get_details(id) {
        $.ajax({
           url : "<?php echo site_url('home/details')?>/" + id,
           success: function(html) {
              $("#group-page").html("");
              $(html).hide().appendTo("#group-page").fadeIn(1000);
            }
          });
    }

</script>