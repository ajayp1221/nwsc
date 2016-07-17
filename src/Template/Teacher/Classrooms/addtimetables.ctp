<?php echo $this->element('side');?>
<div class="subjects index large-9 medium-8 columns content">
    <h3><?= __($classrooms->name) ?></h3>
    <?= $this->Form->create($classrooms, ['type' => 'file']) ?>
        <input type="hidden" name="classroom_id" value="<?= $classrooms->id?>" />
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><?= 'Period Time' ?></th>
                    <th><?= $this->Paginator->sort('Monday') ?></th>
                    <th><?= $this->Paginator->sort('Tuesday') ?></th>
                    <th><?= $this->Paginator->sort('Wednesday') ?></th>
                    <th><?= $this->Paginator->sort('Thurshday') ?></th>
                    <th><?= $this->Paginator->sort('Friday') ?></th>
                    <th><?= $this->Paginator->sort('Saturday') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1;$i<=9;$i++){?>
                    <tr>
                        <td>
                            <?php echo $i;?>
                            <?php echo $this->Form->input("Classrooms.$i.period_no", ['label' => false, 'value' => "$i", 'type' => 'hidden']);?>
                            <?php echo $this->Form->input("Classrooms.$i.period_time", ['label' => false, 'placeholder' => "00:00"]);?>
                        </td>
                        <td>
                            <?php echo $this->Form->input("Classrooms.$i.monday_subject_id", ['options' => $subjects, 'label' => false, 'empty' => 'choose Subject']);?>
                            <?php echo $this->Form->input("Classrooms.$i.monday_teacher_id", ['options' => $teacher, 'label' => false, 'empty' => 'choose Teacher']);?>
                        </td>
                        <td>
                            <?php echo $this->Form->input("Classrooms.$i.tuesday_subject_id", ['options' => $subjects, 'label' => false, 'empty' => 'choose Subject']);?>
                            <?php echo $this->Form->input("Classrooms.$i.tuesday_teacher_id", ['options' => $teacher, 'label' => false, 'empty' => 'choose Teacher']);?>
                        </td>
                        <td>
                            <?php echo $this->Form->input("Classrooms.$i.wednesday_subject_id", ['options' => $subjects, 'label' => false, 'empty' => 'choose Subject']);?>
                            <?php echo $this->Form->input("Classrooms.$i.wednesday_teacher_id", ['options' => $teacher, 'label' => false, 'empty' => 'choose Teacher']);?>
                        </td>
                        <td>
                            <?php echo $this->Form->input("Classrooms.$i.thursday_subject_id", ['options' => $subjects, 'label' => false, 'empty' => 'choose Subject']);?>
                            <?php echo $this->Form->input("Classrooms.$i.thursday_teacher_id", ['options' => $teacher, 'label' => false, 'empty' => 'choose Teacher']);?>
                        </td>
                        <td>
                            <?php echo $this->Form->input("Classrooms.$i.friday_subject_id", ['options' => $subjects, 'label' => false, 'empty' => 'choose Subject']);?>
                            <?php echo $this->Form->input("Classrooms.$i.friday_teacher_id", ['options' => $teacher, 'label' => false, 'empty' => 'choose Teacher']);?>
                        </td>
                        <td>
                            <?php echo $this->Form->input("Classrooms.$i.saturday_subject_id", ['options' => $subjects, 'label' => false, 'empty' => 'choose Subject']);?>
                            <?php echo $this->Form->input("Classrooms.$i.saturday_teacher_id", ['options' => $teacher, 'label' => false, 'empty' => 'choose Teacher']);?>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    <?= $this->Form->button(__('Submit')) ?>
</div>
