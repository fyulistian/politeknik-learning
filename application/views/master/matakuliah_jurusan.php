<div class="col-sm-3">
    <div class="block">
        <div class="block-content">
            <div class="font-w600 font-s12 text-uppercase text-muted push-10">Major</div>
            <ul class="nav nav-pills nav-stacked push">
            <?php foreach ($data_jurusan as $jurusan) { ?>
                <li class="param" id="<?php echo $jurusan->nama_kode ?>">
                    <a class="link" href="javascript:void(0)"><i class="fa fa-fw fa-angle-right push-5-r"></i><?php echo $jurusan->nama_jurusan ?></a>
                </li>
            <?php } ?>
            </ul>
        </div>
    </div>
</div>
<div id="list"></div>

<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
<script>
    $('.link').click(function() {
        var smt = "<?php echo $smt; ?>";
        var jrs = $(this).closest(".param").attr("id");
    $.ajax({
       url : "<?php echo site_url('matakuliah/list_course')?>/" + smt +"/"+ jrs,
       success: function(html) {
          $(".param").removeClass("active");
          $("#list").html("");
          $(html).hide().appendTo("#list").fadeIn(1000);
        }
      });
    });
</script>