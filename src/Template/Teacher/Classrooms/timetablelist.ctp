<?php echo $this->element('css/csstable'); ?>
<div class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php echo $this->element('header'); ?>
        <?php echo $this->element('side'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="col-md-12 center">
                    <?= $this->Flash->render() ?>
                </div>
                <h1>
                    Classroom Time List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/teacher/teachers"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Timetable</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title"><?php echo strtoupper($classroom->class_name); ?></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><?= 'Days' ?></th>
                                            <th><?= 'Period-1' ?></th>
                                            <th><?= 'Period-2' ?></th>
                                            <th><?= 'Period-3' ?></th>
                                            <th><?= 'Period-4' ?></th>
                                            <th><?= 'Period-5' ?></th>
                                            <th><?= 'Period-6' ?></th>
                                            <th><?= 'Period-7' ?></th>
                                            <th><?= 'Period-8' ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b>Monday</b></td>
                                            <?php
                                            $lastPeriod = 0;
                                            $difBtPrd = 0;
                                            $lunch = 1;
                                            foreach ($timetables['Monday'] as $mondaytimetable) {
                                                if ($mondaytimetable->period_no > 1 && $lastPeriod == 0) {
                                                    $difBtPrd = $mondaytimetable->period_no;
                                                } elseif ($lastPeriod) {
                                                    $difBtPrd = $mondaytimetable->period_no - $lastPeriod;
                                                }
                                                for ($i = 1; $i < $difBtPrd; $i++) {
                                                    if ($lunch == $settings[0]['value']) {
                                                        ?>
                                                        <td>Lunch</td>
                                                    <?php } else { ?>
                                                        <td>No-Period</td>
                                                        <?php
                                                    }
                                                    $lunch++;
                                                }
                                                if ($lunch == $settings[0]['value']) {
                                                    ?>
                                                    <td>Lunch</td>
                                                <?php }$lunch++;
                                                ?>
                                                <td>
                                                    <?php echo $mondaytimetable->teacher->full_name; ?><br/>
                                                    <?php echo $mondaytimetable->subject->name; ?><br/>
                                                    <?php echo $mondaytimetable->period_time ?>
                                                </td>
                                                <?php $lastPeriod = $mondaytimetable->period_no; ?>
                                            <?php
                                            } if ($lunch <= $settings[4]['value']) {
                                                for ($i = $lunch; $i <= $settings[4]['value']; $i++) {
                                                    ?>
                                                    <td>No-Period</td>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td><b>Tuesday</b></td>
                                            <?php
                                            $lastPeriod = 0;
                                            $difBtPrd = 0;
                                            $lunch = 1;
                                            foreach ($timetables['Tuesday'] as $tuesdaytimetable) {
                                                if ($tuesdaytimetable->period_no > 1 && $lastPeriod == 0) {
                                                    $difBtPrd = $tuesdaytimetable->period_no;
                                                } elseif ($lastPeriod) {
                                                    $difBtPrd = $tuesdaytimetable->period_no - $lastPeriod;
                                                }
                                                for ($i = 1; $i < $difBtPrd; $i++) {
                                                    if ($lunch == $settings[0]['value']) {
                                                        ?>
                                                        <td>Lunch</td>
                                                    <?php } else { ?>
                                                        <td>No-Period</td>
                                                        <?php
                                                    }
                                                    $lunch++;
                                                }
                                                if ($lunch == $settings[0]['value']) {
                                                    ?>
                                                    <td>Lunch</td>
                                                    <?php }$lunch++; ?>
                                                <td>
                                                    <?php echo $tuesdaytimetable->teacher->full_name; ?><br/>
                                                <?php echo $tuesdaytimetable->subject->name; ?><br/>
                                                <?php echo $tuesdaytimetable->period_time; ?>
                                                </td>
                                                <?php
                                                $lastPeriod = $tuesdaytimetable->period_no;
                                            } if ($lunch <= $settings[4]['value']) {
                                                for ($i = $lunch; $i <= $settings[4]['value']; $i++) { ?>
                                                    <td>No-Period</td>
    <?php
    }
}
?>
                                        </tr>
                                        <tr>
                                            <td><b>Wednesday</b></td>
                                            <?php
                                            $lastPeriod = 0;
                                            $difBtPrd = 0;
                                            $lunch = 1;
                                            foreach ($timetables['Wednesday'] as $wednestimetable) {
                                                if ($wednestimetable->period_no > 1 && $lastPeriod == 0) {
                                                    $difBtPrd = $wednestimetable->period_no;
                                                } elseif ($lastPeriod) {
                                                    $difBtPrd = $wednestimetable->period_no - $lastPeriod;
                                                }
                                                for ($i = 1; $i < $difBtPrd; $i++) {
                                                    if ($lunch == $settings[0]['value']) {
                                                        ?>
                                                        <td>Lunch</td>
                                                    <?php } else { ?>
                                                        <td>No-Period</td>
                                                        <?php
                                                    }
                                                    $lunch++;
                                                }
                                                if ($lunch == $settings[0]['value']) {
                                                    ?>
                                                    <td>Lunch</td>
                                                    <?php }$lunch++;
                                                    ?>
                                                <td>
                                                <?php echo $wednestimetable->teacher->full_name; ?><br/>
                                                <?php echo $wednestimetable->subject->name; ?><br/>
                                                <?php echo $wednestimetable->period_time ?>
                                                </td>
                                                <?php $lastPeriod = $wednestimetable->period_no;
                                                ?>
                                            <?php
                                            } if ($lunch <= $settings[4]['value']) {
                                                for ($i = $lunch; $i <= $settings[4]['value']; $i++) {
                                                    ?>
                                                    <td>No-Period</td>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td><b>Thursday</b></td>
                                            <?php
                                            $lastPeriod = 0;
                                            $difBtPrd = 0;
                                            $lunch = 1;

                                            foreach ($timetables['Thursday'] as $thursdaytimetable) {
                                                if ($thursdaytimetable->period_no > 1 && $lastPeriod == 0) {
                                                    $difBtPrd = $thursdaytimetable->period_no;
                                                } elseif ($lastPeriod) {
                                                    $difBtPrd = $thursdaytimetable->period_no - $lastPeriod;
                                                }
                                                for ($i = 1; $i < $difBtPrd; $i++) {
                                                    if ($lunch == $settings[0]['value']) {
                                                        ?>
                                                        <td>Lunch</td>
                                                    <?php } else { ?>
                                                        <td>No-Period</td>
                                                        <?php
                                                    }
                                                    $lunch++;
                                                }
                                                if ($lunch == $settings[0]['value']) {
                                                    ?>
                                                    <td>Lunch</td>
                                                <?php }$lunch++;
                                                ?>
                                                <td>
                                                <?php echo $thursdaytimetable->teacher->full_name; ?><br/>
                                                <?php echo $thursdaytimetable->subject->name; ?><br/> 
                                                <?php echo $thursdaytimetable->period_time ?>
                                                </td>
                                                <?php $lastPeriod = $thursdaytimetable->period_no;
                                                ?>
                                            <?php
                                            } if ($lunch <= $settings[4]['value']) {
                                                for ($i = $lunch; $i <= $settings[4]['value']; $i++) {
                                                    ?>
                                                    <td>No-Period</td>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td><b>Friday</b></td>
                                            <?php
                                            $lastPeriod = 0;
                                            $difBtPrd = 0;
                                            $lunch = 1;
                                            foreach ($timetables['Friday'] as $fridaytimetable) {
                                                if ($fridaytimetable->period_no > 1 && $lastPeriod == 0) {
                                                    $difBtPrd = $fridaytimetable->period_no;
                                                } elseif ($lastPeriod) {
                                                    $difBtPrd = $fridaytimetable->period_no - $lastPeriod;
                                                }
                                                for ($i = 1; $i < $difBtPrd; $i++) {
                                                    if ($lunch == $settings[0]['value']) {
                                                        ?>
                                                        <td>Lunch</td>
                                                    <?php } else { ?>
                                                        <td>No-Period</td>
                                                        <?php
                                                    }
                                                    $lunch++;
                                                }
                                                if ($lunch == $settings[0]['value']) {
                                                    ?>
                                                    <td>Lunch</td>
                                                <?php }$lunch++;
                                                ?>
                                                <td>
                                                <?php echo $fridaytimetable->teacher->full_name; ?><br/>
                                                <?php echo $fridaytimetable->subject->name; ?><br/>
                                                <?php echo $fridaytimetable->period_time; ?>
                                                </td>
                                                <?php $lastPeriod = $fridaytimetable->period_no;
                                                ?>
<?php
} if ($lunch <= $settings[4]['value']) {
    for ($i = $lunch; $i <= $settings[4]['value']; $i++) {
        ?>
                                                    <td>No-Period</td>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td><b>Saturday</b></td>
                                            <?php
                                            $lastPeriod = 0;
                                            $lunch = 1;
                                            foreach ($timetables['Saturday'] as $saturdaytimetable) {

                                                if ($saturdaytimetable->period_no > 1 && $lastPeriod == 0) {
                                                    $difBtPrd = $saturdaytimetable->period_no;
                                                } elseif ($lastPeriod) {
                                                    $difBtPrd = $saturdaytimetable->period_no - $lastPeriod;
                                                }
                                                for ($i = 1; $i < $difBtPrd; $i++) {
                                                    if ($lunch == $settings[0]['value']) {
                                                        ?>
                                                        <td>Lunch</td>
                                                    <?php } else { ?>
                                                        <td>No-Period</td>
                                                            <?php
                                                        }
                                                        $lunch++;
                                                    }
                                                    if ($lunch == $settings[0]['value']) {
                                                        ?>
                                                    <td>Lunch</td>
                                                <?php }$lunch++;
                                                ?>
                                                <td>
                                                <?php echo $saturdaytimetable->teacher->full_name; ?><br/>
                                                <?php echo $saturdaytimetable->subject->name; ?><br/>
                                                <?php echo $saturdaytimetable->period_time; ?>
                                                </td>
    <?php $lastPeriod = $saturdaytimetable->period_no;
    ?>
<?php
} if ($lunch <= $settings[4]['value']) {
    for ($i = $lunch; $i <= $settings[4]['value']; $i++) {
        ?>
                                                    <td>No-Period</td>
    <?php
    }
}
?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section>
        </div>
    </div>
</div>
<?php echo $this->element('js/jstable'); ?>