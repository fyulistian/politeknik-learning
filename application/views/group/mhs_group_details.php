<div id="group-page" class="content content-narrow">
    <ol class="breadcrumb push-15">
        <li><a class="link-effect" href="javascript:void()" onclick="group_page()">Groups</a></li>
        <li class="text-muted">My Groups</li>
    </ol>
    <div class="block">
        <div class="block-header bg-gray-lighter">
            <ul class="block-options">
                <li>
                    <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                </li>
                <li>
                    <button type="button" id="refresh" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                </li>
            </ul>
        </div>
        <div class="block-header bg-gray-lighter">
            <ul class="block-options">
                <ul class="block-options">
                    <li>
                        <h3 class="block-title">My Groups</h3>
                    </li>
                </ul>
            </ul>
        </div>
        <div class="block-content">
            <table class="table table-striped table-borderless">
                <tbody>
                <?php foreach ($data_group as $group) { ?>
                    <tr>
                        <td class="ribbon ribbon-bookmark ribbon-primary ribbon-left ribbon-bottom">
                            <div class="ribbon-box font-w600">
                                <i class="glyphicon glyphicon-pushpin"></i>
                            </div>
                        </td>
                        <td class="font-s13 text-muted">
                        <span class="pull-left">
                            <span class="text-primary"><?php echo ucwords($group->nama_depan).', '.ucwords($group->nama_belakang) ?></span>&nbsp;<small><?php echo date('F d, Y - H:i', strtotime($group->publish_date)); ?></small>
                        </span>
                        <?php echo '<a href="javascript:void(0)" target="_blank" onclick="attachment('."'".$group->group_file."'".')"><i class="fa fa-paperclip pull-right"></i></a>'; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center hidden-xs" style="width: 140px;">
                            <div class="push-10">
                                <img class="img-avatar" src="<?php echo base_url($group->gambar) ?>" alt="">
                            </div>
                        </td>
                        <td>
                            <p style="text-align: justify;"><?php echo $group->group_content ?></p>
                            <hr>
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

    function reload_table()
    {
        location.reload();
    }
    
    function attachment(id) {
        var url = "<?php echo site_url()?>" + id;
        var win = window.open(url, '_blank');
        win.focus();

    }
    function group_page() {
        $.ajax({
           url : "<?php echo site_url('home/backToGroup')?>/",
           success: function(html) {
              $("#group-page").html("");
              $(html).hide().appendTo("#group-page").fadeIn(1000);
            }
          });
    }
    
</script>