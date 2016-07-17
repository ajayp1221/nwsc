<?php echo $this->Html->script(['jquery-1.11.3.min']);?>
<?php echo $this->element('side'); $data = []; ?>
<?php foreach($classroom->timetables as $timetable){
    if($timetable->days=="Monday"){
//        debug($timetable->days);
        $data['Monday'][] = $timetable;
    }
    if($timetable->days=="Tuesday"){
        $data['Tuesday'][] = $timetable;
    }
    if($timetable->days=="Wednesday"){
        $data['Wednesday'][] = $timetable;
    }
    if($timetable->days=="Thursday"){
        $data['Thursday'][] = $timetable;
    }
    if($timetable->days=="Friday"){
        $data['Friday'][] = $timetable;
    }
    if($timetable->days=="Saturday"){
        $data['Saturday'][] = $timetable;
    }
}
//debug($data['Monday']);exit;
?>
<div class="subjects index large-9 medium-8 columns content">
    <h3><?= __($classroom->name." - ".$classroom->section) ?></h3>
    <?= $this->Form->create($classroom, ['type' => 'file']) ?>
    <table cellpadding="0" cellspacing="0">
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
                    <td>Monday</td>
                    <?php foreach($data['Monday'] as $mondaytimetable){?>
                        <td>
                            
                            <?php echo $mondaytimetable->period_no;?><br/>
                            <?php echo $mondaytimetable->teacher->full_name.", ".$mondaytimetable->subject->name.", ".$mondaytimetable->period_time?>
                        </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>Tuesday</td>
                    <?php foreach($data['Tuesday'] as $tuesdaytimetable){?>
                        <td>
                            <?php echo $tuesdaytimetable->teacher->full_name.", ".$tuesdaytimetable->subject->name.", ".$tuesdaytimetable->period_time?>
                        </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>Wednesday</td>
                    <?php foreach($data['Wednesday'] as $wednestimetable){?>
                        <td>
                            <?php echo $wednestimetable->teacher->full_name.", ".$wednestimetable->subject->name.", ".$wednestimetable->period_time?>
                        </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>Thursday</td>
                    <?php foreach($data['Thursday'] as $thursdaytimetable){?>
                        <td>
                            <?php echo $thursdaytimetable->teacher->full_name.", ".$thursdaytimetable->subject->name.", ".$thursdaytimetable->period_time?>
                        </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>Friday</td>
                    <?php foreach($data['Friday'] as $fridaytimetable){?>
                        <td>
                            <?php echo $fridaytimetable->teacher->full_name.", ".$fridaytimetable->subject->name.", ".$fridaytimetable->period_time?>
                        </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>Saturday</td>
                    <?php foreach($data['Saturday'] as $saturdaytimetable){?>
                        <td>
                            <?php echo $saturdaytimetable->teacher->full_name.", ".$saturdaytimetable->subject->name.", ".$saturdaytimetable->period_time?>
                        </td>
                    <?php }?>
                </tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        alert('aaa');
    });
</script>