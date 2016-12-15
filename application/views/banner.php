
<div class="content bg-image" style="background-image: url('<?php echo base_url('template/img/photos/white.png') ?>');">
    <div class="push-500-t push-100">
        <h1 class="h2 text-white animated zoomIn">Welcome a Board</h1>
        <h2 class="h5 text-white-op animated zoomIn"> <?php echo $email ?></h2>
    </div>
</div>
<?php if ($level == 'administrator') { ?>
	<div class="content bg-white border-b">
	    <div class="row items-push text-uppercase">
	        <div class="col-sm-3">
	            <div class="font-w700 text-gray-darker animated fadeIn">Total Lecturer</div>
	            <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> All Time</small></div>
	            <p class="h2 font-w300 text-primary animated flipInX"><?php echo $totLec ?></p>
	        </div>
	        <div class="col-sm-3">
	            <div class="font-w700 text-gray-darker animated fadeIn">Total Collager</div>
	            <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> All Time</small></div>
	            <p class="h2 font-w300 text-primary animated flipInX"><?php echo $totCol ?></p>
	        </div>
	        <div class="col-sm-3">
	            <div class="font-w700 text-gray-darker animated fadeIn">Total Major</div>
	            <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> All Time</small></div>
	            <p class="h2 font-w300 text-primary animated flipInX"><?php echo $totMaj ?></p>
	        </div>
	        <div class="col-sm-3">
	            <div class="font-w700 text-gray-darker animated fadeIn">Total Courses</div>
	            <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> All Time</small></div>
	            <p class="h2 font-w300 text-primary animated flipInX"><?php echo $totCou ?></p>
	        </div>
	    </div>
	</div>
<?php } else { ?>
	<div class="content bg-white border-b">
	    <div class="row items-push text-uppercase">
	        <div class="col-sm-3">
	            <div class="font-w700 text-gray-darker animated fadeIn">Total Group</div>
	            <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> All Time</small></div>
	            <p class="h2 font-w300 text-primary animated flipInX"><?php echo $totGro ?></p>
	        </div>
	        <div class="col-sm-3">
	            <div class="font-w700 text-gray-darker animated fadeIn">Total Forum</div>
	            <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> All Time</small></div>
	            <p class="h2 font-w300 text-primary animated flipInX"><?php echo $totFor ?></p>
	        </div>
	        <div class="col-sm-3">
	            <div class="font-w700 text-gray-darker animated fadeIn">Total Materials</div>
	            <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> All Time</small></div>
	            <p class="h2 font-w300 text-primary animated flipInX"><?php echo $totMat ?></p>
	        </div>
	        <div class="col-sm-3">
	            <div class="font-w700 text-gray-darker animated fadeIn">Total Course</div>
	            <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> All Time</small></div>
	            <p class="h2 font-w300 text-primary animated flipInX"><?php echo $totUji ?></p>
	        </div>
	    </div>
	</div>
<?php } ?>