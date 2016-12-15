<section class="content content-boxed overflow-hidden">
    <div class="push-50-t push-50">
        <div class="row">
            <?php foreach ($value as $value) { ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <a class="block block-rounded block-link-hover2" href="<?php echo base_url('home/question/'.$value->id_course) ?>">
                        <div class="block-content block-content-full text-center bg-modern">
                            <div class="item item-2x item-circle bg-crystal-op push-20-t push-20 visibility-hidden" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
                                <span class="font-w700 text-white-op">
                                <?php $s = substr($value->nama_matakuliah,0,1);
                                    $c = substr($value->nama_matakuliah,1,1);
                                    echo strtoupper($s.$c); ?>
                                </span>
                            </div>
                            <div class="text-white-op">
                                <em><?php 
                                    $hours = $value->durasi;
                                    $minutes = 0; 
                                    if (strpos($hours, ':') !== false) 
                                    {
                                        list($hours, $minutes) = explode(':', $hours); 
                                    } 
                                    echo $hours * 60 + $minutes;?>
                                </em>  <em>minutes</em> 
                            </div>
                        </div>
                        <div class="block-content">
                            <h4 class="mheight-125"><?php echo $value->deskripsi; ?></h4>
                            <div class="font-s12 text-center push">
                                <?php echo date('F d, Y', strtotime($value->tanggal_course)); ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="block">
        <?php foreach ($download as $file) { ?>
            <div class="block-header bg-gray-lighter">
                <h3 class="block-title">
                    <i class="fa fa-star text-warning" data-toggle="tooltip" title="" data-original-title="Course"></i>
                    <?php echo $file->nama_matakuliah ?>
                </h3>
            </div>
        <div class="block-content">
            <table class="table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center">Files</th>
                        <th class="visible-lg">Upload Date</th>
                    </tr>
                </thead>
                <?php $kelas = $this->Decide_model->get_kelas($nim); ?>
                <?php $data_file_course  = $this->Course_model->get_file($file->id_course, $kelas->id_kelas); ?>
                <?php foreach ($data_file_course as $all_course) { ?>
                <tbody>
                <tr>
                    <td class="text-center">
                        <span class="text-primary">
                            <a href="<?php echo base_url('uploads/file/'.$all_course->nama_materi) ?>">
                                <strong><?php echo ucwords($all_course->judul_materi) ?></strong>
                            </a>
                        </span>
                    </td>
                    <td class="visible-lg">
                        <?php echo date('F d, Y - H:i', strtotime($all_course->tanggal_upload)); ?>
                    </td>
                </tr>   
                </tbody>
                <?php } ?>
            </table>
        </div>
        <?php } ?>
    </div>
</section>