<?php echo $this->element('side');?>
<div class="schools view large-9 medium-8 columns content">
    <h3><?= h($school->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($school->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Current Session') ?></th>
            <td><?= h($school->session) ?></td>
        </tr>
        <tr>
            <th><?= __('Image') ?></th>
            <td>
                <?php echo $this->Html->image("../upload/schools/80-$school->image",['alt' => $school->name]);?>
            </td>
        </tr>
        <tr>
            <th><?= __('Area') ?></th>
            <td><?= $school->has('area') ? $this->Html->link($school->area->name, ['controller' => 'Areas', 'action' => 'view', $school->area->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('City') ?></th>
            <td><?= $school->has('city') ? $this->Html->link($school->city->name, ['controller' => 'Cities', 'action' => 'view', $school->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('State') ?></th>
            <td><?= $school->has('state') ? $this->Html->link($school->state->name, ['controller' => 'States', 'action' => 'view', $school->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Country') ?></th>
            <td><?= $school->has('country') ? $this->Html->link($school->country->name, ['controller' => 'Countries', 'action' => 'view', $school->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($school->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Pincode') ?></th>
            <td><?= $this->Number->format($school->pincode) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?php if($school->status){echo "Active";}else{echo "Deactive";} ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= date("d-m-Y H:i",$school->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Modified') ?></th>
            <td><?= date("d-m-Y H:i",$school->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($school->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Address') ?></h4>
        <?= $this->Text->autoParagraph(h($school->address)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Classrooms') ?></h4>
        <?php if (!empty($school->classrooms)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('School Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Section') ?></th>
                <th><?= __('Status') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($school->classrooms as $classrooms): ?>
            <tr>
                <td><?= h($classrooms->id) ?></td>
                <td><?= h($classrooms->school_id) ?></td>
                <td><?= h($classrooms->name) ?></td>
                <td><?= h($classrooms->section) ?></td>
                <td><?= h($classrooms->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Classrooms', 'action' => 'view', $classrooms->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Classrooms', 'action' => 'edit', $classrooms->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Classrooms', 'action' => 'delete', $classrooms->id], ['confirm' => __('Are you sure you want to delete # {0}?', $classrooms->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Holidays') ?></h4>
        <?php if (!empty($school->holidays)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Reason') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Session') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($school->holidays as $holidays): ?>
            <tr>
                <td><?= h($holidays->id) ?></td>
                <td><?= h($holidays->title) ?></td>
                <td><?= h($holidays->reason) ?></td>
                <td><?= h($holidays->date) ?></td>
                <td><?= h($holidays->session) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Holidays', 'action' => 'view', $holidays->id]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Holidays', 'action' => 'edit', $holidays->id]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Holidays', 'action' => 'delete', $holidays->id], ['confirm' => __('Are you sure you want to delete # {0}?', $holidays->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
 
    <div class="related">
        <h4><?= __('Related Teachers') ?></h4>
        <?php if (!empty($school->teachers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Name') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Mobile') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($school->teachers as $teachers): ?>
            <tr>
                <td><?= h($teachers->full_name) ?></td>
                <td><?= h($teachers->email) ?></td>
                <td><?= h($teachers->mobile) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Teachers', 'action' => 'view', $teachers->slug]) ?>

                    <?= $this->Html->link(__('Edit'), ['controller' => 'Teachers', 'action' => 'edit', $teachers->slug]) ?>

                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Teachers', 'action' => 'delete', $teachers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teachers->id)]) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Payment') ?></h4>
        <?php if (!empty($school->teachers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Month') ?></th>
                <th><?= __('Amount') ?></th>
                <th><?= __('Created') ?></th>
            </tr>
            <?php foreach ($school->schoolspayments as $schoolspayments): ?>
            <tr>
                <td><?= h($schoolspayments->month) ?></td>
                <td><?= h($schoolspayments->amount) ?></td>
                <td><?= date("d-m-Y H:i",$schoolspayments->created) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
    
</div>
