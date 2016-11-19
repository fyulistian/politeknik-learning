<div class="content content-narrow">
    <ol class="breadcrumb push-15">
        <li class="text-muted">Forums</li>
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
            <?php foreach ($data_course as $course) { ?>
            <table class="table table-striped table-borderless table-vcenter">
                <thead>
                    <tr>
                        <th colspan="2"><?php echo $course->nama_course ?></th>
                        <th class="text-center hidden-xs hidden-sm" style="width: 100px;"></th>
                        <th class="text-center hidden-xs hidden-sm" style="width: 100px;"></th>
                        <th class="hidden-xs hidden-sm" style="width: 200px;">Posted In</th>
                    </tr>
                </thead>
                <tbody>
                <?php $user = $this->session->userdata('email');
                $nim = $this->Mahasiswa_model->my_nim($user);
                $data_forum  = $this->Forum_model->get_all_forum($course->id_course, $nim); ?>
                    <?php foreach ($data_forum as $forum) { ?>
                    <tr>
                        <td class="text-center" style="width: 75px;">
                            <i class="si si-badge fa-2x"></i>
                        </td>
                        <td>
                            <h4 class="h5 font-w600 push-5">
                                <a href="<?php echo base_url('home/topics/'.$forum->id_forum); ?>"><?php echo $forum->forum_title ?></a>
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
                                <?php echo date('F d, Y', strtotime($forum->tanggal_post)); ?>
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } ?>
        </div>
    </div>
</div>