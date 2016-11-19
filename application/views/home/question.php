<div class="row">
	<div class="col-md-3 col-sm-3 col-xs-3"></div>
</div>
<div class="bg-white">
    <section class="content content-mini content-mini-full content-boxed overflow-hidden">
        <ol class="breadcrumb">
            <li><a class="text-primary-dark" id="back" href="<?php echo base_url('home/course'); ?>">Course</a></li>
            <li><a href="javascript:void(0)"><?php echo $value['0']->nama_matakuliah; ?></a></li>
        </ol>
    </section>
</div>
<section class="content content-boxed overflow-hidden">
    <div class="row">
        <div class="col-md-8">
            <div class="block block-rounded">
                <div class="block-content">
					<?php $no = 0; ?>
					<?php foreach ($value as $value) { ?>
					<form role="form" action="<?php echo base_url('home/answer'); ?>" method="POST">
                    <input type="hidden" name="jumlah_soal" value="<?php echo $total_soal; ?>">
                    <input type="hidden" name="id_jawaban" value="<?php echo $id_jawaban; ?>">
                    <input type="hidden" name="id_course" value="<?php echo $id; ?>">
						<table class="table table-borderless table-condensed">
						<input type='hidden' name='id_soal[]' value='<?php echo $value->id_soal; ?>'/>
					        <tbody>
					            <tr class="active">
					                <th><?php echo ++$no; ?>. <?php echo $value->soal; ?></th>
					            </tr>
					            <tr>
					                <td>
					                    <div class="col-sm-12">
										    <label class="css-input css-radio css-radio-success push-10-r">
										        <input type="radio" name="kunci_jawaban[<?php echo $value->id_soal; ?>]" value="pilihan_1" checked><span></span> <?php echo $value->pilihan_1;?>
										    </label></br>
										    <label class="css-input css-radio css-radio-success">
										        <input type="radio" name="kunci_jawaban[<?php echo $value->id_soal; ?>]" value="pilihan_2"><span></span> <?php echo $value->pilihan_2;?>
										    </label></br>
										    <label class="css-input css-radio css-radio-success">
										        <input type="radio" name="kunci_jawaban[<?php echo $value->id_soal; ?>]" value="pilihan_3"><span></span> <?php echo $value->pilihan_3;?>
										    </label></br>
										    <label class="css-input css-radio css-radio-success">
										        <input type="radio" name="kunci_jawaban[<?php echo $value->id_soal; ?>]" value="pilihan_4"><span></span> <?php echo $value->pilihan_4;?>
										    </label></br>
										    <label class="css-input css-radio css-radio-success">
										        <input type="radio" name="kunci_jawaban[<?php echo $value->id_soal; ?>]" value="pilihan_5"><span></span> <?php echo $value->pilihan_5;?>
										    </label>
										</div>
					                </td>
					            </tr>
					        </tbody>
					    </table>
					<?php } ?>
					<button type="submit" class="btn btn-success btn-square pull-right" id="submit" style="margin: 15px;">Submit</button> 
				    </form>	
                </div>
            </div>
        </div>

		<div class="col-md-4">
            <div class="block block-rounded">
                <div class="block-header bg-gray-lighter text-center">
                    <h3 class="block-title">About This Course</h3>
                </div>
                <div class="block-content">
                    <table class="table table-borderless table-condensed">
                        <tbody>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-book push-10-r"></i> <?php echo $value->nama_matakuliah; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-clock-o push-10-r"></i>
                                    <em><?php 
                                    $hours = $value->durasi;
                                    $minutes = 0; 
                                    if (strpos($hours, ':') !== false) 
                                    {
                                        list($hours, $minutes) = explode(':', $hours); 
                                    } 
                                    echo $hours * 60 + $minutes;?>
                                	</em>  <em>minutes</em> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-calendar push-10-r"></i> 
                                	<?php echo date('F ', strtotime($value->tanggal_course)).date('d, ', strtotime($value->tanggal_course)).date('Y', strtotime($value->tanggal_course)); ?>
                                </td>
                            </tr>
                            <tr>
                            	<td>
                            		<i class="push-10-r pull-right"></i> Closes in <span id="counter"></span> seconds!
                                    <!-- <div class="alert alert-warning" id="error-alert"> <label>You will redirect !!</label> </div> -->
                            	</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url('template/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('template/js/sweetalert2.min.js') ?>"></script>
<script type="text/javascript">
<?php 
     $hours = $value->durasi;
        $minutes = 0; 
        if (strpos($hours, ':') !== false) 
        {
            list($hours, $minutes) = explode(':', $hours); 
        } 
  ?>
  <?php $time = $hours * 60 + $minutes; ?>
var MAX_COUNTER = 60 * <?php echo $time;?>;
// var MAX_COUNTER = 10 ;
var counter = null;
var counter_interval = null;

function setCookie(name,value,days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        expires = "; expires="+date.toGMTString();
    }
    else {
        expires = "";
    }
    document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1,c.length);
        }
        if (c.indexOf(nameEQ) === 0) {
            return c.substring(nameEQ.length,c.length);
        }
    }
    return null;
}

function deleteCookie(name) {
    setCookie(name,"",-1);
}

function resetCounter() {
    counter = MAX_COUNTER;
}

function stopCounter() {
    window.clearInterval(counter_interval);
    deleteCookie('counter');

}

function updateCounter() {
    var msg = '';
    if (counter > 0) {
        counter -= 1;
        msg = counter;
        setCookie('counter', counter, 1);
    }
    else {
        msg = "Counting finished.";
        stopCounter();
        document.getElementById('submit').click();
    }
    var el = document.getElementById('counter');
    if (el) {
        el.innerHTML = msg;
    }

}

function startCounter() {
    stopCounter();
    counter_interval = window.setInterval(updateCounter, 1000);
}

function init() {
    // stopCounter();
    counter = getCookie('counter');
    if (!counter) {
        resetCounter();
    }
    startCounter();
}

init();
// 	function startTimer(duration, display) {
//     var start = Date.now(),
//         diff,
//         minutes,
//         seconds;
//     function timer() {
//         diff = duration - (((Date.now() - start) / 1000) | 0);
//         minutes = (diff / 60) | 0;
//         seconds = (diff % 60) | 0;

//         minutes = minutes < 10 ? "0" + minutes : minutes;
//         seconds = seconds < 10 ? "0" + seconds : seconds;

//         display.textContent = minutes + ":" + seconds; 

//         if (diff <= 0) {
//             start = Date.now() + 1000;
//         }
//     };
//     timer();
//     setInterval(timer, 1000);
// }

// window.onload = function () {
// 	<?php 
// 		$hours = $value->durasi;
//         $minutes = 0; 
//         if (strpos($hours, ':') !== false) 
//         {
//             list($hours, $minutes) = explode(':', $hours); 
//         } 
// 	 ?>
// 	<?php $id = $hours * 60 + $minutes; ?>
//     var Minutes = 60 * <?php echo $id; ?>,
//     display = document.querySelector('#time');
// 	startTimer(Minutes, display);
// };
</script>