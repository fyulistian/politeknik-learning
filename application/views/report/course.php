<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo $title ?></title>
        <link href="<?php echo base_url('template/css/bootstrap.min.css'); ?>" rel="stylesheet">
    </head>
    <style type="text/css">
        #img {
            width: 93px;
            height: 93px;
            vertical-align: middle;
        }
        
        #text {
            display: inline-block;
            margin-left: 2em;
        }
    
        .position {
            display: block;
        }

        .postioning {
            margin-top: -4em;
        }
    </style>
    <body>
        <div class="postion">
            <img id="img" src="<?php echo base_url('template/img/logo.png') ?>">
            <p id="text">
                <b><font size="5" face="arial">POLITEKNIK SUKABUMI</font></b><br/>
                <b>Benteng, Warudoyong, Kota Sukabumi, Jawa Barat 43132</b><br/>
                <b>phone : (+62-266) 215-417, fax : (+62-266) 215-417</b><br/>
                <b>mail : politeknik@polteksmi.ac.id</b><br/>
            </p>
        </div>
    	<table class="table postioning">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Course</th>
                    <th>SKS</th>
                </tr>
            </thead>
            <tbody>
            <?php $start = 0;
            foreach ($course_data as $course) { ?>
                <tr>
                    <td><?php echo $course->kode_matakuliah ?></td>
                    <td><?php echo $course->nama_matakuliah ?></td>
                    <td><?php echo $course->sks ?></td>
                </tr>
            <?php } ?>
            </tbody>
            </table>
    </body>
</html>