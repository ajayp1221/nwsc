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
                    Attendance
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/teacher/teachers"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Attendance</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title"><?= strtoupper($classrooms->class_name) . " (" . date('d-m-Y') . ")" ?></h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <?php echo $this->Form->create($classrooms); ?>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><?= "Image" ?></th>
                                            <th><?= 'Name' ?></th>
                                            <th class="actions"><?= __('Attendance') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0;
                                        $attendance = 1;
                                        foreach ($classrooms->students as $student): ?>
                                            <?php
                                            if (@$student->studentattendances[0]->attendance) {
                                                $attendance = $student->studentattendances[0]->attendance;
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <img src="<?php echo $student->api_img_medium; ?>" alt="<?= $student->full_name?>"/>
                                                </td>
                                                <td><?= $student->full_name ?></td>
                                                <td class="actions">
                                                    <?php
                                                    echo $this->Form->input("studentattendance.$i.attendance", array(
                                                        'type' => 'radio',
                                                        'before' => false,
                                                        'label' => false,
                                                        'legend' => false,
                                                        'class' => 'radio-btn',
                                                        'options' => array(
                                                            1 => 'Present',
                                                            2 => 'Absent',
                                                            3 => 'Leave'
                                                        ),
                                                        'value' => $attendance
                                                    ));
                                                    echo $this->Form->input("studentattendance.$i.student_id", ['value' => $student->id, 'type' => 'hidden']);
                                                    if (@$student->studentattendances[0]->id) {
                                                        echo $this->Form->input("studentattendance.$i.id", ['value' => $student->studentattendances[0]->id, 'type' => 'hidden']);
                                                    }
                                                    echo $this->Form->input("studentattendance.$i.teacher_id", ['value' => $authuser['id'], 'type' => 'hidden']);
                                                    echo $this->Form->input("studentattendance.$i.school_id", ['value' => $authuser['school_id'], 'type' => 'hidden']);
                                                    echo $this->Form->input("studentattendance.$i.classroom_id", ['value' => $classrooms->id, 'type' => 'hidden']);
                                                    echo $this->Form->input("studentattendance.$i.session", ['value' => $student->session, 'type' => 'hidden']);
                                                    echo $this->Form->input("studentattendance.$i.status", ['value' => 1, 'type' => 'hidden']);
                                                    echo $this->Form->input("studentattendance.$i.date", ['value' => date('d-m-Y'), 'type' => 'hidden']);
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php $i++;endforeach; ?>
                                    </tbody>
                                </table>
                                <input type="submit" class="btn btn-info pull-right" />
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section>
        </div>
    </div>
</div>
<?php echo $this->element('js/jstable'); ?>
