<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>
                <?php if ($this->session->flashdata('reportNotification')) { ?>
                    <div class="alert alert-warning" id="report-alert"> 
                        <i class="si si-info fa-lg"></i> &nbsp;<?= $this->session->flashdata('reportNotification') ?> 
                    </div> 
                <?php } ?>
                <h2 class="content-heading">Semester</h2>
                <div class="content-grid push-50">
                    <div class="row">
                        <div class="col-lg-2">
                            <a class="block block-link-hover2" id="semester1" href="javascript:void(0)">
                                <div class="block-content block-content-full bg-flat clearfix" id="colored1">
                                    <span class="fa-stack text-white pull-right">
                                      <strong class="fa-stack-2x fa-lg">1</strong>
                                    </span>
                                    <span class="h4 text-white-op">Semester</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a class="block block-link-hover2" id="semester2" href="javascript:void(0)">
                                <div class="block-content block-content-full bg-primary-dark clearfix" id="colored2">
                                    <span class="fa-stack text-white pull-right">
                                      <strong class="fa-stack-2x fa-lg">2</strong>
                                    </span>
                                    <span class="h4 text-white-op">Semester</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a class="block block-link-hover2" id="semester3" href="javascript:void(0)">
                                <div class="block-content block-content-full bg-warning clearfix" id="colored3">
                                    <span class="fa-stack text-white pull-right">
                                      <strong class="fa-stack-2x fa-lg">3</strong>
                                    </span>
                                    <span class="h4 text-white-op">Semester</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a class="block block-link-hover2" id="semester4" href="javascript:void(0)">
                                <div class="block-content block-content-full bg-amethyst clearfix" id="colored4">
                                    <span class="fa-stack text-white pull-right">
                                      <strong class="fa-stack-2x fa-lg">4</strong>
                                    </span>
                                    <span class="h4 text-white-op">Semester</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a class="block block-link-hover2" id="semester5" href="javascript:void(0)">
                                <div class="block-content block-content-full bg-city clearfix" id="colored5">
                                    <span class="fa-stack text-white pull-right">
                                      <strong class="fa-stack-2x fa-lg">5</strong>
                                    </span>
                                    <span class="h4 text-white-op">Semester</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a class="block block-link-hover2" id="semester6" href="javascript:void(0)">
                                <div class="block-content block-content-full bg-modern clearfix" id="colored6">
                                    <span class="fa-stack text-white pull-right">
                                      <strong class="fa-stack-2x fa-lg">6</strong>
                                    </span>
                                    <span class="h4 text-white-op">Semester</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="content"></div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
