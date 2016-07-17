<?php echo $this->element('side');?>
<div class="students view large-9 medium-8 columns content">
    <h3><?= h($student->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('School') ?></th>
            <td><?= $student->has('school') ? $this->Html->link($student->school->name, ['controller' => 'Schools', 'action' => 'view', $student->school->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Classroom') ?></th>
            <td><?= $student->has('classroom') ? $this->Html->link($student->classroom->class_name, ['controller' => 'Classrooms', 'action' => 'view', $student->classroom->slug]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Studentid') ?></th>
            <td><?= h($student->studentid) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= ($student->first_name." ".$student->last_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($student->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Image') ?></th>
            <td>
                <?php echo $this->Html->image("../upload/students/80-$student->image");?>
            </td>
        </tr>
        <tr>
            <th><?= __('Mobile') ?></th>
            <td><?= h($student->mobile) ?></td>
        </tr>
        <tr>
            <th><?= __('Dob') ?></th>
            <td><?= h($student->dob) ?></td>
        </tr>
        <tr>
            <th><?= __('Area') ?></th>
            <td><?= $student->has('area') ? $this->Html->link($student->area->name, ['controller' => 'Areas', 'action' => 'view', $student->area->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('City') ?></th>
            <td><?= $student->has('city') ? $this->Html->link($student->city->name, ['controller' => 'Cities', 'action' => 'view', $student->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('State') ?></th>
            <td><?= $student->has('state') ? $this->Html->link($student->state->name, ['controller' => 'States', 'action' => 'view', $student->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Country') ?></th>
            <td><?= $student->has('country') ? $this->Html->link($student->country->name, ['controller' => 'Countries', 'action' => 'view', $student->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($student->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Pincode') ?></th>
            <td><?= $this->Number->format($student->pincode) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?php if($student->status){echo "Active";}else{echo "Deactive";} ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= date("d-m-Y H:i",$student->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= date("d-m-Y H:i",$student->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Address') ?></h4>
        <?= $this->Text->autoParagraph(h($student->address)); ?>
    </div>
    <div class="related">
        <h4><?= __('Parrent Info') ?></h4>
        <?php if (!empty($student->guardian)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Father Name') ?></th>
                <th><?= __('Laxmi Name') ?></th>
                <th><?= __('Contact No') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <tr>
                <td><?= h($student->guardian->father_name) ?></td>
                <td><?= h($student->guardian->mother_name) ?></td>
                <td><?php echo ($student->guardian->mobile) ?></td>
                
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'guardians', 'action' => 'view', $student->slug]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'guardians', 'action' => 'edit', $student->slug]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'guardians', 'action' => 'delete', $student->slug], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?>
                </td>
            </tr>
        </table>
    <?php endif; ?>
    </div>
</div>
