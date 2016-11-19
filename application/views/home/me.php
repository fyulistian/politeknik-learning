<hr/>
    <div class="col-sm-3">
        <div class="block">
            <div class="block-content text-center overflow-hidden">
                <div class="push-30-t push animated fadeInDown">
                    <img class="img-avatar" src="<?php echo $gambar ?>" alt="">
                </div>
                <div class="push-30 animated fadeInUp">
                    <h2 class="h4 font-w600 push-5">
                        <span><?php echo $nama_mhs ?></span>
                    </h2>
                    <h3 class="h5 text-muted"><?php echo $classroom ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="block">
            <?php foreach ($data_course as $course) { ?>
                <div class="block-header bg-gray-lighter">
                    <h3 class="block-title">
                        <i class="fa fa-star text-warning" data-toggle="tooltip" title="" data-original-title="Major"></i>
                        <?php echo $course->nama_matakuliah ?>
                    </h3>
                </div>
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">Course</th>
                            <th class="visible-lg">Start Date</th>
                            <th class="hidden-xs text-center">Submit Date</th>
                            <th>Status</th>
                            <th class="hidden-xs text-right">Result</th>
                        </tr>
                    </thead>
                    <?php $data_all_course  = $this->Nilai_model->get_all_course($course->nama_matakuliah, $id_kelas, $nim); ?>
                    <?php foreach ($data_all_course as $all_course) { ?>
                    <tbody>
                    <tr>
                        <td class="text-center">
                            <span class="text-primary">
                                <strong><?php echo ucwords($all_course->nama_course) ?></strong>
                            </span>
                        </td>
                        <td class="visible-lg">
                            <span class="text-primary">
                                <?php echo date('F d, Y - H:i', strtotime($all_course->tanggal_course)); ?>
                            </span>
                        </td>
                        <td class="hidden-xs text-center">
                            <?php echo date('F d, Y - H:i', strtotime($all_course->tanggal_jawab)); ?>
                        </td>
                        <?php if (($all_course->total_nilai) < 70) { ?>
                            <td>
                                <span class="label label-danger">Failed</span>
                            </td>
                        <?php } else { ?>
                            <td>
                                <span class="label label-success">Succeed</span>
                            </td>
                        <?php } ?>
                        <td class="text-right hidden-xs">
                            <strong><?php echo $all_course->total_nilai ?></strong>
                            <small><em class="text-muted">/100</em></small>
                        </td>
                    </tr>   
                    </tbody>
                    <?php } ?>
                </table>
            </div>
            <?php } ?>
        </div>
    </div>