<script>
    $("#report-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#report-alert").slideUp(500);
    });

    $('#semester1').click(function() {
    var id = "1";
    $.ajax({
       url : "<?php echo site_url('matakuliah/jurusan')?>/" + id,
       success: function(html) {
          $("#content").html("");
          $(html).hide().appendTo("#content").fadeIn(1000);
          $("#colored1").removeClass('bg-flat');
          $("#colored1").addClass('bg-success');
          $("#colored2").addClass('bg-primary-dark');
          $("#colored2").removeClass('bg-success');
          $("#colored3").addClass('bg-warning');
          $("#colored3").removeClass('bg-success');
          $("#colored4").addClass('bg-amethyst');
          $("#colored4").removeClass('bg-success');
          $("#colored5").addClass('bg-city');
          $("#colored5").removeClass('bg-success');
          $("#colored6").addClass('bg-modern');
          $("#colored6").removeClass('bg-success');
        }
      });
    });
    $('#semester2').click(function() {
    var id = "2";
    $.ajax({
       url : "<?php echo site_url('matakuliah/jurusan')?>/" + id,
       success: function(html) {
          $("#content").html("");
          $(html).hide().appendTo("#content").fadeIn(1000);
          $("#colored1").addClass('bg-flat');
          $("#colored1").removeClass('bg-success');
          $("#colored2").removeClass('bg-primary-dark');
          $("#colored2").addClass('bg-success');
          $("#colored3").addClass('bg-warning');
          $("#colored3").removeClass('bg-success');
          $("#colored4").addClass('bg-amethyst');
          $("#colored4").removeClass('bg-success');
          $("#colored5").addClass('bg-city');
          $("#colored5").removeClass('bg-success');
          $("#colored6").addClass('bg-modern');
          $("#colored6").removeClass('bg-success');
        }
      });
    });
    $('#semester3').click(function() {
    var id = "3";
    $.ajax({
       url : "<?php echo site_url('matakuliah/jurusan')?>/" + id,
       success: function(html) {
          $("#content").html("");
          $(html).hide().appendTo("#content").fadeIn(1000);
          $("#colored1").addClass('bg-flat');
          $("#colored1").removeClass('bg-success');
          $("#colored2").addClass('bg-primary-dark');
          $("#colored2").removeClass('bg-success');
          $("#colored3").removeClass('bg-warning');
          $("#colored3").addClass('bg-success');
          $("#colored4").addClass('bg-amethyst');
          $("#colored4").removeClass('bg-success');
          $("#colored5").addClass('bg-city');
          $("#colored5").removeClass('bg-success');
          $("#colored6").addClass('bg-modern');
          $("#colored6").removeClass('bg-success');
        }
      });
    });
    $('#semester4').click(function() {
    var id = "4";
    $.ajax({
       url : "<?php echo site_url('matakuliah/jurusan')?>/" + id,
       success: function(html) {
          $("#content").html("");
          $(html).hide().appendTo("#content").fadeIn(1000);
          $("#colored1").addClass('bg-flat');
          $("#colored1").removeClass('bg-success');
          $("#colored2").addClass('bg-primary-dark');
          $("#colored2").removeClass('bg-success');
          $("#colored3").addClass('bg-warning');
          $("#colored3").removeClass('bg-success');
          $("#colored4").removeClass('bg-amethyst');
          $("#colored4").addClass('bg-success');
          $("#colored5").addClass('bg-city');
          $("#colored5").removeClass('bg-success');
          $("#colored6").addClass('bg-modern');
          $("#colored6").removeClass('bg-success');
        }
      });
    });
    $('#semester5').click(function() {
    var id = "5";
    $.ajax({
       url : "<?php echo site_url('matakuliah/jurusan')?>/" + id,
       success: function(html) {
          $("#content").html("");
          $(html).hide().appendTo("#content").fadeIn(1000);
          $("#colored1").addClass('bg-flat');
          $("#colored1").removeClass('bg-success');
          $("#colored2").addClass('bg-primary-dark');
          $("#colored2").removeClass('bg-success');
          $("#colored3").addClass('bg-warning');
          $("#colored3").removeClass('bg-success');
          $("#colored4").addClass('bg-amethyst');
          $("#colored4").removeClass('bg-success');
          $("#colored5").removeClass('bg-city');
          $("#colored5").addClass('bg-success');
          $("#colored6").addClass('bg-modern');
          $("#colored6").removeClass('bg-success');
        }
      });
    });
    $('#semester6').click(function() {
    var id = "6";
    $.ajax({
       url : "<?php echo site_url('matakuliah/jurusan')?>/" + id,
       success: function(html) {
          $("#content").html("");
          $(html).hide().appendTo("#content").fadeIn(1000);
          $("#colored1").addClass('bg-flat');
          $("#colored1").removeClass('bg-success');
          $("#colored2").addClass('bg-primary-dark');
          $("#colored2").removeClass('bg-success');
          $("#colored3").addClass('bg-warning');
          $("#colored3").removeClass('bg-success');
          $("#colored4").addClass('bg-amethyst');
          $("#colored4").removeClass('bg-success');
          $("#colored5").addClass('bg-city');
          $("#colored5").removeClass('bg-success');
          $("#colored6").removeClass('bg-modern');
          $("#colored6").addClass('bg-success');
        }
      });
    });
</script>